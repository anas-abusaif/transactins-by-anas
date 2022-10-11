<?php

declare(strict_types=1);

/**
 * Gets a list of csv files from a specified directory
 * 
 * @param string $filesDirectory The directory path which the csv files will be extracted from
 * 
 * @return array A list of csv files paths 
 */
function getTransactionsFiles(string $filesDirectory): array
{

    $csvFiles = [];
    foreach (scandir($filesDirectory) as $fileName) {
        $file = $filesDirectory . DIRECTORY_SEPARATOR . $fileName;
        if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) == "csv") {
            $csvFiles[] = $file;
        };
    };
    return $csvFiles;
}

/**
 * Extracts lines from specified csv file
 * 
 * @param string $filePath The file path which the lines will be extracted from
 * 
 * @return array An array of lines 
 */
function getTransactions(string $filePath, ?callable $helper = null): array
{
    if (!file_exists($filePath)) {
        trigger_error('File "' . $filePath . '" does not exist.', E_USER_ERROR);
    }

    $file = fopen($filePath, "r");
    $transactions = [];
    fgetcsv($file);
    while ($line = fgetcsv($file)) {
        if ($helper !== null) {
            $line = $helper($line);
        }
        $transactions[] = $line;
    }
    fclose($file);
    return $transactions;
}

function extractTransaction(array $line): array
{
    [$date, $checkNumber, $description, $amount] = $line;
    $amount = str_replace(["$", ","], "", $amount);
    if (str_contains($amount, "(")) {
        $amount = "-" . str_replace([")", "("], "", $amount);
    }
    return [
        'date' => $date, 'checkNumber' => $checkNumber, 'description' => $description, 'amount' => (float)$amount];
}

function calculateTotals(array $transactions): array
{
    $totals = ["totalExpence" => 0, "totalIncome" => 0, "netTotal" => 0];
    foreach ($transactions as $transaction) {
        if ($transaction["amount"] < 0) {
            $totals["totalExpence"] += $transaction["amount"];
        } elseif ($transaction["amount"] > 0) {
            $totals["totalIncome"] += $transaction["amount"];
        }
        $totals["netTotal"] += $transaction["amount"];
    }
    return $totals;
}

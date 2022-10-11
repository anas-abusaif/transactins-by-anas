<?php

declare(strict_types=1);

define("ROOT", __DIR__ . "\.." . DIRECTORY_SEPARATOR);

require ROOT . "app\controlers.php";
$transactionsFiles = getTransactionsFiles(ROOT . "transaction-files");
$transactions = [];
foreach ($transactionsFiles as $file) {
    $transactions = array_merge($transactions, getTransactions($file, "extractTransaction"));
}
$totals = calculateTotals($transactions);

require ROOT . "app/helpers.php";
require ROOT . "views/transactions-table.php";

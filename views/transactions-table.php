<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?= formatDate($transaction["date"]) ?></td>
                    <td><?= $transaction["checkNumber"] ?></td>
                    <td><?= $transaction["description"] ?></td>
                    <td><?= formatAmount($transaction["amount"]) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">
                    Total Income
                </th>
                <td>
                    <?= formatAmount($totals["totalIncome"]) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">
                    Total Expence
                </th>
                <td>
                    <?= formatAmount($totals["totalExpence"]) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">
                    Net Total
                </th>
                <td>
                    <?= formatAmount($totals["netTotal"]) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
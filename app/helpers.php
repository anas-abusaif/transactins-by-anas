<?php

declare(strict_types=1);
function formatAmount(string $amount): string
{
    if ($amount < 0) {
        return "<span style='color: red;'>$amount$</span>";
    } else {
        return "<span style='color: green;'>$amount$</span>";
    }
}

function formatDate(string $date): string
{
    return date("d m o", strtotime($date));
}

<?php

if (!function_exists('transformNumber')) {
    function transformNumber(int|float $value, int $decimalPlace)
    {
        return is_numeric($value) && floor($value) != $value
            ? number_format($value, $decimalPlace)
            : $value;
    }
}

if (!function_exists('stocksStatus')) {
    function stocksStatus(int|float|string $out, int $stocks): string
    {
        if (is_string($out)) {
            $out = str_replace(',', '', $out);
        }
        $percent = ($out / $stocks) * 100;

        if ($out > $stocks) {
            $percent = 0;
        } else {
            $percent = 100 - $percent;
        }

        if ($percent >= 20) {
            return "<span class='text-success'>In Stocks &UpArrow;</span>";
        } else if ($percent <= 20 && $percent >= 1) {
            return "<span class='text-warning'>LOW &DownArrowUpArrow;</span>";
        } else {
            return "<span class='text-danger'>Out of Stocks &DownArrow;</span>";
        }
    }
}

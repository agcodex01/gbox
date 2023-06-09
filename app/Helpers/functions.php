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
    function stocksStatus(int|float $out, int $stocks): string
    {
        $percent = $stocks / $out;
        if ($percent >= 20) {
            return "<span class='text-success'>In Stocks &UpArrow;</span>";
        } else if ($percent <= 20 && $percent >= 1) {
            return "<span class='text-warning'>LOW &DownArrowUpArrow;</span>";
        } else {
            return "<span class='text-danger'>Out of Stocks &DownArrow;</span>";
        }
    }
}

<?php

function format_price($price) {
    if (strpos($price, '.') !== false) {
        $numeric_price = str_replace(',', '.', $price);
        $parts = explode('.', $numeric_price);
        $decimal_part = isset($parts[1]) ? str_pad($parts[1], 3, '0', STR_PAD_RIGHT) : '';
        return $parts[0] . '.' . substr($decimal_part, 0, 3);
    } else {
        return number_format($price, 0, ',', '.');
    }
}

?>
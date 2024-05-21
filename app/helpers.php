<?php

if (!function_exists('formatIndianCurrency')) {
    function formatIndianCurrency($number)
    {
        $exploded = explode(".", $number);
        $decimal = isset($exploded[1]) ? '.' . $exploded[1] : '';
        $number = $exploded[0];
        $lastThree = substr($number, strlen($number) - 3);
        $restUnits = substr($number, 0, strlen($number) - 3); // Extract digits except last 3 digits

        if (strlen($number) > 3) {
            $restUnits = (strlen($restUnits) % 2 == 1) ? "0" . $restUnits : $restUnits;
            $numChunks = str_split($restUnits, 2);
            $formatted = implode(",", $numChunks);
            $formatted = (substr($formatted, 0, 1) == "0") ? substr($formatted, 1) : $formatted;
            $formattedCurrency = $formatted . "," . $lastThree;
        } else

            $formattedCurrency = $number;

        return $formattedCurrency . $decimal;
    }
}

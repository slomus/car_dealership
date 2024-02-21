<?php

if (!function_exists('money')) {
    function money($float)
    {
        $float = (float) str_replace(',', '.', (string) $float);
        return preg_replace('/^-(0(,00)?)$/', '$1', number_format($float, 2, ',', ' ')) . ' zł';
    }
}
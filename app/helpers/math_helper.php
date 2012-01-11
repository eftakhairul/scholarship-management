<?php
if (!function_exists('getPercentage')) {
    function getPercentage($dividend, $divisor)
    {
        if(!$divisor) {
            return 0.00;
        }

        return number_format($dividend / $divisor * 100, 2);
    }
}
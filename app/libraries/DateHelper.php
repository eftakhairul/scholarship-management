<?php

/**
 * DateHelper
 *
 * @author eftakhairul
 */

class DateHelper
{
    public static function mysqlToHuman ($date)
    {
        $date = strtotime($date);
        return mdate('%d %M %Y', $date);
    }

    public static function humanToMysql ($date)
    {
        $date = strtotime($date);

        if($date === false) {
            return false;
        }

        return date ('Y-m-d', $date);
    }

    public static function humanCurrentDate ()
    {
        return mdate('%d %M %Y');
    }

    public static function getMonthNames()
    {
        $months = array();

        for($i = 1; $i < 13; $i++){
            $months[$i]['name'] = date("F",  mktime(0,0,0,$i));
            $months[$i]['index'] = date("d",  mktime(0,0,0,1, $i));
        }

        return $months;
    }

    public static function phpToMysql()
    {
        return mdate('%Y-%m-%d');
    }
}
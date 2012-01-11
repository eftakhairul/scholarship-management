<?php

function mysql_to_human ($date)
{
    $date = strtotime($date);
    return mdate('%d %M %Y', $date);
}

function human_to_mysql ($date)
{
    $date = strtotime($date);
    if($date === false) {
        return false;
    }
    return date ('Y-m-d', $date);
}

//Data coming from System
function human_current_date ()
{
    return mdate('%d %M %Y');
}

//Data coming from System for mysql inserting
function php_to_mysql()
{
    return mdate('%Y-%m-%d');
}


function getMonthNames()
{
    $months= array();
    
    for($i = 1; $i<13; $i++){
        $months[$i]['name'] = date("F",  mktime(0,0,0,$i));
        $months[$i]['index'] = date("d",  mktime(0,0,0,1, $i));
    }
    return $months;
}
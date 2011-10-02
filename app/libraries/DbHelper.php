<?php

/**
 * DbHelper
 *
 * @author Eftakhairul
 */

class DbHelper
{
    public static function getWhere($filters, $extra = array())
    {
        $filtersArray = array();

        foreach ($filters AS $key => $value) {
            if (!empty($value)) {
                $filtersArray[] .= "`$key` = '" . mysql_real_escape_string($value) . "'";
            }
        }

        $filtersArray = array_merge($filtersArray, $extra);

        if (count($filtersArray) > 0) {
            $whereClause = "WHERE " . implode(" AND ", $filtersArray);
        } else {
            $whereClause = "";
        }
        
        return $whereClause;
    }
}
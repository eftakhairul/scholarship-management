<?php

/**
 * Description of RefactorHelper
 *
 * @author Eftakhairul & Abid
 */
class RefactorHelper
{
    public static function eliminateNullField($data)
    {
        foreach($data AS $key => $value) {

            if (!$value) {
                unset($data["{$key}"]);
            }
        }

        return $data;
    }
}
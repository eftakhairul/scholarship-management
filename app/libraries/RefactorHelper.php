<?php

/**
 * Description of RefactorHelper
 *
 * @author  Eftakhairul  Islam <eftakhairul@gmail.com> http://eftakhairul.com
 * @author  Syed Abidur Rahman
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
<?php

/**
 * return the sql date in french
 *
 * @param $date
 * @param $format
 * @return false|string
 */
function formatDate($date, $format = "d/m/Y"){
    return date($format, strtotime($date));
}

/**
 * return the value selected
 *
 * @param $var1
 * @param $var2
 * @return null|string
 */
function selectedValue($var1, $var2)
{
    if ($var1 != $var2) return null;
    return "selected";
}
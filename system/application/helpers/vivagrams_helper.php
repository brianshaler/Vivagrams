<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$getvars = array();
function getvar($name, $default = false)
{
    global $getvars;
    $qs = $_SERVER['REQUEST_URI'];
    if (strpos($qs, "?") !== FALSE)
    {
        $qs = substr($qs, strpos($qs, "?")+1);
    }
    
    if (!isset($getvars) || count($getvars) == 0) { parse_str($qs, $getvars); }
    
    if (array_key_exists($name, $getvars))
    {
        return $getvars[$name];
    }
    return $default;
}

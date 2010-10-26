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

function prep_user ($user)
{
  $user["user_id"] = $user["id"];
  if ($user["user_name"]{0} == "@")
  {
    $user["twitter"] = substr($user["user_name"], 1);
  } else
  if (preg_match('/^[\d]{10}$/', $user["user_name"]) && $user["display_name"] == "")
  {
    $user["display_name"] = substr($user["user_name"], 0, 3) . "-" . substr($user["user_name"], 3, 3) . "-" . substr($user["user_name"], 6, 4);
  }
  if (!isset($user["display_name"]) || $user["display_name"] == "")
  {
    $user["display_name"] = $user["user_name"];
  }
  return $user;
}

function digitsonly ($str)
{
  $digitsonly = "";
  $digits = "1234567890";
  
  for ($i=0; $i<strlen($str); $i++)
  {
    if (strpos($digits, $str{$i}) !== false)
    {
      $digitsonly .= "" + $str{$i};
    }
  }
  
  return $digitsonly;
}
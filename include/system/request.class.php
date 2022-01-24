<?php
/*******************************************************************************
* VMS 3 - EquinoX²
********************************************************************************
* Copyright (c) 2018
* Webseite      http://www.com-dat.de
* Support       http://www.com-dat.de
* Lizenz        http://www.com-dat.de/equinox.php
* Lizenzart     Einzelplatzlizenz (E-Lizenz [EL] / EP-Lizenz [EPL])
********************************************************************************
* VMS 3 - EquinoX² ist keine Freeware
* Alle Rechte liegen bei:
* Jens Baum
* Bertolt-Brecht_Str.16
* D-03226 Vetschau
* E-Mail: info@com-dat.de
********************************************************************************
* Datei: request.class.php
*******************************************************************************/
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
abstract class Request
{
    public static function get($name, $filter = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        return filter_input(INPUT_GET, $name, $filter);
    }
     
    public static function getInt($name)
    {
        self::get($name, FILTER_VALIDATE_INT);
    }
     
    public static function getFloat($name)
    {
        self::get($name, FILTER_VALIDATE_FLOAT);
    }
     
    public static function post($name, $filter = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        return filter_input(INPUT_POST, $name, $filter);
    }
     
    public static function postInt($name)
    {
        self::post($name, FILTER_VALIDATE_INT);
    }
     
    public static function postFloat($name)
    {
        self::post($name, FILTER_VALIDATE_FLOAT);
    }

// wenn mit Post arry gearbeitet wird nur das nehmen
    public static function postarray($name, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING,FILTER_REQUIRE_ARRAY);
    }
    
    public static function postemail($name, $filter = FILTER_VALIDATE_EMAIL)
    {
        return filter_input(INPUT_POST, $name, $filter);
    }

}

?>
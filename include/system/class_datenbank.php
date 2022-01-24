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
* Datei: /include/class_datenbank.php
*******************************************************************************/

class db {
	var $link_id	= 0;
	var $query_id	= 0;
	
	var $server	= '';
	var $user	= '';
	var $password	= '';
	var $database	= '';
	
	function __construct($pageconfig) {
		$this->server = $pageconfig['db_server'];
		$this->user = $pageconfig['db_user'];
		$this->password = $pageconfig['db_passwort'];
		$this->database = $pageconfig['db_datenbank'];
		$pageconfig['db_passwort'] = '';

		$this->connect();
		
		$this->password = '';
	} 

	function connect() {
		$this->link_id = mysqli_connect($this->server, $this->user, $this->password);
		if (!$this->link_id) die("Konnte keine Verbindung zur Datenbank aufbauen");
		if ($this->database != '') $this->select_db($this->database);
	    mysqli_set_charset($this->link_id, "utf8");
    }

	function query($query_string) {
		$this->query_id = mysqli_query($this->link_id,$query_string);
		if (!$this->query_id) die("Falscher SQL-Query: ".$query_string);
		return $this->query_id;
	}

	function select_db($database = '') {
		if ($database != '') $this->database = $database;
		if (!mysqli_select_db($this->link_id,$this->database)) die("Datenbank nicht gefunden: ".$this->database);
	}
    
      public function numrows($query_id)
      {
          if ($query_id)
              $this->query_id = $query_id;
          
		  $this->num_rows = mysqli_num_rows($this->query_id);
          return $this->num_rows;
      }

      public function fetch($query_id, $type = true)
      {
          if ($query_id)
              $this->query_id = $query_id;
          
          if (isset($this->query_id)) {
              $record = ($type) ? mysqli_fetch_array($this->query_id, MYSQLI_ASSOC) : mysqli_fetch_object($this->query_id);
          } else
              $this->error("Invalid query_id: <b>" . $this->query_id . "</b>. Records could not be fetched.");
          
          return $record;
      }

      public function first($string, $type = false)
      {
          $query_id = $this->query($string);
          $record = $this->fetch($query_id, $type);
          $this->free($query_id);
		  
          return $record;
      }

      private function free($query_id)
      {
          if ($query_id)
              $this->query_id = $query_id;
          
          return mysqli_free_result($this->query_id);
      }

      public function insert(string $table = null, $data)
      {
		  if ($table === null or empty($data) or !is_array($data)) {
		  $this->error("Invalid array for table: <b>".$table."</b>.");
		  return false;
		  }
		  $q = "INSERT INTO `" . $table . "` ";
          $v = '';
          $k = '';
          
          foreach ($data as $key => $val) :
              $k .= "`$key`, ";
              if (strtolower($val) == 'null')
                  $v .= "NULL, ";
              elseif (strtolower($val) == 'now()')
                  $v .= "NOW(), ";
              else
                  $v .= "'" . $this->escape($val) . "', ";
          endforeach;
          
          $q .= "(" . rtrim($k, ', ') . ") VALUES (" . rtrim($v, ', ') . ");";
          
          if ($this->query($q)) {
              return $this->insertid();
          } else
              return false;
      }
      
      public function insertid()
      {
          return mysqli_insert_id($this->link_id);
      }

      public function escape($string)
      {
          if (is_array($string)) {
			  foreach ($string as $key => $value) :
				  $string[$key] = $this->escape_($value);
			  endforeach;
		  } else 
			  $string = $this->escape_($string);
		  
		  return $string;
      }
	  
      private function escape_($string)
	  {
		  return mysqli_real_escape_string($this->link_id, $string);
	  }
      
      public function update($table, $data, $where = '1')
      {
		  if ($table === null or empty($data) or !is_array($data)) {
		  $this->error("Invalid array for table: <b>" . $table . "</b>.");
		  return false;
		  }
		  
		  $q = "UPDATE `" . $table . "` SET ";
          foreach ($data as $key => $val) :
              if (strtolower($val) == 'null')
                  $q .= "`$key` = NULL, ";
              elseif (strtolower($val) == 'now()')
                  $q .= "`$key` = NOW(), ";
              elseif (strtolower($val) == 'default()')
                  $q .= "`$key` = DEFAULT($val), ";
			  elseif(preg_match("/^inc\((\-?[\d\.]+)\)$/i",$val,$m))
                  $q.= "`$key` = `$key` + $m[1], ";
              else
                  $q .= "`$key`='" . $this->escape($val) . "', ";
          endforeach;
          $q = rtrim($q, ', ') . ' WHERE ' . $where . ';';
          
          return $this->query($q);
      }
public function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
}
?>
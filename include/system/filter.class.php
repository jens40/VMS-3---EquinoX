<?php
/**
 * @author Jens Baum
 * Baum Portal  12:50
 * @copyright 2015
 */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  final class Filter
  {   
    public static $get = array();
    public static $post = array();
    public static $cookie = array();
    public static $files = array();
    public static $server = array();
    
    public static $msgs = array();
    public static $msg = array();
    public static $showMsg;
    
    public static $content = null;
    public static $admincontent = null;
    public static $do = null;
    
    public function __construct()
    {
          $_GET = self::clean($_GET);
          $_POST = self::clean($_POST);
          $_COOKIE = self::clean($_COOKIE);
          $_FILES = self::clean($_FILES);
          $_SERVER = self::clean($_SERVER);

          self::$get = $_GET;
          self::$post = $_POST;
          self::$cookie = $_COOKIE;
          self::$files = $_FILES;
          self::$server = $_SERVER;
    
          self::getContent();
          self::getAdminContent();
          self::getDo();
          self::postDo();
    }

      public static function clean($data)
      {
          if (is_array($data)) {
              foreach ($data as $key => $value) {
                  unset($data[$key]);

                  $data[self::clean($key)] = self::clean($value);
              }
          } else {
			  if (ini_get('magic_quotes_gpc')) {
				  $data = stripslashes($data);
			  } else {
				  $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
			  }
		  }

          return $data;
      }    
  
  
      /**
       * Filter::getDo()
       * 
       * @return
       */
	private static function getDo()
	{
	  if (isset(self::$get['do'])) {
		  $do = ((string)self::$get['do']) ? (string)self::$get['do'] : false;
		  $do = sanitize($do);
		  
		  if ($do == false) {
			  self::error("You have selected an Invalid Do Method","Filter::getDo()");
		  } else
			  return self::$do = $do;
	  }
	}  

	  private static function postDo()
	  {
		  if (isset(self::$post['do'])) {
			  $do = ((string)self::$post['do']) ? (string)self::$post['do'] : false;
			  $do = sanitize($do);
			  
			  if ($do == false) {
				  self::error("You have selected an Invalid Do Method","Filter::getDo()");
			  } else
				  return self::$do = $do;
		  }
	  }     
      /**
       * Filter::getAction()
       * 
       * @return
       */
	private static function getContent()
	{
	 if (isset(self::$get['content'])) {
	  $content = ((string)self::$get['content']) ? (string)self::$get['content'] : false;
	  $content = sanitize($content);
	  if ($content == false) {
	       return self::$content = "error/404";
      } elseif(!file_exists('include/content/'.$content.'.php')){
        return self::$content = "error/404";
      }else
      	return self::$content = $content;
	 } else{
		  return self::$content = "site/start";
	 }
	}  

      /**
       * Filter::getAction()
       * 
       * @return
       */
	private static function getAdminContent()
	{
	 if (isset(self::$get['admincontent'])) {
	  $admincontent = ((string)self::$get['admincontent']) ? (string)self::$get['admincontent'] : false;
	  $admincontent = sanitize($admincontent);
	  if ($admincontent == false) {
	       return self::$admincontent = "error/404";
      } elseif(!file_exists('include/admin/'.$admincontent.'.php')){
        return self::$admincontent = "error/404";
      }else
      	return self::$admincontent = $admincontent;
	 } else{
		  return self::$admincontent = "start";
	 }
	} 

    public static function msgStatus()
    {
       
        self::$showMsg = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        $i = count((array)self::$showMsg);
        foreach (self::$msgs as $msg) {
            self::$showMsg .= "" . $msg . "\n";
        }
        self::$showMsg .= "</div>";

        return self::$showMsg;
    } 
    
    public static function msgSingleOk($msg, $print = true)
      {
          
          
          self::$showMsg = "<div class=\"alert alert-success\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <span class=\"glyphicon glyphicon-ok\"></span> " . $msg . "
</div>";


              return self::$showMsg;
          
      }  
  }
?>
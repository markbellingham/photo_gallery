<?php

// If it's going to need the database, then it's probably smart to require it before we start
require_once(LIB_PATH.DS.'database.php');

class Photograph extends DatabaseObject {

  protected static $table_name = "photographs";
  protected static $db_fields = array('id', 'filename', 'type', 'caption');

  public $id;
  public $filename;
  public $tyoe;
  public $size;
  public $caption;

  
}
?>

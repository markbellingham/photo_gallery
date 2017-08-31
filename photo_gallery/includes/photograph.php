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

  private $tem_path;
  protected $upload_dir = "images";
  public $errors = array();

  protected $upload_errors = array (
    // http://www.php.net/manual/en/features.file-upload.errors.php
    UPLOAD_ERR_OK         =>  "No errors.",
    UPLOAD_ERR_INI_SIZE   =>  "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE  =>  "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL    =>  "partial upload.",
    UPLOAD_ERR_NO_FILE    =>  "No file.",
    UPLOAD_ERR_NO_TMP_DIR =>  "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE =>  "Can't write to disk.",
    UPLOAD_ERR_EXTENSION  =>  "File upload stopped by extension."
  );

  // Pass in $_FILE(['uploaded_file']) as an argument
  public function attach_file($file) {
    // Perform error checking on the form parameters
    if(!$file || empty($file) || !is_array($file)) {
      // error: nothing uploaded or wrong argument usage
      $this->errors[] = "no file was uploaded.";
      return false;
    } elseif ($file['error'] != 0) {
      // error: report what PHP says went wrong
      $this->errors[] = $this->upload_errors[$file['error']];
      return false;
    } else {
      // Set object attributes to the form parameters
      $this->temp_path  = $file['tmp_name'];
      $this->filename   = basename($file['name']);
      $this->type       = $file['type'];
      $this->size       = $file['size'];
      // Don't worry about daving anything to the database yet.
      return true;
    }
  }

}
?>

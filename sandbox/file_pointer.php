<?php
$file = 'filetest.txt';
if($handle = fopen($file, 'w')) {
  fwrite($handle, "123\n456\n789\n");

  $pos = ftell($handle);

  fseek($handle, $pos -6);
  fwrite($handle, "abcdef");

  rewind($handle);
  fwrite($handle, "xyz");

  fclose($handle);
}

// Beware, it will OVERTYPE!!!
// NOTE: a and a+ will not let you move the pointer
?>

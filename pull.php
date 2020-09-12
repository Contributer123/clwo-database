<?php
  echo "<pre>";
  $result = array();
  chdir('/var/www/html');
  $output = shell_exec('./shell-script.sh');
  echo $output;
  echo "<pre>";
?>


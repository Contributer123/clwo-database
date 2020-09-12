<?php
  echo "Testing Pull Script:";
  echo "<pre>";
  $result = array();
  chdir('/var/www/html');
  echo "Path after changing dir: " .getcwd();
  $output = shell_exec('/home/pi/Desktop/pull_script.sh');
  echo $output;
  $output = exec('cat "helloe"');
  echo "here.sth.".$output;
  echo "<pre>";
?>


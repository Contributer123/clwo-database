<?php
  echo "Testing Pull Script:";
  echo "<pre>";
  $result = array();
  chdir('/var/www/html');
  echo "Path after changing dir: " .getcwd();
  $output = shell_exec('/var/www/html/pull_script.sh');
  echo $output;
  $output = exec('cat "helloe"');
  echo "here.sth.".$output;
  echo "<pre>";
?>


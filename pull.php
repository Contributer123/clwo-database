<?php
  
  
  $dir = "/home/pi/Desktop/";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
    }
    closedir($dh);
  }
}

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


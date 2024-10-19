<?php

//require_once "notLoggedIn.php";
//echo "why?"; //test
$servername = "tcp:eer-sever.database.windows.net,1433";//eer-sever
$username = "EER-admin"; //crrzbzscbr
$password = "ER4sever!"; //ER4sever!
$dbname = "eer-db";


//sqlsrv:server = tcp:eer-sever.database.windows.net,1433
//$conn = new PDO("sqlsrv:server = tcp:eer-sever.database.windows.net,1433; Database = eer-db", "EER-admin", "{your_password_here}");
try {
  $conn = new PDO("sqlsrv:server=$servername; Database=$dbname;", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully </br>"; //test
} catch(PDOException $e) {
  echo "Error: " . $e; // dispable after development
  echo "Connection failed";
  header("location: DBconnectFailed.php");
}

?>

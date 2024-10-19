<?php
ob_start();
session_start();

require_once "loginValidation.php";

$msg = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Connection Failed</title>
</head>

<body>
<?php include_once "navBar.php"; ?>
<div id="form-container">
    <div id="user-form">
        <h1>Data Base Connection Faled</h1>
        <p>try again</p>
        <a href="index.php">Back</a>
    </div>
</div>



</body>
</html>
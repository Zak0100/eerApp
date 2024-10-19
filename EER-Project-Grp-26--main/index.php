<?php
ob_start();
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require_once "dbConnect.php";
require_once "loginValidation.php";

$msg = "";

if (isset($_POST['loginSubmit']))
{
    $msg = loginValidation($conn, $_POST['loginEmail'], md5($_POST['loginPassword']));
}
?>
<!-- add password confirmation, create all other pages from wireframe, add error handling to variables before functions are called -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>
<?php include_once "navBar.php"; ?>
<div id="form-container">
    <div id="user-form">

    <h1>Login</h1>
    <form action="index.php" method="post">
        <label for="loginEmail">Email:</label><br>
        <input type="email" name="loginEmail" placeholder="example@email.com" required><br>

        <label for="loginPassword">Password:</label><br>
        <input type="password" name="loginPassword" minlength="4" required><br><br>

        <input type="submit" name="loginSubmit"><br>
        <div class ="errorMessage"><?php echo $msg ?></div>
    </form>
    <a href="index.php">Back</a>
</div>
</div>

<footer class="footer">
<p>EERCalc © Group 26 2024</p>
</footer>

</body>
</html>
<?php
ob_end_flush();
?>
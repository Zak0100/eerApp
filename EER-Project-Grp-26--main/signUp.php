<?php
ob_start();
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require_once "dbConnect.php";
require_once "createAccount.php";
require_once "emailFunctions.php"; 

$msg = "";

if (isset($_POST['signUpSubmit']))
{    

    $otp = rand(100000, 999999);
    $_SESSION['otp_data'] = array(
    'otp' => $otp,
    'timestamp' => time()
    );
    
    
    if ($_POST['signUpPassword'] === $_POST['confirmAccountPassword'])
    {
        sendEmail($_POST["signUpEmail"]);
        //$msg ="test";
        //var_dump($_POST); //test
        $msg = createAccount($conn, $_POST['signUpEmail'], md5($_POST['signUpPassword']), $_POST["role"]);
        
    } else 
    {
        $msg = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
</head>
<body>

<?php include_once "navBar.php"; ?>
    
<div id="form-container">
    <div id="user-form">
    <h2>Create Account</h2>
        <form enctype="multipart/form-data" method="post">
            <label for="signUpEmail">Email:</label><br>
            <input type="email" name="signUpEmail" placeholder="example@email.com" required><br>

            <label for="signUpPassword">Password:</label><br>
            <input type="password" name="signUpPassword" minlength="4" required><br>

            <label for="confirmAccountPassword">Re-type Password:</label><br>
            <input type="password" name="confirmAccountPassword" minlength="4" required><br>
            
            <label for="role">Role: </label><br>
            <select name="role">
                <option value="Tenant">Tenant</option>
                <option value="Landlord">Landlord</option>
                <option value="Admin">Admin</option>
            </select><br><br>

            <input type="submit" name="signUpSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div>
        </form>
        <a href="index.php">Back</a>
</div>
</div>

<footer class="footer">
<p>EERCalc © Group 26 2024</p>
</footer>

</body>
</html>

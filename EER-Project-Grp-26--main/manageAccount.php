<?php
ob_start();
session_start();
require_once "notLoggedIn.php";
require_once "dbConnect.php";
require_once "changeDetails.php";


$msg = "";

if (isset($_POST['changeDetailsSubmit']))
{    
    if ($_POST['changePassword'] === $_POST['changeAccountPassword'])
    {
        if (preg_match('/[^a-zA-Z0-9]/', $_POST['changePassword']) > 0)
        {
            // $msg = createAccount($conn, $_POST['changeEmail'], md5($_POST['changePassword']), $_POST['userRole']); // need new function for changeDetails()
            $msg = changeDetails($conn, $_POST['changeEmail'], md5($_POST['changeAccountPassword']), $_SESSION['userID']);

        } else 
        {
            $msg = "Password must contain at least 1 special character and 1 number.";
        }
    } else 
    {
        $msg = "Passwords do not match.";
    }
} else if (isset($_POST['deleteAccountSubmit']))
{
    header("Location: deleteUser.php?id=" . $_SESSION['userID']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Manage Account</title>
</head>
<body>
<?php include_once "navBar.php"; ?>
<div id="form-container">
    <div id="user-form">
    <h2>Manage Account</h2>
        <form action="manageAccount.php" method="post">
            <label for="changeEmail">New Email:</label><br>
            <input type="email" name="changeEmail" placeholder="<?php echo $_SESSION['email']?>" required><br>

            <label for="changePassword">New Password:</label><br>
            <input type="password" name="changePassword" minlength="4" required><br>

            <label for="changeAccountPassword">Re-type Password:</label><br>
            <input type="password" name="changeAccountPassword" minlength="4" required><br><br>

            <input type="submit" name="changeDetailsSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div><br>
        </form>
        <form action="manageAccount.php" method="post">
            <input type="submit" name="deleteAccountSubmit" value="Delete my account"><br>
        </form>
        <form action="manageAccount.php" method="post">
            <input type="hidden" value=<?php echo $_SESSION['userID']?>>
        </form>
    </div>
</div>
<footer class="footer">
<p>EERCalc © Group 26 2024</p>
</footer>
</body>
</html>

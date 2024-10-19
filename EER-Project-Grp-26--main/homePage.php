<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require_once "dbConnect.php";
require_once "notLoggedIn.php";
//$_SESSION["userRole"] = "admin"; //test
//var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
</head>

<body>
    <?php include_once "navBar.php"; ?>
    <div class="display-container">
        <h2>Welcome <?php echo $_SESSION['username'];?></h2> 
        <ul>
        <?php switch ($_SESSION["userRole"]):
            case "Admin":?>
                <li><a href="manageUser.php">Manage Users</a></li>
                <li><a href="manageProperty.php">Manage Properties</a></li>
                <li><a href="Property.php">Add New Property</a></li>
                <?php break;
            case "Landlord":?>
                <li><a href="Property.php">Add New Property</a></li>
                <li><a href="userViewProperty.php">Manage Properties</a></li>
                <?php break; 
            case "Tenant":?>
                <li><a href="userViewProperty.php">Search Properties</a></li>
                <li><a href="viewSavedProperty.php">View Saved Properties</a></li>
                <?php break;
        endswitch;?>
        <li><a href="manageAccount.php">manage My Account</a></li>
        </ul>
    </div>

<footer class="footer">
<p>EERCalc © Group 26 2024</p>
</footer>

</body>
</html>

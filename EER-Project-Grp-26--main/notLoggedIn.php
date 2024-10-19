<?php
//checks if not logged in 
if (!isset($_SESSION["loggedIn"]) and ($_SESSION["loggedIn"] != true)) {
    //echo "you should have been logged out bc loggedIn = ".$_SESSION["loggedIn"]."  ";
    
    header("location: logout.php"); // if so redirects the user  to the logout page as to unset any sessions they may have set already. 
}
?>
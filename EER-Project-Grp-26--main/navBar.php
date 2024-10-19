<header class="header">

    <?php //var_dump($_SESSION)//test?>
    <?php if(isset($_SESSION["loggedIn"]) And $_SESSION["loggedIn"] == true ):?>
        <div class="header-text">
            <h1>Energy Efficiency Application</h1>
        </div>
        <div class="header-buttons">
            <?php switch ($_SESSION["userRole"]):
                case "Admin" :?>
                    <a href="manageProperty.php">Manage Properties</a>
                    <a href="manageUser.php">Manage Users</a>
                    <?php break;
                case "Landlord":?>
                    <a href="userViewProperty.php">Manage Properties</a>
                    <a href="Property.php">Add New Property</a>
                    <?php break;
                case "Tenant":?>
                    <a href="userViewProperty.php">Search Properties</a>
                    <a href="viewSavedProperty.php">View Saved Properties</a>
                    <?php break;
            endswitch?>
            <a href="manageAccount.php">View Profile</a>
            <a href="homePage.php">Home</a>
            <a href="logout.php">Log out</a>
        </div>
    <?php else:?>
        <div class="header-text">
            <h1>Energy Efficiency Application</h1>
        </div>
        <div class="header-buttons">
            <a href="signUp.php">Sign Up</a>
            <a href="index.php">Log in</a>
        </div>
    <?php endif;?>
</header>
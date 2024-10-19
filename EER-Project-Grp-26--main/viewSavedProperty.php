<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
require_once "notLoggedIn.php";
$userid = $_SESSION["userID"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Saved Properties</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <?php include_once("navBar.php");?>
    <body>
        <div>
            <?php

            //getting functions
            include 'viewPropertyFunctions.php';


            try{
            $sql ="Select userSavedProperty.propertyID,property.propertyType,property.EER,property.postcode,property.address FROM userSavedProperty 
            INNER JOIN property ON (property.propertyID=userSavedProperty.propertyID) WHERE userSavedProperty.userID=:uid ORDER BY userSavedProperty.ID ASC;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="property-container" eer-rating="<?php echo ratingTocolour($row["EER"])?>">
                <div>
                    Property Type: <?php echo $row["propertyType"]?><br>
                    Energy efficiency rating: <?php echo $row["EER"]?><br>
                    Postcode: <?php echo $row["postcode"]?><br>
                    Address: <?php echo $row["address"]?><br>
                </div>
                <div>
                    <form method="post" action="removeSavedProperty.php">
                        <input type="hidden" name="pid" value="<?php echo $row['propertyID'] ?>">
                        <input type="submit" value="Unsave" name="unsave">
                    </form>
                </div>
            </div>
            
            <?php
            }//for while loop
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </div>
    </body>
    <footer class="footer">
    <p>EERCalc © Group 26 2024</p>
    </footer>
</html>

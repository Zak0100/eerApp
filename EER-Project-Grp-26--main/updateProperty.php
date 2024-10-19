<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
try{
    $msg = "";
    $userID = $_SESSION["userID"];
    $currentDate = date("Y-m-d");
    if (isset($_POST['update']) && $_SESSION['userRole']== 'Admin') {

        if( $_POST['postcode'] == "" ){
            $msg= "Postcode cannot be empty.";
        }elseif( $_POST['address'] == "" ){
            $msg= "Address cannot be empty.";
        }else{
            $_POST['postcode']= trim($_POST['postcode']);
            $_POST['address']= trim($_POST['address']);

            //validation passed 
            $stmt = "UPDATE property SET ownerID=:oid ,propertyType=:propertyType ,postcode=:postcode ,address=:address, addressChanged=:currentDate , addressChangedBy=:currentUser WHERE propertyID = :pid";
            $sql = $conn->prepare($stmt);
            $sql->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
            $sql->bindParam(':oid', $_POST['oid'], PDO::PARAM_INT);
            $sql->bindParam(':propertyType', $_POST['propertyType'], PDO::PARAM_STR);
            $sql->bindParam(':postcode', $_POST['postcode'], PDO::PARAM_STR);
            $sql->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
            $sql->bindParam(':currentDate', $currentDate, PDO::PARAM_INT);
            $sql->bindParam(':currentUser', $userID, PDO::PARAM_INT);
            $sql->execute();
            $msg= "Updated successfully.";
        }
        
    }elseif (isset($_POST['update']) && $_SESSION['userRole']== 'Landlord') {
        if( $_POST['postcode'] == "" ){
            $msg= "Postcode cannot be empty.";
        }elseif( $_POST['address'] == "" ){
            $msg= "Address cannot be empty.";
        }else{
            $_POST['postcode']= trim($_POST['postcode']);
            $_POST['address']= trim($_POST['address']);

            //validation passed 
            $stmt = "UPDATE property SET propertyType=:propertyType ,postcode=:postcode ,address=:address, addressChanged=:currentDate, addressChangedBy=:currentUser  WHERE propertyID = :pid";
            $sql = $conn->prepare($stmt);
            $sql->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
            $sql->bindParam(':propertyType', $_POST['propertyType'], PDO::PARAM_STR);
            // $sql->bindParam(':eer', $_POST['eer'], PDO::PARAM_STR);
            $sql->bindParam(':postcode', $_POST['postcode'], PDO::PARAM_STR);
            $sql->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
            $sql->bindParam(':currentDate', $currentDate, PDO::PARAM_INT);
            $sql->bindParam(':currentUser', $userID, PDO::PARAM_INT);
            $sql->execute();
            $msg = "Updated successfully.";
        }
    }
}catch(PDOException $e){
    echo $e;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Property</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>

    <div class="display-container">

        <div>
            <h2>Update this property?</h2>
        </div>
        <div>
            <?php
                try{
                    if ($_SESSION['userRole']== 'Admin') {
                    
                        $sql = "SELECT propertyID,ownerID,propertyType,postcode,address,reportIssueDate FROM property WHERE propertyID =:pid";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form method="post">
                            <div>
                                    <label>Owner ID</label>
                                    <input  type="text" name = "oid" value="<?php echo $row["ownerID"]; ?>">
                            </div>

                            <div>
                                <label>Property Type</label>
                                <select name="propertyType">
                                    <option value="House">House</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Maisonette">Maisonette</option>
                                    <option value="Bungalow">Bungalow</option>
                                </select>
                            </div>

                            <!-- <div>
                                    <label>EER</label>
                                    <input  type="text" name = "eer" value="<?php echo $row["EER"]; ?>">
                            </div> -->

                            <div>
                                    <label>Postcode</label>
                                    <input  type="text" name = "postcode" value="<?php echo $row["postcode"]; ?>">
                            </div>

                            <div>
                                    <label>Address</label>
                                    <input  type="text" name = "address" value="<?php echo $row["address"]; ?>">
                            </div>


                            <div>
                                <input type="submit" name="update" value="Update">
                            </div>
                            <div class="errorMsg">
                                <?php echo $msg?>
                            </div>
                            <div>
                                    <a href="manageProperty.php">Back</a>
                                </div>
                        </form>


                        <?php
                    }elseif($_SESSION['userRole']== 'Landlord') {
                            $sql = "SELECT propertyID,propertyType,postcode,address FROM property WHERE propertyID =:pid";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
                            $stmt->execute();
                            $row= $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form method="post">
                            <div>
                                <label>Property Type</label>
                                <select name="propertyType">
                                    <option value="House">House</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Maisonette">Maisonette</option>
                                    <option value="Bungalow">Bungalow</option>
                                </select>
                            </div>
                            <!-- <div>
                                    <label>EER</label>
                                    <input  type="text" name = "eer" value="<?php echo $row["EER"]; ?>">
                            </div> -->

                            <div>
                                    <label>Postcode</label>
                                    <input  type="text" name = "postcode" value="<?php echo $row["postcode"]; ?>">
                            </div>

                            <div>
                                    <label>Address</label>
                                    <input  type="text" name = "address" value="<?php echo $row["address"]; ?>">
                            </div>

                            <div>
                                <input type="submit" name="update" value="Update">
                            </div>
                            <div class="errorMsg">
                                <?php echo $msg?>
                            </div>
                            <div>
                                    <a href="userViewProperty.php">Back</a>
                                </div>
                        </form>
                        <?php 
                    }   
            }catch(PDOException $e){
                echo $e;
            }?>
            
        </div>
    
    </div>
    
    </body>
    <footer class="footer">
    <p>EERCalc © Group 26 2024</p>
    </footer>
</html>

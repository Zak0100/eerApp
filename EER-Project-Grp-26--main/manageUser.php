<?php
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
require_once "notLoggedIn.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View User Accounts</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
<!--         <form action="searchUser.php" method="post">
            <input type="text" name="search">
            Search by:  <select name="column">
                        <option value="accountID">Account ID</option>
                        <option value="emailAddress">Email</option>
                        </select>
                        <input type ="submit" name="searchButton" value="Search">
        </form> -->
        <div class="container">
        <div>
            <h2>View Users</h2>
            <div class="table-wrapper">
        <table>
        <thead>
            <tr>
                <th>Account ID</th>
                <th>Email Address</th>
                <th>Date Created</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try{
            $sql = "SELECT accountID,emailAddress,dateCreated,role FROM account WHERE active=1 ORDER BY accountID ASC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?php echo $row["accountID"]?></td>
                <td><?php echo $row["emailAddress"]?></td>
                <td><?php echo $row["dateCreated"]?></td>
                <td><?php echo $row["role"]?></td>
                <td><a href="deleteUser.php?id=<?php echo $row["accountID"];?>">Delete</a></td>
            </tr>
            <?php
            }//for while loop
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </tbody>
        </table>
        </div>
        </div>
        </div>
    </body>
    <footer class="footer">
    <p>EERCalc © Group 26 2024</p>
    </footer>
</html>

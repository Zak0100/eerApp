<head>
    <link rel="stylesheet" href="styles.css"/>
</head>
<?php
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
require_once "notLoggedIn.php";
include_once("navBar.php");
?>
<form action="searchUser.php" method="post">
        <input type="text" name="search">
        Search by:  <select name="column">
                    <option value="accountID">Account ID</option>
                    <option value="emailAddress">Email</option>
                    </select>
                    <input type ="submit" name="searchButton" value="Search">
</form>
<?php
$search = $_POST['search'];
$column = $_POST['column'];
if (isset($_POST['searchButton'])) {
    $sql = "Select accountID,emailAddress,dateCreated,role FROM account WHERE $column like '%$search%' AND active=1 ORDER BY accountID ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // $num_rows = $stmt->fetchColumn();
    // if ($num_rows > 0){
?>
        <div>
        <h2>View Users</h2>
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
            while($row = $stmt->fetch(PDO::FETCH_ASSOC);){
                if(isset($row)){
        ?>
        <tr>                
            <td><?php echo $row["accountID"]?></td>
            <td><?php echo $row["emailAddress"]?></td>
            <td><?php echo $row["dateCreated"]?></td>
            <td><?php echo $row["role"]?></td>
            <td><a href="deleteUser.php?id=<?php echo $row["accountID"];?>">Delete</a></td>
        </tr>
        <?php
                }else {
                    echo "No results found";
                }
            }//for while loop
        }catch(PDOException $e){
            echo $e;
        }
        ?>
        </tbody>
        </table>
        </div>
<?php
//}//if result
// else {
// 	echo "No results found";
// }
}//if isset
?>

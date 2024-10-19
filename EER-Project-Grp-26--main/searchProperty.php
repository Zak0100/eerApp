<head>
    <link rel="stylesheet" href="styles.css"/>
</head>

<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
include_once("search.php");
$search = $_POST['search'];
$column = $_POST['column'];
if (isset($_POST['searchButton'])) {
    $sql = "Select propertyID,propertyType,EER,postcode,address FROM property WHERE $column like '%$search%' ORDER BY propertyID ASC;";
    $result = $conn->prepare($sql);
    $result->execute();

    while($row = $result->fetch(PDO::FETCH_ASSOC) ){
        if (isset($row)){
?>
            <div>
                Property Type: <?php echo $row["propertyType"]?><br>
                Energy efficiency rating: <?php echo $row["EER"]?><br>
                Postcode: <?php echo $row["postcode"]?><br>
                Address: <?php echo $row["address"]?><br>
            </div>
            <div>
                <form method="post" action="saveProperty.php">
                    <input type="hidden" name="pid" value="<?php echo $row['propertyID'] ?>">
                    <input type="submit" value="Save" name="save">
                </form>
            </div>
<?php
        }//2nd if isset
        else {
            echo "No results found";
        }
    }//for while
}//if isset
?>
<footer class="footer">
    <p>EERCalc © Group 26 2024</p>
</footer>

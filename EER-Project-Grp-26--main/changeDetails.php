<?php
function changeDetails($conn, $email, $password, $accountID)
{
    $sql = "UPDATE account SET emailAddress = :email, password = :password WHERE accountID = :accountID;";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);

    if (isset($_SESSION['userID']))
    {
        $stmt->execute();
        $_SESSION['username'] = str_replace("."," ",explode("@", $email)[0]);
        return "Details updated successfully!";
    } else 
    {
        return "Something went wrong!";
    }
}
?>
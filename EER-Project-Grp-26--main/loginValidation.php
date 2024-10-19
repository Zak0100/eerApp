<?php
function loginValidation($conn, $email, $hashPassWord) {
    try
    {
        $sql = "SELECT * FROM account WHERE emailAddress = :email AND password = :password AND active = 1";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashPassWord, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            $_SESSION['userID'] = $result['accountID'];
            $_SESSION['userRole'] = $result['role'];
            $_SESSION['username'] = str_replace("."," ",explode("@",$result['email'])[0]);
            $_SESSION["loggedIn"] = true;

            header("location: homePage.php");
            echo"logged in";
            exit();
        } else 
        {
            return "Invalid email or password.";
        }
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>
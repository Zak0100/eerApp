<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
//require_once "loginValidation.php";
require_once "dbConnect.php";

$otp_expiry_time = 10 * 60; // Code Lasts 10 Minutes

$otp_data = isset($_SESSION['otp_data']) ? $_SESSION['otp_data'] : null;


if ($otp_data && time() - $otp_data['timestamp'] < $otp_expiry_time) {
    
    $otp = $otp_data['otp'];

    
    $otp_from_url = isset($_GET['otp']) ? $_GET['otp'] : null;
    
    if ($otp_from_url) {
        
        
        if ($otp_from_url == $otp) {
            try{
                $email = $_SESSION["EmailUsed"];
                // setting verifyEmail to 1 in DB 
                $sql = "UPDATE account SET verifyEmail = ? WHERE emailAddress = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([1,$email]);

                // logging User in
                $sql = "SELECT * FROM account WHERE emailAddress = :email";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['userID'] = $result['accountID'];
                $_SESSION['userRole'] = $result['role'];
                $_SESSION['username'] = str_replace("."," ",explode("@",$result['email'])[0]);
                $_SESSION["loggedIn"] = true;
                if($result['role'] == "Admin"){
                    ?>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="styles.css">
                        <title>Admin Create Account</title>
                    </head>
                    <body>
                        
                    <div id="form-container">
                        <div id="user-form">
                            <h2>Please Wait for one of our existing Admins To verrify your Account</h2>
                        </div>
                    </div>
                    </body>
                    </html>
                    <?php
                }else{
                    // var_dump($_SESSION);
                    // var_dump($result);
                    header("location: homePage.php");
                }
                
                //echo"logged in";// test 


            } catch (PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
            
            
            exit;
        } else {
            
            echo "OTP from session: " . $otp . "<br>";
            echo "OTP from URL: " . $otp_from_url . "<br>";

            echo "Invalid OTP.";
        }
    } else {
        
        echo "OTP is missing from the URL.";
    }
} else {
    
    echo "OTP session data is expired or missing.";
}

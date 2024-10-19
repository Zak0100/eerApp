<?php

function addProperty($conn, $ownerID, $EER, $postcode, $address,  $propertyType)
{
    try{
        $currentDate = date('Y-m-d');

        $sql1 = "SELECT * FROM property WHERE address = :address";

        $stmt1 = $conn->prepare($sql1);

        $stmt1->bindParam(':address', $address, PDO::PARAM_STR);

        $stmt1->execute();

        $result = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            return "Property already exists.";
        } else 
        {
            $sql2 = "INSERT INTO property (ownerID, EER, postcode, address, addressChanged, addressChangedBy, propertyType, reportIssueDate) VALUES (:ownerID, :EER, :postcode, :address, :addressChanged, :addressChangedBy, :propertyType, :reportIssueDate)";

            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':ownerID', $ownerID, PDO::PARAM_INT);
            $stmt2->bindParam(':EER', $EER, PDO::PARAM_STR);
            $stmt2->bindParam(':postcode', $postcode, PDO::PARAM_STR);
            $stmt2->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt2->bindParam(':addressChanged', $currentDate, PDO::PARAM_INT);
            $stmt2->bindParam(':addressChangedBy', $ownerID, PDO::PARAM_INT);
            $stmt2->bindParam(':propertyType', $propertyType, PDO::PARAM_STR);
            $stmt2->bindParam(':reportIssueDate', $currentDate, PDO::PARAM_INT);
            $stmt2->execute();

            return "Property added!";
        }
    }catch(PDOException $e) {
        echo "Error: " . $e; // dispable after development
        return "Error";
    }
}
?>
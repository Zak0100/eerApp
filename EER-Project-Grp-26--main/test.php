<?php

$sql1 = 'INSERT INTO account (emailAddress, password, role) VALUES (:email, :password, :role);';
$stmt1 = $conn->prepare($sql1);

$stmt1->bindParam(':email', $email, PDO::PARAM_STR);

$stmt1->bindParam(':password', $hashPassword, PDO::PARAM_STR);

$stmt1->bindParam(':role', $role, PDO::PARAM_STR);

$stmt1->bindParam(':active', 1 , PDO::PARAM_INT);
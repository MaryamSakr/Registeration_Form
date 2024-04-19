<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["full-name"];
    $userName = $_POST["user-name"];
    $phoneNum = $_POST["phone-num"];
    $pass = $_POST["password"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $birthDate = $_POST["birthdate"];
    $imageName = $_POST["image-upload"];

    try {
        require_once "DB_Ops.php";
        $user = "INSERT INTO users (full_name , user_name , birthdate , phone , addrs , pass , Email,imageName )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($user);
        $stmt->execute([$fullName, $userName, $birthDate, $phoneNum, $address, $pass, $email , $imageName]);
        exit();
    } catch (PDOException $e) {
        echo '<script>alert("User Name Already Exist");</script>';
        
    }

} else {
    header("Location: ../index.php");

}
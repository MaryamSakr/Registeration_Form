<?php
    $fullName = $_POST["full-name"];
    $userName = $_POST["user-name"];
    $phoneNum = $_POST["phone-num"];
    $pass = $_POST["password"];
    $confirm_pass = $_POST["confirm-password"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $birthDate = $_POST["birthdate"];
    $imageName = $_FILES["image-upload"]["name"];
    try {
        require "DB_Ops.php";
        $user = "INSERT INTO users (full_name , user_name , birthdate , phone , addrs , pass , Email,imageName )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($user);
        $stmt->execute([$fullName, $userName, $birthDate, $phoneNum, $address, $pass, $email , $imageName]);
        echo 'success';
    } catch (PDOException $e) {
        echo 'error';      
    }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $fullName = $_POST["full-name"];
//     $userName = $_POST["user-name"];
//     $phoneNum = $_POST["phone-num"];
//     $pass = $_POST["password"];
//     $email = $_POST["email"];
//     $address = $_POST["address"];
//     $birthDate = $_POST["birthdate"];
//     $imageName = $_FILES["image-upload"]["name"];
//     try {
//         require "DB_Ops.php";
//         $user = "INSERT INTO users (full_name , user_name , birthdate , phone , addrs , pass , Email,imageName )
//         VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
//         $stmt = $pdo->prepare($user);
//         $stmt->execute([$fullName, $userName, $birthDate, $phoneNum, $address, $pass, $email , $imageName]);
//         $fileData = urlencode(serialize($_POST['image-upload']));
//         $fileTmpName = $_FILES['image-upload']['tmp_name'];
//         $fileSize = $_FILES['image-upload']['size'];
//         $fileError = $_FILES['image-upload']['error'];
//         header("Location: Upload.php?fileData=$fileData&imageName=$imageName&fileTmpName=$fileTmpName&fileSize=$fileSize&fileError=$fileError");
//         exit();
//     } catch (PDOException $e) {
//         echo '<script>alert("User Name Already Exist");</script>';
        
//     }

// } else {
//     header("Location: ../index.php");

// }

?>
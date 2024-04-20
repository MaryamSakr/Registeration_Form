<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo "<script>alert('upload')</script>";
        $file = $_FILES['image-upload'];
    
        $fileName = $_FILES['image-upload']['name'];
        $fileTmpName = $_FILES['image-upload']['tmp_name'];
        $fileSize = $_FILES['image-upload']['size'];
        $fileError = $_FILES['image-upload']['error'];
        $fileType = $_FILES['image-upload']['type'];
        $fullName = $_POST["full-name"];
        $userName = $_POST["user-name"];
        $phoneNum = $_POST["phone-num"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $birthDate = $_POST["birthdate"];
        $fullNameEncoded = urlencode($fullName);
        $userNameEncoded = urlencode($userName);
        $phoneNumEncoded = urlencode($phoneNum);
        $passEncoded = urlencode($pass);
        $emailEncoded = urlencode($email);
        $addressEncoded = urlencode($address);
        $birthDateEncoded = urlencode($birthDate);
        
    
        $fileExt = explode('.' , $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        if ($fileError === 0) {
            if ($fileSize < 5000000) {
                $fileNameNew = uniqid('' , true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                if(move_uploaded_file($fileTmpName,$fileDestination)){
                    echo "File Temp Name: " . $fileTmpName . "<br>";
                    echo "<script>alert('$fileTmpName')</script>";
                    header("Location: FormEdit.php?fullName=$fullNameEncoded&userName=$userNameEncoded&phoneNum=$phoneNumEncoded&pass=$passEncoded&email=$emailEncoded&address=$addressEncoded&birthDate=$birthDateEncoded&imageName=$fileNameNew");
                }else{
                    echo "<script>alert('Your Image Not Uploading!')</script>";
                }
            }else{
                echo "<script>alert('Your Image Is Too Big!')</script>";
            }
        }else{
            echo "<script>alert('There Was An Error Uploading Your Image!')</script>";
        }
    }

    // echo "<script>alert('upload')</script>";
    // $fileDataEncoded = unserialize(urldecode($_GET['fileData']));
    // $fileName = $_GET['imageName'];
    // $fileTmpName = $_GET['fileTmpName'];
    // $fileSize = $_GET['fileSize'];
    // $fileError = $_GET['fileError'];
    // echo "File Temp Name: " . $fileTmpName . "<br>";
    // echo "<script>alert('$fileTmpName')</script>";
    // $fileExt = explode('.' , $fileName);
    // $fileActualExt = strtolower(end($fileExt));
    // if ($fileError === '0') {
    //     if ($fileSize < 5000000) {
    //         $fileDestination = 'uploads/'.$fileName;
    //         if(move_uploaded_file($fileTmpName,$fileDestination)){
    //             header("Location: index.php?uploaduccess");
    //             exit();
    //         }else{
    //             echo "<script>alert('Your Image Not Uploading!')</script>";
    //         }
    //     }else{
    //         echo "<script>alert('Your Image Is Too Big!')</script>";
    //     }
    // }else{
    //     echo "<script>alert('There Was An Error Uploading Your Image!')</script>";
    // }

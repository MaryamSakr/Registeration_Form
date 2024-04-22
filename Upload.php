<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $file = $_FILES['image-upload'];
    
        $fileName = $_FILES['image-upload']['name'];
        $fileTmpName = $_FILES['image-upload']['tmp_name'];
        $fileSize = $_FILES['image-upload']['size'];
        $fileError = $_FILES['image-upload']['error'];
        $fileType = $_FILES['image-upload']['type'];
        
    
        $fileExt = explode('.' , $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        if ($fileError === 0) {
            if ($fileSize < 5000000) {
                $fileDestination = 'uploads/' . $fileName;
                if(move_uploaded_file($fileTmpName, $fileDestination)){
                    echo json_encode(['success' => true, 'queryString' => $fileName]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Your Image Not Uploading!']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Your Image Is Too Big!']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'There Was An Error Uploading Your Image!']);
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

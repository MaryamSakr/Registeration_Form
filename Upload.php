<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($POST['image-upload'])){
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
            $fileNameNew = uniqid('' , true).".".$fileActualExt;
            $fileDestination = 'uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
            header("Location: index.php?uploadsuccess");
        }else{
            echo "Your Image Is Too Big!";
        }
    }else{
        echo "There Was An Error Uploading Your Image!";
    }
}
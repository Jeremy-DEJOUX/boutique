<?php 

if (isset($_POST['submit'])) {
    
    $newFileName = $_POST['filename'];
    if (empty($newFileName)){
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imgTitle      = $_POST['filetitle'];
    $imgDesc       = $_POST['filedesc'];

    $file          = $_FILES['file'];

    $fileName      = $file['name'];
    $fileType      = $file['type'];
    $fileTempName  = $file['tmp_name'];
    $fileError     = $file['error'];
    $fileSize      = $file['size'];

    $fileExt       = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed       = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0) {
            if ($fileSize < 2000000) {
                $imageFullName   = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../img/gallery/" . $imageFullName;

                include_once "dbh.inc.php";


                if (empty($imgTitle) || empty($imgDesc)) {
                    header("Location: ../gallery.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM gallery";
                    $stmt          = $conn->query($sql);
                    $rowCount      = $stmt->fetchColumn();
                    $setImageOrder = $rowCount + 1;

                    $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (:title, :description, :img, :order)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':title', $imgTitle, PDO::PARAM_STR);
                    $stmt->bindParam(':description', $imgDesc, PDO::PARAM_STR);
                    $stmt->bindParam(':img', $imageFullName, PDO::PARAM_STR);
                    $stmt->bindParam(':order', $setImageOrder, PDO::PARAM_INT);
                    $stmt->execute();

                    move_uploaded_file($fileTempName, $fileDestination);

                    header("Location: ../gallery.php?upload=success");
                }
            } else {
                echo "File size is too big!";
                exit();
            }
        } else {
            echo "You had an error!";
            exit();
        }
    } else{
        echo "You need to upload a proper file type!";
        exit();
    }



}
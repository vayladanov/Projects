<?php
/*
File that can upload and download files of certain types to a folder
Version 0.1.0 13/03/2019
*/
$targetDir = "uploads/"; //assumes a child directory to the one where this file is located
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$valid = 1;
$allowedFiles = array("image/png", "image/jpeg", "image/gif", "application/pdf", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "text/plain");
$allowedImages = array("png", "jpg", "jpeg", "img", "gif");

if(isset($_POST["fileUpload"])) {
    if (in_array($_FILES["fileToUpload"]["type"], $allowedFiles)) {
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if (in_array($imageFileType, $allowedImages)) {
            echo "Image";
            echo "<br />";
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is indeed an image - " . $check["mime"] . ".";
                echo "<br />";
                $valid = 1;
            } else {
                echo "File is not an image.";
                echo "<br />";
                $valid = 0;
            }
        } else {
            echo "File format is allowed!";
            echo "<br />";
        }
    } else {
        echo "File format is NOT allowed!";
        echo "<br />";
        $valid = 0;
    }

    if ($_FILES["fileToUpload"]["size"] < 20971520) { //20mb there is also 20mb post limit set and also the file size limit for upload is limited to 20mb - settings of my server
        echo "Size is ok";
        echo "<br />";
    } else {
        $valid = 0;
        echo "File is too large! Needs to be smaller than 20 mb.";
        echo "<br />";
    }

    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        echo "<br />";
        $valid = 0;
    }

    if ($valid == 0) {
        echo "Sorry not possible to upload this file.";
        echo "<br />";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) { //if you are having troubles at this point check the permissions of tmp and uploads folders
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} ?>

<form action="fileUpload.php" method="post" enctype="multipart/form-data"> <!-- the action has to be the file that handles the upload process. In this case its the same file -->
    Select image to upload:
    <input type="file" name="fileToUpload">
    <input type="submit" value="Upload Image" name="fileUpload">
</form><?php

$filesForDownload = array_diff(scandir($targetDir), array('..', '.'));
sort($filesForDownload);

for ($i=0; $i < count($filesForDownload); $i++) {
    $imageFileTypeDw = strtolower(pathinfo($filesForDownload[$i],PATHINFO_EXTENSION));
    // echo $filesForDownload[$i]; //if we want to see the name of the file being downloaded I guess we do just annoys me atm
    if (in_array($imageFileTypeDw, $allowedImages)) { ?>
        <a href="<?php echo $targetDir . $filesForDownload[$i]; ?>" download><img style="width: 40px; height: 40px;" src="<?php echo $targetDir . $filesForDownload[$i]; ?>" alt=""></a><?php
    } else {?>
        <a href="<?php echo $targetDir . $filesForDownload[$i]; ?>" download><img style="width: 40px; height: 40px;" src="../user.svg" alt=""></a><?php
    }
} ?>

<?php
//start php session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

function UploadImage(){
    $target_dir = "./files/";
    $image_code = rand(9999, 100000);
    $target_file = $target_dir  . $image_code . "_" . basename($_FILES["file"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
        || $imageFileType != "gif" || $imageFileType != "docs") {
         if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            return  $image_code . "_" . basename($_FILES["file"]["name"]);
        }else{
            echo "<script>
            alert('Error Uploading File');
            window.location.href='../addStudyMaterialPage.php';
            </script>";
            exit;
        }
    }else{
            echo "<script>
            alert('File Not Supported');
            window.location.href='../addStudyMaterialPage.php';
            </script>";
            exit;
}
} 

if (isset($_POST["submit"])) {

    $chapter = mysqli_escape_string($GLOBALS['conn'], $_POST["chapter"]);
    $title = mysqli_escape_string($GLOBALS['conn'], $_POST["title"]);
    $desc = mysqli_escape_string($GLOBALS['conn'], $_POST["desc"]);

    $filename = UploadImage();
    $location = "files/". $filename ;

    $query = "INSERT INTO tbl_material(sm_tchId, sm_chapter, sm_title, sm_desc, sm_fileLoc) 
    VALUES ('" . $_SESSION['user_id'] . "','" . $chapter . "','" . $title . "', '" . $desc . "', '" . $location . "');";
    

    if (mysqli_query($GLOBALS['conn'], $query)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "AddMaterial";
        Header("Location:../studyMaterialPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AddMaterial";
        Header("Location:../studyMaterialPage.php");
    }
} else {
    Header("Location:../addStudyMaterialPage.php");
}



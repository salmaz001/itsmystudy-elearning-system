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
            window.location.href='../editLessonPage.php';
            </script>";
            exit;
        }
    }else{
            echo "<script>
            alert('File Not Supported');
            window.location.href='../editLessonPage.php';
            </script>";
            exit;
}
} 

if (isset($_POST["edit"])) {

    // foreach ($_POST as $key => $value) {
    //     echo $key . ' = ' . $value . '<br>';
    // }
    // die();

    $title = mysqli_escape_string($GLOBALS['conn'], $_POST["title"]);
    $desc = mysqli_escape_string($GLOBALS['conn'], $_POST["desc"]);

    if (empty($_FILES["file"]["name"])) {
        $location = $_POST["file_loc"];
    } else {
        $filename = UploadImage();
        $location = "files/". $filename ;
    }
    // echo $filename;
    // die();

    $query = "UPDATE tbl_material SET sm_title = '" . $title . "' ,sm_desc = '" . $desc . "' ,sm_fileLoc = '" . $location . "', sm_dateUpdated = NOW() WHERE sm_id = '" . $_POST["lesson_id"] . "' AND sm_tchId = '" . $_POST["tch_id"] . "';";
    // echo $query; die();
    
    if (mysqli_query($GLOBALS['conn'], $query)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "EditMaterial";
        Header("Location:../studyMaterialPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "EditMaterial";
        Header("Location:../studyMaterialPage.php");
    }
} else {
    Header("Location:../editLessonPage.php");
}



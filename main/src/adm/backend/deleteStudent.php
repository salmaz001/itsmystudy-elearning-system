<?php
session_start();
include_once '../../../configs/dbconfig.php';
if (isset($_POST['delStud'])) {
    $stud_id = $_POST["stud_id"];

    $query = "Update tbl_users SET u_status = 'X' where u_id = '" . $stud_id . "';";
    // echo $query;

    if (mysqli_query($GLOBALS['conn'], $query)) {
        
                $_SESSION["msg_status"] = "success";
                $_SESSION["msg"] = "DelStud";
                Header("Location:../listStudentPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "DelStud";
        Header("Location:../listStudentPage.php");
    }
} else {
    Header("Location:../listStudentPage.php");
}

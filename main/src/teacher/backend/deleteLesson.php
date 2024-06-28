<?php
session_start();
include_once '../../../configs/dbconfig.php';
if (isset($_POST['delete_lesson'])) {
    $query = "Update tbl_material SET status = 0 WHERE sm_id = '" . $_POST['lesson_id'] . "' AND sm_tchId = '".$_SESSION['user_id']."';";

    // $q1 = "DELETE FROM tbl_stud_material WHERE material_id = '" . $_POST['lesson_id'] . "';";
    // if(mysqli_query($GLOBALS['conn'], $q1)) {
    // $query = "DELETE FROM tbl_material WHERE sm_id = '" . $_POST['lesson_id'] . "' AND sm_tchId = '".$_SESSION['user_id']."';";

    // echo $query;die();

    if (mysqli_query($GLOBALS['conn'], $query)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "DelMaterial";
        Header("Location:../studyMaterialPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "DelMaterial";
        Header("Location:../studyMaterialPage.php");
    }
// }
} else {
    Header("Location:../studyMaterialPage.php");
}
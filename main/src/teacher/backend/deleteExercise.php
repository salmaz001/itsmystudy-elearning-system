<?php
session_start();
include_once '../../../configs/dbconfig.php';
if (isset($_POST['delete_exercise'])) {
    $ex_id = $_POST["ex_id"];

    $query = "Update tbl_exercise SET status = 0 WHERE ex_id = '" . $ex_id . "';";

    if (mysqli_query($GLOBALS['conn'], $query)) {
                $_SESSION["msg_status"] = "success";
                $_SESSION["msg"] = "DelExercise";
                Header("Location:../listExercisePage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "DelExercise";
        Header("Location:../listExercisePage.php");
    }
} else {
    Header("Location:../listExercisePage.php");
}

<?php
//start php session
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

if (isset($_POST["add_feedback"])) {
    $tch_id = $_SESSION["user_id"];
    $feedback = mysqli_escape_string($GLOBALS['conn'], $_POST['feedback']);
    $feedback_id = $_POST['feedback_id'];

    //insert into table feedback
    $queryFeedback = "UPDATE tbl_feedback set tch_review = '" . $feedback . "', tch_id = '" . $tch_id . "', tch_dateAdded = NOW() WHERE id = '" . $feedback_id . "';";
    // echo $queryFeedback; die();

    if (mysqli_query($GLOBALS['conn'], $queryFeedback)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "AddFeedback";
        Header("Location:../listFeedbackPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AddFeedback";
        Header("Location:../listFeedbackPage.php");
    }
} else {
    Header("Location:../listFeedbackPage.php");
}

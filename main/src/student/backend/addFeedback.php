<?php
//start php session
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

if (isset($_POST["add_feedback"])) {
    $std_id = $_SESSION["user_id"];
    $test_id = $_POST['test_id'];
    $feedback = mysqli_escape_string($GLOBALS['conn'], $_POST['feedback']);
    $stud_test_id = $_POST['stud_test_id'];
    $error = 0;

    //insert into table feedback
    $queryFeedback = "INSERT INTO tbl_feedback(test_id, stud_test_id, stud_review, stud_id, stud_dateAdded) 
    VALUES ('" . $test_id . "','" . $stud_test_id . "','" . $feedback . "', '" . $std_id . "', NOW());";
    // echo $queryFeedback; die();

    if (mysqli_query($GLOBALS['conn'], $queryFeedback)) {
        //update
        $query = "Update tbl_stud_test SET feedback_done = 1 where id = '" . $stud_test_id . "';";
        if (mysqli_query($GLOBALS['conn'], $query)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "AddFeedback";
        Header("Location:../listTestPage.php");
        } else {
            $error = 1;
        }
    } else {
        $error = 1;
    }

    if($error) {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AddFeedback";
        Header("Location:../listTestPage.php");
    }
} else {
    Header("Location:../listTestPage.php");
}

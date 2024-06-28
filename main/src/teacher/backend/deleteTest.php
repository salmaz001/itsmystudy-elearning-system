<?php
session_start();
include_once '../../../configs/dbconfig.php';
if (isset($_POST['delete_test'])) {
    $test_id = $_POST["test_id"];

    // $queryOpt = "DELETE FROM tbl_options WHERE test_id = '" . $test_id . "';";
    // echo $queryOpt;
    $query = "Update tbl_test SET status = 0 WHERE test_id = '" . $test_id . "';";

    if (mysqli_query($GLOBALS['conn'], $query)) {
        // $queryQues = "DELETE FROM tbl_ques WHERE test_id = '" . $test_id . "';";
        // if (mysqli_query($GLOBALS['conn'], $queryQues)) {
        //     $queryTest = "DELETE FROM tbl_test WHERE test_id = '" . $test_id . "' AND tch_id = '" . $_SESSION['user_id'] . "';";
        //     if (mysqli_query($GLOBALS['conn'], $queryTest)) {
                $_SESSION["msg_status"] = "success";
                $_SESSION["msg"] = "DelTest";
                Header("Location:../listTestPage.php");
        //     }
        // }
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "DelTest";
        Header("Location:../listTestPage.php");
    }
} else {
    Header("Location:../listTestPage.php");
}

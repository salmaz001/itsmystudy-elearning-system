<?php
//start php session
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

if (isset($_POST["submit_answer"])) {
    $std_id = $_SESSION["user_id"];

    // Retrieve form data
    $quest_no = $_POST['quest_no'];
    $test_id = $_POST['test_id'];
    $tch_id = $_POST['tch_id'];
    $correctAnswer = 0;

    // foreach ($_POST as $key => $value) {
    //     // Echo the key and value
    //     echo "$key: $value <br>";
    //   }
    for ($i = 1; $i <= $quest_no; $i++) {
        if ($_POST['opt' . $i . ''] == $_POST['correct_ans' . $i . '']) {
            $correctAnswer++;
        }
    }
    $marks = ceil(($correctAnswer / $quest_no) * 100);

    //insert into table stud test
    $queryTest = "INSERT INTO tbl_stud_test(test_id, stud_id, tch_id, marks, totCorrectAns, dateTaken) 
    VALUES ('" . $test_id . "','" . $std_id . "','" . $tch_id . "', '" . $marks . "', '" . $correctAnswer . "', NOW());";
    // echo $queryTest; die();

    if (mysqli_query($GLOBALS['conn'], $queryTest)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "AnswerTest";
        Header("Location:../listTestPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AnswerTest";
        Header("Location:../listTestPage.php");
    }
} else {
    Header("Location:../listTestPage.php");
}

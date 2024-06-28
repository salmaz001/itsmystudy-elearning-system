<?php
//start php session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

function UploadImage()
{
    $target_dir = "./files/ques/";
    $target_file = $target_dir  . basename($_FILES["file"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if (
        $imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
        || $imageFileType != "gif" || $imageFileType != "docs"
    ) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            return   basename($_FILES["file"]["name"]);
        } else {
            echo "<script>
            alert('Error Uploading File');
            window.location.href='../addTestPage.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('File Not Supported');
            window.location.href='../addTestPage.php';
            </script>";
        exit;
    }
}

if (isset($_POST["submit_test_final"])) {

    $testName = mysqli_escape_string($GLOBALS['conn'], $_SESSION['ques']['name']);
    $testDesc = mysqli_escape_string($GLOBALS['conn'], $_SESSION['ques']['desc']);
    $testNumQues = $_SESSION['ques']['numQues'];
    $tch_id = $_SESSION["user_id"];

    // Retrieve form data
    $questions = $_POST['question'];
    $options = $_POST['options'];
    $correctAnswers = $_POST['correct_answer'];
    $questionImages = $_FILES['file'];
    $quesNum = 1;
    $error = 0;

    $target_dir = "./files/ques/";

    //insert into table test
    $queryTest = "INSERT INTO tbl_test(test_name, test_desc, test_noQuest, tch_id, created_at) 
    VALUES ('" . $testName . "','" . $testDesc . "','" . $testNumQues . "', '" . $tch_id . "', NOW());";

    if (mysqli_query($GLOBALS['conn'], $queryTest)) {
        //done added test data into db
        $test_id = mysqli_insert_id($GLOBALS['conn']);
        // Loop through the questions
        for ($i = 0; $i < count($questions); $i++) {
            $question = mysqli_escape_string($GLOBALS['conn'], $questions[$i]);

            if (!empty($questionImages['name'][$i])) {
                $image_code = rand(9999, 100000);
                $imageTmpName = $questionImages['tmp_name'][$i];
                $imageName = $image_code . "_" . $questionImages['name'][$i];

                $target_file = $target_dir  . basename($imageName);

                if (move_uploaded_file($imageTmpName, $target_file)) {
                    $imageNameLoc = "files/ques/" . $imageName;
                } else {
                    echo "<script>
                alert('Error Uploading Image');
                window.location.href='../addTestPage.php';
                </script>";
                    exit;
                }
            } else {
                $imageNameLoc = "-";
            }
            $queryQues = "INSERT INTO tbl_ques(ques, test_id, image) 
            VALUES ('" . $question . "','" . $test_id . "','" . $imageNameLoc . "');";

            if (mysqli_query($GLOBALS['conn'], $queryQues)) {

                $ques_id = mysqli_insert_id($GLOBALS['conn']);
                $optionsForQuestion = $options[$quesNum]; // Array of options for the current question
                $correctAnswer = $correctAnswers[$quesNum];

                for ($q = 0; $q < 3; $q++) {
                    $correctOpt = ($correctAnswer == $q + 1) ? 1 : 0;

                    $queryOpt = "INSERT INTO tbl_options(options, ques_id, test_id, correct_ans) 
                        VALUES ('" . mysqli_escape_string($GLOBALS['conn'], $optionsForQuestion[$q]) . "','" . $ques_id . "','" . $test_id . "','" . $correctOpt . "');";
                    if (mysqli_query($GLOBALS['conn'], $queryOpt)) {
                    } else {
                        $error = 1;
                    }
                }
            } else {
                $error = 1;
            }
            $quesNum++;
        }
    } else {
        $error = 1;
    }

    if ($error == 0) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "AddTest";
        Header("Location:../listTestPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AddTest";
        Header("Location:../listTestPage.php");
    }
} else {
    Header("Location:../addTestPage.php");
}

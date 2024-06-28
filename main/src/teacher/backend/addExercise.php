<?php
//start php session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';

function UploadImage()
{
    $target_dir = "./files/ex_ques/";
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
            window.location.href='../addExercisePage.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('File Not Supported');
            window.location.href='../addExercisePage.php';
            </script>";
        exit;
    }
}

if (isset($_POST["submit_ex_final"])) {

    $exName = mysqli_escape_string($GLOBALS['conn'], $_SESSION['ex_ques']['name']);
    $exDesc = mysqli_escape_string($GLOBALS['conn'], $_SESSION['ex_ques']['desc']);
    $exNumQues = $_SESSION['ex_ques']['numQues'];
    $tch_id = $_SESSION["user_id"];

    // Retrieve form data
    $questions = $_POST['question'];
    $options = $_POST['options'];
    $correctAnswers = $_POST['correct_answer'];
    $questionImages = $_FILES['file'];
    $quesNum = 1;
    $error = 0;

    $target_dir = "./files/ex_ques/";

    //insert into table ex
    $queryEx = "INSERT INTO tbl_exercise(ex_name, ex_desc, ex_noQuest, tch_id, created_at) 
    VALUES ('" . $exName . "','" . $exDesc . "','" . $exNumQues . "', '" . $tch_id . "', NOW());";

    if (mysqli_query($GLOBALS['conn'], $queryEx)) {
        //done added ex data into db
        $ex_id = mysqli_insert_id($GLOBALS['conn']);
        // Loop through the questions
        for ($i = 0; $i < count($questions); $i++) {
            $question = mysqli_escape_string($GLOBALS['conn'], $questions[$i]);

            if (!empty($questionImages['name'][$i])) {
                $image_code = rand(9999, 100000);
                $imageTmpName = $questionImages['tmp_name'][$i];
                $imageName = $image_code . "_" . $questionImages['name'][$i];

                $target_file = $target_dir  . basename($imageName);

                if (move_uploaded_file($imageTmpName, $target_file)) {
                    $imageNameLoc = "files/ex_ques/" . $imageName;
                } else {
                    echo "<script>
                alert('Error Uploading Image');
                window.location.href='../addExercisePage.php';
                </script>";
                    exit;
                }
            } else {
                $imageNameLoc = "-";
            }
            $queryQues = "INSERT INTO tbl_ex_ques(ques, ex_id, image) 
            VALUES ('" . $question . "','" . $ex_id . "','" . $imageNameLoc . "');";

            if (mysqli_query($GLOBALS['conn'], $queryQues)) {

                $ques_id = mysqli_insert_id($GLOBALS['conn']);
                $optionsForQuestion = $options[$quesNum]; // Array of options for the current question
                $correctAnswer = $correctAnswers[$quesNum];

                for ($q = 0; $q < 3; $q++) {
                    $correctOpt = ($correctAnswer == $q + 1) ? 1 : 0;

                    $queryOpt = "INSERT INTO tbl_ex_opt(options, ques_id, ex_id, correct_ans) 
                        VALUES ('" . mysqli_escape_string($GLOBALS['conn'], $optionsForQuestion[$q]) . "','" . $ques_id . "','" . $ex_id . "','" . $correctOpt . "');";
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
        $_SESSION["msg"] = "AddExercise";
        Header("Location:../listExercisePage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "AddExercise";
        Header("Location:../listExercisePage.php");
    }
} else {
    Header("Location:../addExercisePage.php");
}

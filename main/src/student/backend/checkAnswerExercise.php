<?php
session_start();
include_once '../../../configs/dbconfig.php';

// Check if the AJAX request contains the selected option and question ID
if (isset($_POST['selectedOption']) && isset($_POST['questionId'])) {
    $selectedOption = $_POST['selectedOption'];
    $questionId = $_POST['questionId'];

    // Retrieve the correct answer from the database
    $query = "SELECT correct_ans FROM tbl_ex_opt WHERE opt_id = '$selectedOption' AND ques_id = '$questionId' LIMIT 1";
    $result = mysqli_query($GLOBALS['conn'], $query);
    $row = mysqli_fetch_assoc($result);

    // Compare the selected option with the correct answer
    if ($row['correct_ans'] == 1) {
        $response = '<div class="alert alert-success fade show" role="alert">
        Correct Answer!
      </div>';
    } else {
        $response = '<div class="alert alert-danger fade show" role="alert">
        Incorrect Answer!
      </div>';
    }

    // Return the response
    echo $response;
} else {
    // Return an error message if the required data is not provided
    echo 'Error: Invalid request!';
}
?>

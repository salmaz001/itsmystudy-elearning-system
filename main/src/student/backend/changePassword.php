<?php
session_start();
include_once '../../../configs/dbconfig.php';

if (isset($_POST["change_pwd"])) {
    $error = 0;
    $cur_pwd = $_POST['curr_password'];
    $new_password = $_POST['password'];

    $query = "Select u_pwd, u_hash
    FROM tbl_users WHERE u_id = '" . $_SESSION['user_id'] . "' LIMIT 1";
    // echo $query; die();
    $result = mysqli_query($GLOBALS['conn'], $query);
    $user_info = mysqli_fetch_array($result);

    //check current pwd same or not with the input

    $pwd_salt = $user_info[1];
    $password_hash = hash('sha256', $cur_pwd . $pwd_salt);

    if ($password_hash == $user_info[0]) {
        echo "yes";
        $hash = bin2hex(random_bytes(16)); // Generate a random 16-byte salt
        $password_hash = hash('sha256', $new_password . $hash);

        $q1 = "UPDATE `tbl_users` SET `u_pwd`='" . $password_hash . "', `u_hash`='" . $hash . "' WHERE `u_id`='" . $_SESSION['user_id'] . "';";
        if (mysqli_query($GLOBALS['conn'], $q1)) {
            $_SESSION["msg_status"] = "success";
            $_SESSION["msg"] = "changePwd";
            Header("Location:../myProfilePage.php");
        } else {
            $error = 1;
        }
    } else {
        $error = 1;
    }
    if ($error == 1) {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "changePwd";
        Header("Location:../myProfilePage.php");
    }
}

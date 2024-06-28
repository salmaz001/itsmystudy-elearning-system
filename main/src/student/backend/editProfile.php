<?php
session_start();
include_once '../../../configs/dbconfig.php';

if (isset($_POST["update_profile"])) {

    $sql = "UPDATE tbl_users set u_fullname = '" . $_POST['name'] . "', u_email = '" . $_POST['email'] . "', u_mobileNo = '" . $_POST['mobileNo'] . "' where u_id = '" . $_SESSION["user_id"] . "'";
    
    if (mysqli_query($GLOBALS['conn'], $sql)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "editProfile";

        $_SESSION["user_mobile"] = $_POST["mobileNo"];
        $_SESSION["user_name"] = $_POST["name"];
        $_SESSION["user_email"] = $_POST["email"];

        Header("Location:../myProfilePage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "editProfile";
        Header("Location:../myProfilePage.php");
    }
}
?>
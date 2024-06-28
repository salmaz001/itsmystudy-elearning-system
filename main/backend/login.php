<?php
session_start();
$_SESSION = array();
/* 
PHP MODULE : STUDENT AND TEACHER LOGIN
*/
include_once '../configs/dbconfig.php';
include_once './fcLoginReg.php';

if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $pass = $_POST["password"];

    $user_login = userlogin($email);

    // Check user login credentials 
    if ($user_login && mysqli_num_rows($user_login) > 0) {
        // Record Found
        $user_info = mysqli_fetch_array($user_login);
        $pwd_salt = $user_info[7];
        $password_hash = hash('sha256', $pass . $pwd_salt);

        if ($password_hash == $user_info[3]) {
            // Login Successful 
            $_SESSION["login_user"] = "YES";
            $_SESSION['user_id'] = $user_info[0];
            $_SESSION['user_name'] = $user_info[1];
            $_SESSION['user_email'] = $user_info[2];
            $_SESSION['user_mobile'] = $user_info[4];
            $_SESSION['user_recid'] = $user_info[6];    // IMPORTANT!! User record ID - Primary Key for USER record

            if ($user_info[5] == 2) {
            $_SESSION["login_tch"] = "YES";

            // Redirect to Teacher Landing Page
            Header("Location:../src/teacher/mainpage.php");
            } else if ($user_info[5] == 3) {
                $_SESSION["login_std"] = "YES";
            
                // Redirect to Student Landing Page
                Header("Location:../src/student/mainpage.php");
            } else {
                // Invalid User type
                $_SESSION['reg_status'] = "errlogin";
                Header("Location:../index.php");
            }
        } else {
            // Invalid Password
            $_SESSION['reg_status'] = "errlogin";
            Header("Location:../index.php");
        }
    } 
    else {
        // Record Not Found 
        error:
        
        $_SESSION["login_user"] = "NO";
        $_SESSION['reg_status'] = "errloginrec";

        Header("Location:../index.php");

    }
}
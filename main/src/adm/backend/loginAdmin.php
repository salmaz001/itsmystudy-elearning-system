<?php
session_start();
$_SESSION = array();
/* 
PHP MODULE : ADMIN LOGIN
*/
include_once '../../../configs/dbconfig.php';

if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $pass = $_POST["pwd"];

    $query = "SELECT u_id, u_fullname, u_email, u_pwd, u_mobileNo, u_type, u_recid, u_hash from tbl_users 
    WHERE u_email = '" . $email . "' and u_type = 1 and u_status = 'A' LIMIT 1";

    $result = mysqli_query($GLOBALS['conn'], $query);

    // Check user login credentials 
    if ($result && mysqli_num_rows($result) > 0) {
        // Record Found
        $user_info = mysqli_fetch_array($result);
        $pwd_salt = $user_info[7];
        $password_hash = hash('sha256', $pass . $pwd_salt);

        if ($password_hash == $user_info[3]) {
            // Login Successful 
            $_SESSION["login_admin"] = "YES";
            $_SESSION['user_id'] = $user_info[0];
            $_SESSION['user_name'] = $user_info[1];
            $_SESSION['user_email'] = $user_info[2];
            $_SESSION['user_mobile'] = $user_info[4];
            $_SESSION['user_recid'] = $user_info[6];    // IMPORTANT!! User record ID - Primary Key for USER record
            
            // Redirect to Admin Landing Page
            Header("Location:../dashboard.php");
        } else {
            // Invalid Password
            echo "<script>alert('Invalid email or password');document.location='../index.php'</script>";
        }
    } 
    else {
        // Record Not Found 
        error:
        
        // $_SESSION["login_admin"] = "NO";
        echo "<script>alert('Invalid email or password');document.location='../index.php'</script>";

    }
}
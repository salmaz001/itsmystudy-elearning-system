<?php
/* 

PHP FUNCTION : LOGIN & REGISTER
Amended : 11/11/2021

*/
// --- Check if user exists or not
function checkUser($email)
{
    $flag = 0; // User does not exists

    $query = "SELECT u_id, u_recid FROM tbl_users WHERE u_email = '" . $email . "' LIMIT 1";

    $result = mysqli_query($GLOBALS['conn'], $query);
    if (mysqli_num_rows($result) > 0) {
        $flag = 1; // User exists
    }
    return $flag;
}

// --- Register new teacher
function regNewTeacher($accNum, $name, $email, $pass, $mobile_no, $status, $icNo, $dob, $age, $gender)
{
    //salt the password
    $hash = bin2hex(random_bytes(16)); // Generate a random 16-byte salt
    $password_hash = hash('sha256', $pass . $hash);

    $error = 1; // Set ERROR flag -> true
    $query = "INSERT INTO tbl_users(u_id, u_fullname, u_email, u_pwd, u_hash, u_type, u_mobileNo, u_createdAt, u_status) 
              VALUES ('" . $accNum . "','" . $name . "', '" . $email . "', '" . $password_hash . "', '" . $hash . "', '2', '" . 
                        $mobile_no . "', NOW(), '" . $status . "');";
    $query .= "INSERT INTO tbl_teachers(user_id, ic_no, dob, age, gender) 
              VALUES ('" . $accNum . "','" . $icNo . "', '" . $dob . "', '" . $age . "', '" . $gender . "');";
    

    if (mysqli_multi_query($GLOBALS['conn'], $query)) {
        $error = 0; // Set ERROR flag -> false
    }
    return $error;
}

// --- Register new teacher
function regNewStudent($accNum, $name, $email, $pass, $mobile_no, $status, $icNo, $dob, $age, $gender, $tch_id)
{
    //salt the password
    $hash = bin2hex(random_bytes(16)); // Generate a random 16-byte salt
    $password_hash = hash('sha256', $pass . $hash);

    $error = 1; // Set ERROR flag -> true
    $query = "INSERT INTO tbl_users(u_id, u_fullname, u_email, u_pwd, u_hash, u_type, u_mobileNo, u_createdAt, u_status) 
              VALUES ('" . $accNum . "','" . $name . "', '" . $email . "', '" . $password_hash . "', '" . $hash . "', '3', '" . 
                        $mobile_no . "', NOW(), '" . $status . "');";
    $query .= "INSERT INTO tbl_students(user_id, ic_no, dob, age, gender, tch_id) 
              VALUES ('" . $accNum . "','" . $icNo . "', '" . $dob . "', '" . $age . "', '" . $gender . "', '" . $tch_id . "');";    

    if (mysqli_multi_query($GLOBALS['conn'], $query)) {
        $error = 0; // Set ERROR flag -> false
    }
    return $error;
}

// --- CHECK LOGIN EMAIL
function userlogin($email)
{
    // u_type = 2 - teacher, 3 - student
    // u_status = "A"   'A' - Active
    //                  'N' - Non-Active
    //                  

    $query = "SELECT u_id, u_fullname, u_email, u_pwd, u_mobileNo, u_type, u_recid, u_hash from tbl_users 
              WHERE u_email = '" . $email . "' and u_type <> '1' and u_status = 'A' LIMIT 1";

    $result = mysqli_query($GLOBALS['conn'], $query);
    return $result;
}

function checkAccNum( $accNum, $table, $id )
{
    $exists = 0; // Record Not Found

    $query = "SELECT * FROM $table WHERE $id = '" . $accNum . "' LIMIT 1";

    $result = mysqli_query($GLOBALS['conn'], $query);
    if (mysqli_num_rows($result) > 0) {
        $exists = 1; // Record Found
    }

    return $exists;
}

function setAccNum( $alpha,  $table_nm, $fld_key )
{
    $isNew = false;

    while ($isNew != true) {
        // Generate RANDOM USER ID
        $randNum = rand(9999, 100000);
        $year = date("y");
        $accNum = "IMS" . $year . $alpha . $randNum;
     
        // Check IF ALREADY IN DB
        $error_accNum = checkAccNum( $accNum, $table_nm, $fld_key );
        if ($error_accNum == 0) {
            $isNew = true;
        }
    }
    return $accNum;
}

function generateRandomPassword() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }
    return $password;
}

?>
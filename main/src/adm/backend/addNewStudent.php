<?php
//start php session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../../../configs/dbconfig.php';
include_once '../../../backend/fcLoginReg.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';

date_default_timezone_set("Asia/Kuala_Lumpur");

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = '88d4665b1ceeb6';
$mail->Password = '5e03e5eabdeee2';

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobileNo = $_POST["mobileNo"];
    $icNo = $_POST["icNo"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $tch_id = $_POST["tch_id"];

    $age = date("Y") - date("Y", strtotime($dob));

    // Generate User ID
    $user_exists = checkUser($email);

    switch ($user_exists) {
        case 0:
            // REGISTER NEW STUDENT
            $accNum = setAccNum("ST", "tbl_users", "u_id");
            $pass = generateRandomPassword();

            $status = "A";  // - "active" customer is active
            $error_reg = regNewStudent($accNum, $name, $email, $pass, $mobileNo, $status, $icNo, $dob, $age, $gender, $tch_id);

            switch ($error_reg) {
                case 0:
                    //send email to Student
                    //body email content
                    $output = '<h1 style="text-align:center;">Welcome to ITSMYSTUDY</h1>
                    <p>Dear ' . $name . ',</p>
                    <p>Thank you for registering for an account on our educational platform. We are delighted to have you on board as one of our valued students. This email is to confirm your registration and to provide you with some important details about your account.</p>
                    <p>Your login credentials are as follows:</p>
                    <p style="margin-left:20px"><strong>Email:</strong> ' . $email . '</p>
                    <p style="margin-left:20px"><strong>Password:</strong> ' . $pass . '</p>
                    <br>
                    <p>Please keep this information secure and do not share it with anyone. You are advised to change the password after you have logged in.</p>
                    <p>You can access our website here: <a href="http://localhost/itsmystudy/main/index.php">ITSMYSTUDY Login Page</a></p>
                    <p>Thank you and welcome aboard!</p><br>
                    <p>Best wishes,</p>
                    <p><i>ITSMYSTUDY Team</i></p>';
        
        
                    $body = $output;
                    $subject = "ITSMYSTUDY Registration Confirmation for Student Account";
        
                    $email_to = $email;
                    $fromserver = "itsmystudy23@gmail.com";
        
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 2525;
        
                    $mail->IsHTML(true);
                    $mail->From = "itsmystudy23@gmail.com";
                    $mail->FromName = "ItsMyStudy";
                    $mail->Sender = $fromserver; // indicates echoPath header
                    $mail->Subject = $subject;
                    $mail->Body = $body;
                    $mail->AddAddress($email_to);
                    if (!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo; //kalau rajin letak kt error log tbl haha
                    } else {
                        //success, go to Student list page
                        $_SESSION["msg_status"] = "success";
                        $_SESSION["msg"] = "AddStudent";
                        Header("Location:../listStudentPage.php");
                    }
                    break;
                default:
                $_SESSION["msg_status"] = "error";
                $_SESSION["msg"] = "AddStudent";
                Header("Location:../listStudentPage.php");

                //     echo "<script>
                // alert('Error! Please try again.');
                // window.location.href='../addStudentPage.php';
                // </script>";
            }
            break;
        case 1: // user already exists in db
            $_SESSION["msg_status"] = "error";
            $_SESSION["msg"] = "AddStudent_emailExist";
            Header("Location:../listStudentPage.php");

            // echo "<script>
            //     alert('Error! An account already exists with this email.');
            //     window.location.href='../addStudentPage.php';
            //     </script>";
            break;
    }

} else {
    Header("Location:../addStudentPage.php");
}

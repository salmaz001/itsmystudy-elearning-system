<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include_once '../configs/dbconfig.php';


date_default_timezone_set("Asia/Kuala_Lumpur");

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = '88d4665b1ceeb6';
$mail->Password = '5e03e5eabdeee2';

if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>Invalid email address please type a valid email address.</strong></div>";
    } else {
        $query = "SELECT u_fullname from tbl_users WHERE u_email='" . $email . "' and u_status='A' LIMIT 1";
        $result = mysqli_query($GLOBALS['conn'], $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_info = mysqli_fetch_array($result);
            $expFormat = mktime(
                date("H") + 2,
                date("i"),
                date("s"),
                date("m"),
                date("d"),
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            $key = bin2hex(random_bytes(32));


            // Insert Temp Table
            mysqli_query(
                $GLOBALS['conn'],
                "INSERT INTO `tbl_password_reset` (`email`, `key`, `expDate`)
            VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');"
            );

            //body email content
            $output = '<h1 style="text-align:center;">Password Reset</h1>
        <p>Dear ' . $user_info[0] . ',</p>
        <p>We have received a request to reset your password. Please click on the button below to reset your password:</p>
        <p style="text-align:center;"><a href="http://localhost/itsmystudy/main/reset-password.php?
        key=' . $key . '&email=' . $email . '&action=reset"><button style="background-color: #008CBA; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Reset Password</button></a></p>
        <p>The link will expire after 2 hours for security reason.</p>
        <p>If you did not request for this password reset, no action 
        is needed and your password will not be reset. However, for security reason, you may want to log into 
        your account and change your password as someone may have guessed it.</p>
        <br>
        <p>Thank you,</p>
        <p>ITSMYSTUDY Support Team</p>';


            $body = $output;
            $subject = "ITSMYSTUDY Password Recovery";

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
                echo "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>An email has been sent to you with instructions on how to reset your password</strong></div>.";
            }
        } else {
            echo "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>Error! Email address not registered in our system.</strong></div>";
        }
    }
} else {
    echo "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>Error! Please try again</strong></div>";
}

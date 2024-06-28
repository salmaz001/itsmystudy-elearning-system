<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once './configs/dbconfig.php';

session_start();

if (isset($_SESSION['reg_status'])) {
  $reg_status = $_SESSION['reg_status'];
  unset($_SESSION['reg_status']);
} else {
  $reg_status = "";   // No message to display 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ITSMYSTUDY</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/logo2.png" rel="icon">
  <link href="../assets/img/logo2.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">
  <style>
    input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
  </style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo1.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 pt-4">
                <div class="card-body">
                  <?php
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $error = "";
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");

  $query = "SELECT * FROM `tbl_password_reset` WHERE `key`='".$key."' and `email`='".$email."';";
  $result = mysqli_query($GLOBALS['conn'], $query);

  $row = mysqli_num_rows($result);
  if ($row == 0){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="http://localhost/itsmystudy/main/forgot-password.php">
Click here</a> to reset password.</p>';
	}else{
  $row = mysqli_fetch_assoc($result);
  $expDate = $row['expDate'];

  if ($expDate >= $curDate){
  ?>
                  <div class="text-center mt-4" id="divmsg">

                  </div>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset password</h5>
                    <p class="text-start small">Note: Password must contain at least 8 characters long, 1 lowercase letter, 1 uppercase letter and 1 number</p>
                  </div>

                  <form class="row g-3 needs-validation" name="change_pwd" id="change_pwd" novalidate method="POST" action="" onsubmit="return validatePassword()">
                    <div class="col-12">
                      <label class="form-label">Password</label>
                      <input type="password" class="form" id="password" name="pass1" required>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Confirm Password</label>
                      <input type="password" class="form" id="repassword" name="pass2" required>
                    </div>
                    <div class="col-12 mt-4">
                      <input type="hidden" name="email" value="<?php echo $email;?>"/>
                      <input type="hidden" name="action" value="update" />
                      <button class="btn btn-primary w-100" id="submit-btn" type="submit" name="change_pwd">Reset Password</button>
                    </div>
                  </form>
                  <?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only for 2 hours.<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'>".$error."</div>";
  }			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($GLOBALS['conn'],$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($GLOBALS['conn'],$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");

  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{

  //salt the password
  $hash = bin2hex(random_bytes(16)); // Generate a random 16-byte salt
  $password_hash = hash('sha256', $pass1 . $hash);

  $error = 1; // Set ERROR flag -> true
  $query = "UPDATE `tbl_users` SET `u_pwd`='".$password_hash."', `u_hash`='".$hash."' 
  WHERE `u_email`='".$email."';";

  $result = mysqli_query($GLOBALS['conn'], $query);
  mysqli_query($GLOBALS['conn'],"DELETE FROM `tbl_password_reset` WHERE `email`='".$email."';");
	
echo "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><p>Congratulations! Your password has been updated successfully.</p>
<p><a href='http://localhost/itsmystudy/main/index.php'>
Click here</a> to Login.</p></div><br />";
	  }		
}
?>
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <!-- -------------------------------------------------- S C R I P T ---------------------------------------------- -->
  <script>
    function validatePassword() {
      var pwd = document.getElementById("password").value;

      var regix = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
      if (regix.test(pwd) == false) {
        alert("Password must contain at least 8 characters long, 1 lowercase letter, 1 uppercase letter and 1 number");
        return false;
      }

      var repwd = document.getElementById("repassword").value;
      if (repwd != pwd) {
        alert("Your Password do not match");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>
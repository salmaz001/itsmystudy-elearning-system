<?php
include_once '../../configs/dbconfig.php';
include_once("./backend/checkingLogin.php");
if (isset($_SESSION['msg_status'])) {
  $msg_status = $_SESSION['msg_status'];
  $msg = $_SESSION['msg'];
  unset($_SESSION['msg']);
  unset($_SESSION['msg_status']);
} else {
  $msg_status = "";   // No message to display 
  $msg = "";   // No message to display 
}
// $_SESSION['user_name'] = $user_info[1];
//             $_SESSION['user_email'] = $user_info[2];
//             $_SESSION['user_mobile'] = $user_info[4];
//             $_SESSION['user_recid'] = $user_info[6]; 
$fullname = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
$mobileNo = $_SESSION['user_mobile'];
$tch_id = $_SESSION['user_id'];

$query = "Select ic_no, dob, age, gender
    FROM tbl_teachers WHERE user_id = '".$tch_id."' LIMIT 1";
    // echo $query; die();
$result = mysqli_query($GLOBALS['conn'], $query);
$user_info = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?= include_once("./tchHead.php"); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?= include_once("./tchHeader.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?= include_once("./tchSidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">My Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Personal Information</h5>

              <form method="post" action="./backend/editProfile.php" onsubmit="return confirm('Are you sure you want to update your information?')">
                <div class="col-md-12 mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $fullname; ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="name" class="form-label">Role</label>
                  <input type="text" class="form-control" id="role" name="role" value="Teacher" disabled>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="mobileNo" class="form-label">Mobile No.</label>
                  <input type="text" class="form-control" id="mobileNo" name="mobileNo" value="<?= $mobileNo; ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="icNo" class="form-label">Identification No.</label>
                  <input type="text" class="form-control" id="icNo" name="icNo" value="<?= $user_info[0]; ?>" disabled>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="dob" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" value="<?= $user_info[1]; ?>" disabled>
                </div>
                <div class="col-md-12 mb-4">
                  <label for="gender" class="form-label">Gender</label>
                  <input type="text" class="form-control" id="gender" name="gender" value="<?= ucwords($user_info[3]); ?>" disabled>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="col-sm-12 text-center">
                    <button name="update_profile" type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Change Password</h5>

              <form method="post" action="./backend/changePassword.php" onsubmit="return validatePassword()">
                <div class="row mb-5">
                  <div class="col-md-12 mb-3">
                    <label for="curr_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="curr_password" name="curr_password" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="repassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" required>
                  </div>
                
                <div class="text-center">
                  <button type="submit" name="change_pwd" class="btn btn-primary mt-3">Change Password</button>
                </div>
              </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?= include_once("./tchFooter.php"); ?>
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

      return confirm('Are you sure you want to change your password?');
    }
  </script>

  <script type="text/javascript">

var msg_status = <?php echo json_encode($msg_status); ?>;
var msg = <?php echo json_encode($msg); ?>;

switch (msg_status) {
    case 'success':
    if (msg == 'editProfile') {
        message = "Profile has been updated successfully"
    } 
    else if (msg == 'changePwd') {
        message = "Password has been changed successfully"
    }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
    if (msg == 'editProfile') {
        message = "ERROR! Please try update the information again."
    } 
    else if (msg == 'changePwd') {
        message = "ERROR! Please try change the password again."
    }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
}
</script>
</body>

</html>
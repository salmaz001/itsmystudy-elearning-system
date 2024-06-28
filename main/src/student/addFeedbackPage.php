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

$test_id = $_POST['test_id'];
$test_name = $_POST['test_name'];
$stud_test_id = $_POST['stud_test_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?= include_once("./stdHead.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <?= include_once("./stdHeader.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?= include_once("./stdSidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="listFeedbackPage.php">Feedback</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Feedback</h5>
              <form method="post" action="./backend/addFeedback.php" onsubmit="return confirm('Are you sure you want to submit?')">
                <div class="col-md-12 mb-3">
                  <label for="name" class="form-label">Test Name: <b><?php echo ucwords($test_name); ?></b></label>
                </div>
                <div class="col-md-10 mb-3">
                <textarea class="form-control" placeholder="Add your feedback here.." id="feedback" name="feedback" style="height: 150px;"></textarea>
                </div>
                <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                <input type="hidden" name="stud_test_id" value="<?php echo $stud_test_id; ?>">
                <div class="col-md-10 mb-3">
                  <div class="col-sm-12 text-center">
                    <button name="add_feedback" type="submit" class="btn btn-primary">Add Feedback</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>

      </div>
    </section>
  </main><!-- End #main -->
  <?= include_once("./stdFooter.php"); ?>
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
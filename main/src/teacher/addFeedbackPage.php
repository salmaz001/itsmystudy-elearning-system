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

if(isset($_POST['add_feedback'])){
    $test_name = $_POST['test_name'];
    $feedback_id = $_POST['feedback_id'];
}

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
                <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>">
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

  <?= include_once("./tchFooter.php"); ?>

  <script type="text/javascript">

var msg_status = <?php echo json_encode($msg_status); ?>;
var msg = <?php echo json_encode($msg); ?>;

// switch (msg_status) {
//     case 'success':
//       if (msg == 'AddMaterial') {
//         message = "New Feedback has been added succesfully."
//       } else if (msg == 'DelMaterial') {
//         message = "Lesson has been deleted successfully"
//       } else if (msg == 'EditMaterial') {
//         message = "Lesson has been updated successfully"
//       }
//         document.getElementById("divmsg").innerHTML =
//         "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
//         setTimeout(function() {
//             document.getElementById('divmsg').innerHTML = '';
//         }, 6000);
//         break;
//     case 'error':
//       if (msg == 'AddMaterial') {
//         message = "ERROR! Please try add the Feedback again."
//       } else if (msg == 'DelMaterial') {
//         message = "ERROR! Please try delete the lesson again."
//       } else if (msg == 'EditMaterial') {
//         message = "ERROR! Please try update the lesson again."
//       }
//         document.getElementById("divmsg").innerHTML =
//         "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
//         setTimeout(function() {
//             document.getElementById('divmsg').innerHTML = '';
//         }, 6000);
//         break;

// }
</script>
</body>

</html>
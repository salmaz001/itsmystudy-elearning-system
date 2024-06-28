<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("./stdHead.php"); ?>
</head>

<body>
  <!-- ======= Header ======= -->
  <?php include_once("./stdHeader.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?php include_once("./stdSidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Exercise</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Exercise</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">
      <div class="card">
        <div class="text-center mt-4" id="divmsg"></div>

        <div class="card-body">

              <div class="col-lg-12">

                <h5 class="card-title">List of Available Exercises</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col-1">No</th>
                      <th scope="col-1" class="col-lg-3">Exercise Name</th>
                      <th scope="col-1">Description</th>
                      <th scope="col-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $query = "SELECT t.ex_id, t.ex_name, t.ex_desc, t.ex_noQuest, t.created_at, t.tch_id
        FROM tbl_exercise t
        left join tbl_students s ON t.tch_id = s.tch_id 
        WHERE s.user_id = '" . $_SESSION['user_id'] . "' AND t.status = 1
        ORDER BY t.created_at DESC;
        ";
                    // echo $query;
                    $result = mysqli_query($GLOBALS['conn'], $query);

                    while ($ex_info = mysqli_fetch_array($result)) {
                    ?>

                      <tr>
                        <th scope="col-1"><?php echo $num; ?></th>
                        <td><?php echo $ex_info[1]; ?></td>
                        <td><?php echo $ex_info[2]; ?></td>
                        <td>
                          <div class="d-flex">

                            <form action="answerExercisePage.php" method="post">
                              <input type="hidden" name="ex_id" value="<?php echo $ex_info[0]; ?>">
                              <input type="hidden" name="tch_id" value="<?php echo $ex_info[5]; ?>">
                              <button class="btn btn-outline-primary" name="answer_exercise" type="submit">Take Exercise Now</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $num++;
                    } ?>

                  </tbody>
                  <!-- End Table with stripped rows -->
                </table>


              </div>
            
        </div>
      </div>


    </section>

  </main><!-- End #main -->

  <?php include_once("./stdFooter.php"); ?>
  <script type="text/javascript">
    var msg_status = <?php echo json_encode($msg_status); ?>;
    var msg = <?php echo json_encode($msg); ?>;

    switch (msg_status) {
      case 'success':
        if (msg == 'EnrollLesson') {
          message = "You have enrolled the Test succesfully. You can view the Test from your 'My Enrolled Test' tab"
        }
        // else if (msg == 'DelMaterial') {
        //     message = "Lesson has been deleted successfully"
        // }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
      case 'error':
        if (msg == 'EnrollLesson') {
          message = "ERROR! Please try enroll the Test again."
        }
        // else if (msg == 'DelMaterial') {
        //     message = "ERROR! Please try delete the lesson again."
        // }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    }
  </script>
</body>

</html>
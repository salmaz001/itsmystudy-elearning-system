<?php
include_once '../../configs/dbconfig.php';
include_once("./backend/checkingLoginAdm.php");
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
<?= include_once("./headAdm.php"); ?>

<body>
    <?= include_once("./headerAdm.php"); ?>
    <?= include_once("./sidebarAdm.php"); ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Feedback</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Feedback</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
      <div class="row">
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Feedback</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col-1">No</th>
                    <th scope="col-1">Test Name</th>
                    <th scope="col-1">Test ID</th>
                    <th scope="col-1">Student Name</th>
                    <th scope="col-1">Teacher Name</th>
                    <th scope="col-1">Student Feedback</th>
                    <th scope="col-1">Teacher Feedback</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  $query = "Select f.id, f.stud_review, f.tch_review, t.test_name, t.test_id, u.u_fullname, ut.u_fullname
                  FROM tbl_feedback f 
                  left join tbl_test t on f.test_id = t.test_id
                  left join tbl_users u on u.u_id = f.stud_id
                  left join tbl_users ut on ut.u_id = f.tch_id
                  order by f.stud_dateAdded desc";
                  $result = mysqli_query($GLOBALS['conn'], $query);
                                                

                  while ($feedback_info = mysqli_fetch_array($result)) {
                  ?>

                  <tr>
                  <th scope="row"><?php echo $num; ?></th>
                  <td><?php echo $feedback_info[3]; ?></td>
                  <td><?php echo $feedback_info[4]; ?></td>
                  <td><?php echo $feedback_info[5]; ?></td>
                  <td><?php echo $feedback_info[6]; ?></td>
                  <td><?php echo $feedback_info[1]; ?></td>
                  <td><?php echo $feedback_info[2] === NULL ? '<small>No feedback yet</small>' : $feedback_info[2]; ?></td>
                                                <?php
                                                    $num++;
                                                } ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    </main><!-- End #main -->
    <?= include_once("./footerAdm.php"); ?>
<script type="text/javascript">

var msg_status = <?php echo json_encode($msg_status); ?>;
var msg = <?php echo json_encode($msg); ?>;

switch (msg_status) {
    case 'success':
      if (msg == 'AddTeacher') {
        message = "New Teacher has been added succesfully, an email confirmation with their user credentials has been sent to their email."
      }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
      if (msg == 'AddTeacher') {
        message = "ERROR! Please try add the teacher again."
      } else if (msg == 'AddTeacher_emailExist') [
        message = "ERROR! Email already been registered, please try with another email."
      ]
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
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
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
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
                    <th scope="col-1">Student Name</th>
                    <th scope="col-1">Test Name</th>
                    <th scope="col-1">Student's Feedback</th>
                    <th scope="col-2">My Feedback</th>
                    <th scope="col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  $query = "Select f.id, f.stud_review, f.tch_review, t.test_name, u.u_fullname
                  FROM tbl_feedback f 
                  left join tbl_test t on f.test_id = t.test_id
                  left join tbl_users u on u.u_id = f.stud_id
                  WHERE t.tch_id = '".$_SESSION['user_id']."' order by f.stud_dateAdded desc";
                  // echo $query;
                  $result = mysqli_query($GLOBALS['conn'], $query);
                                                

                  while ($feedback_info = mysqli_fetch_array($result)) {
                  ?>

                  <tr>
                  <th scope="col-1"><?php echo $num; ?></th>
                  <td><?php echo $feedback_info[4]; ?></td>
                  <td><?php echo $feedback_info[3]; ?></td>
                  <td><?php echo $feedback_info[1]; ?></td>
                  <td><?php echo $feedback_info[2] === NULL ? '<small>No feedback yet</small>' : $feedback_info[2]; ?></td>
                  <td>
                  <?php
                              if ($feedback_info[2] !== NULL) {
                              ?>
                                <i>Feedback Added</i>
                              <?php
                              } else {
                                ?>
                  <div class="d-flex">
                    
                                                        <form action="addFeedbackPage.php" method="post">
                                                            <input type="hidden" name="feedback_id"
                                                                value="<?php echo $feedback_info[0]; ?>">
                                                            <input type="hidden" name="test_name"
                                                                value="<?php echo $feedback_info[3]; ?>">
                                                            <button class="btn btn-outline-primary"
                                                                style="margin-right:5px;" name="add_feedback"
                                                                type="submit">Add Feedback</button>
                                                        </form>
                                                        </div>
                                                        <?php
                              } 
                              ?>
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
      </div>
    </section>

  </main><!-- End #main -->

  <?= include_once("./tchFooter.php"); ?>

  <script type="text/javascript">

var msg_status = <?php echo json_encode($msg_status); ?>;
var msg = <?php echo json_encode($msg); ?>;

switch (msg_status) {
    case 'success':
      if (msg == 'AddFeedback') {
        message = "Feedback has been added succesfully."
      } 
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
      if (msg == 'AddFeedback') {
        message = "ERROR! Please try add the feedback again."
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
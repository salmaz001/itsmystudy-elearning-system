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
      <h1>Exercise</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Exercise</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Exercise</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col-1">No</th>
                    <th scope="col-1" class="col-lg-3">Exercise Name</th>
                    <th scope="col-1">Description</th>
                    <th scope="col-1">Number of Questions</th>
                    <th scope="col-2">Date Added</th>
                    <th scope="col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                  $query = "Select ex_id, ex_name, ex_desc, ex_noQuest, created_at
                  FROM tbl_exercise WHERE tch_id = '" . $_SESSION['user_id'] . "' AND status = 1 order by created_at desc";
                  // echo $query;
                  $result = mysqli_query($GLOBALS['conn'], $query);


                  while ($ex_info = mysqli_fetch_array($result)) {
                  ?>

                    <tr>
                      <th scope="col-1"><?php echo $num; ?></th>
                      <td><?php echo $ex_info[1]; ?></td>
                      <td><?php echo $ex_info[2]; ?></td>
                      <td><?php echo $ex_info[3]; ?></td>
                      <td><?php echo $ex_info[4]; ?></td>
                      <td>
                        <div class="d-flex">

                          <form action="viewExercisePage.php" method="post">
                            <input type="hidden" name="ex_id" value="<?php echo $ex_info[0]; ?>">
                            <button class="btn btn-outline-primary" style="margin-right:5px;" name="view_exercise" type="submit">View</button>
                          </form>
                          <form action="./backend/deleteExercise.php" method="post" onsubmit="return confirm('Are you sure you want to delete this exercise? This action cannot be undone.')">
                            <input type="hidden" name="ex_id" value="<?php echo $ex_info[0]; ?>">
                            <button class="btn btn-outline-danger" name="delete_exercise" type="submit" style="margin-right:5px;">Delete</button>
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
      </div>
    </section>

  </main><!-- End #main -->

  <?= include_once("./tchFooter.php"); ?>

  <script type="text/javascript">
    var msg_status = <?php echo json_encode($msg_status); ?>;
    var msg = <?php echo json_encode($msg); ?>;

    switch (msg_status) {
      case 'success':
        if (msg == 'AddExercise') {
          message = "New Exercise has been added succesfully."
        } else if (msg == 'DelExercise') {
          message = "Exercise has been deleted successfully"
        }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
      case 'error':
        if (msg == 'AddExercise') {
          message = "ERROR! Please try add the Exercise again."
        } else if (msg == 'DelExercise') {
          message = "ERROR! Please try delete the Exercise again."
        }
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
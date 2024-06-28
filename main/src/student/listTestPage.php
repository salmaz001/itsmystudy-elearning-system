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
      <h1>Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Test</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">
      <div class="card">
        <div class="text-center mt-4" id="divmsg"></div>

        <div class="card-body">

          <!-- Default Tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Available Tests</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">My Taken Tests</button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="col-lg-12">

                <h5 class="card-title">List of Available Tests</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col-1">No</th>
                      <th scope="col-1" class="col-lg-3">Test Name</th>
                      <th scope="col-1">Description</th>
                      <th scope="col-2">Teacher's Name</th>
                      <th scope="col-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num = 1;
                    $query = "SELECT DISTINCT t.test_id, t.test_name, t.test_desc, t.test_noQuest, t.created_at, u.u_fullname, t.tch_id
        FROM tbl_test t
        JOIN tbl_stud_material sm ON t.tch_id = sm.tch_id
        JOIN tbl_users u ON t.tch_id = u.u_id
        WHERE sm.stud_id = '" . $_SESSION['user_id'] . "'
        ORDER BY t.created_at DESC;
        ";
                    // echo $query;
                    $result = mysqli_query($GLOBALS['conn'], $query);


                    if(mysqli_num_rows($result) == 0 ){
                      echo 'Please enroll any study materials to see available test.';
                    } else {
                    while ($test_info = mysqli_fetch_array($result)) {
                    ?>

                      <tr>
                        <th scope="col-1"><?php echo $num; ?></th>
                        <td><?php echo ucwords($test_info[1]); ?></td>
                        <td><?php echo $test_info[2]; ?></td>
                        <td><?php echo $test_info[5]; ?></td>
                        <td>
                          <div class="d-flex">

                            <form action="answerTestPage.php" method="post">
                              <input type="hidden" name="test_id" value="<?php echo $test_info[0]; ?>">
                              <input type="hidden" name="tch_id" value="<?php echo $test_info[6]; ?>">
                              <button class="btn btn-outline-primary" name="answer_test" type="submit">Take Test Now</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $num++;
                    }} ?>

                  </tbody>
                  <!-- End Table with stripped rows -->
                </table>


              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="col-lg-12">

                <h5 class="card-title">List of My Taken Tests</h5>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col-1">No</th>
                      <th scope="col-1" class="col-lg-3">Test Name</th>
                      <th scope="col-1">Description</th>
                      <th scope="col-2">Result (%)</th>
                      <th scope="col-2">Date Taken</th>
                      <th scope="col-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $q1 = "SELECT t.test_id, t.test_name, t.test_desc, t.test_noQuest, t.created_at, u.u_fullname, st.feedback_done, st.marks, st.totCorrectAns, st.dateTaken, st.id FROM tbl_test t
                     JOIN tbl_stud_test st ON t.test_id = st.test_id 
                     JOIN tbl_users u ON t.tch_id = u.u_id 
                     WHERE st.stud_id = '" . $_SESSION['user_id'] . "' ORDER BY st.dateTaken DESC;";
                    // echo $q1;
                    $result1 = mysqli_query($GLOBALS['conn'], $q1);

                    if (mysqli_num_rows($result1) > 0) {
                      while ($myTest_info = mysqli_fetch_array($result1)) {
                    ?>

                        <tr>
                          <th scope="col-1"><?php echo $no; ?></th>
                          <td><?php echo ucwords($myTest_info[1]); ?></td>
                          <td><?php echo $myTest_info[2]; ?></td>
                          <td><?php echo $myTest_info[7]; ?></td>
                          <td><?php echo date("j F Y", strtotime($myTest_info[9])); ?></td>
                          <td>
                            <div class="d-flex align-items-center">
                              <!-- buat if else condition kat sini -->
                              <?php
                              if ($myTest_info[6] == 1) {
                              ?>
                                <i>Feedback Added</i>
                              <?php
                              } else {
                              ?>
                                <form action="addFeedbackPage.php" method="post">
                                  <input type="hidden" name="test_id" value="<?php echo $myTest_info[0]; ?>">
                                  <input type="hidden" name="test_name" value="<?php echo $myTest_info[1]; ?>">
                                  <input type="hidden" name="stud_test_id" value="<?php echo $myTest_info[10]; ?>">
                                  <button class="btn btn-outline-primary" name="add_feedback" type="submit">Add Feedback</button>
                                </form>
                              <?php
                              $no++;
                              }
                              ?>


                            </div>
                          </td>
                        </tr>
                    <?php
                        $num++;
                      }
                    } ?>

                  </tbody>
                  <!-- End Table with stripped rows -->
                </table>


              </div>
            </div>
          </div><!-- End Default Tabs -->

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
        if (msg == 'AnswerTest') {
          message = "Your test has been marked, you can view your marks in the 'My Taken Test' tab"
        }
        else if (msg == 'AddFeedback') {
            message = "Feedback has been added successfully"
        }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
      case 'error':
        if (msg == 'AnswerTest') {
          message = "ERROR! Please try answer the test again."
        }
        else if (msg == 'AddFeedback') {
            message = "ERROR! Please try add your feedback again."
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
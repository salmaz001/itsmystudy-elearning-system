<?php
include_once '../../configs/dbconfig.php';
include_once("./backend/checkingLogin.php");
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
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Feedback</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="col-lg-12">
    <div class="col-lg-12">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">List of Feedback</h5>

    <!-- Table with stripped rows -->
    <table class="table datatable">
      <thead>
        <tr>
          <th scope="col-1">No</th>
          <th scope="col-1" class="col-lg-3">Test Name</th>
          <th scope="col-1">Description</th>
          <th scope="col-1">Date Taken</th>
          <th scope="col-2">My Feedback</th>
          <th scope="col-2">Teacher's Feedback</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $num = 1;
        // $query = "Select test_id, test_name, test_desc, test_noQuest, created_at
        // FROM tbl_test WHERE tch_id = '" . $_SESSION['user_id'] . "' order by created_at desc";
        $query = "Select f.id, f.stud_review, f.tch_review, t.test_name, u.u_fullname, t.test_desc, tst.dateTaken
                  FROM tbl_feedback f 
                  left join tbl_test t on f.test_id = t.test_id
                  left join tbl_users u on u.u_id = f.stud_id
                  left join tbl_stud_test tst on f.stud_test_id = tst.id
                  WHERE f.stud_id = '".$_SESSION['user_id']."' order by f.stud_dateAdded desc";
        // echo $query;
        $result = mysqli_query($GLOBALS['conn'], $query);


        while ($feedback_info = mysqli_fetch_array($result)) {
        ?>

          <tr>
          <th scope="col-1"><?php echo $num; ?></th>
                  <td><?php echo $feedback_info[3]; ?></td>
                  <td><?php echo $feedback_info[5]; ?></td>
                  <td><?php echo date("j F Y", strtotime($feedback_info[6])); ?></td>
                  <td><?php echo $feedback_info[1] === NULL ? '<small>No feedback yet</small>' : $feedback_info[1]; ?></td>
                  <td>
                  <?php
                              if ($feedback_info[2] !== NULL) {
                                
                                echo $feedback_info[2];
                              } else {
                                echo "No feedback yet";
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

  <?php include_once("./stdFooter.php"); ?>
</body>

</html>
<?php
include_once("./backend/checkingLogin.php");
include_once '../../configs/dbconfig.php';
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="col-lg-12">
        <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Total Enrolled Study Material</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3 d-flex">
                    <?php
                    $q1 =  $GLOBALS['conn']->query("SELECT COUNT(id) noOfMaterial FROM tbl_stud_material where stud_id = '" . $_SESSION['user_id'] . "'");
                    if (mysqli_num_rows($q1) == 0) {
                      $totalMaterial = "0";
                    } else {
                      $material = mysqli_fetch_array($q1);
                      $totalMaterial = $material["noOfMaterial"];
                    }
                    ?>
                    <h6><?php echo $totalMaterial; ?></h6>
                    <span class="text-muted small pt-2 ps-1"> materials</span>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Tests Taken</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-text-fill"></i>
                  </div>
                  <div class="ps-3 d-flex">
                    <?php
                    $q2 =  $GLOBALS['conn']->query("SELECT COUNT(test_id) noOfTest FROM tbl_stud_test where stud_id = '" . $_SESSION['user_id'] . "'");
                    if (mysqli_num_rows($q2) == 0) {
                      $totalTest = "0";
                    } else {
                      $test = mysqli_fetch_array($q2);
                      $totalTest = $test["noOfTest"];
                    }
                    ?>
                    <h6><?php echo $totalTest; ?></h6>
                    <span class="text-muted small pt-2 ps-1"> tests</span>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Recent Taken Tests <span>| This Month</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Test Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Result (%)</th>
                      <th scope="col">Date Taken</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $q1 = "SELECT t.test_id, t.test_name, t.test_desc, t.test_noQuest, t.created_at, u.u_fullname, st.feedback_done, st.marks, st.totCorrectAns, st.dateTaken, st.id FROM tbl_test t
 JOIN tbl_stud_test st ON t.test_id = st.test_id 
 JOIN tbl_users u ON t.tch_id = u.u_id 
 WHERE st.stud_id = '" . $_SESSION['user_id'] . "' AND MONTH(st.dateTaken) = MONTH(CURDATE())
  AND YEAR(st.dateTaken) = YEAR(CURDATE()) ORDER BY st.dateTaken DESC;";
                    // echo $q1;
                    $result1 = mysqli_query($GLOBALS['conn'], $q1);

                    if (mysqli_num_rows($result1) > 0) {
                      while ($myTest_info = mysqli_fetch_array($result1)) {
                    ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $no; ?></a></th>
                          <td><?php echo $myTest_info[1]; ?></td>
                          <td><?php echo $myTest_info[2]; ?></td>
                          <td class="align-text-center"><?php echo $myTest_info[7]; ?></td>
                          <td><?php echo date("j F Y", strtotime($myTest_info[9])); ?></td>
                        </tr>
                    <?php
                        $no++;
                      }
                    }
                    ?>
                  </tbody>
                </table>

              </div>

            </div>
          </div>

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <?php include_once("./stdFooter.php"); ?>
</body>

</html>
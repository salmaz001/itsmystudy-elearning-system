<?php
include_once("./backend/checkingLogin.php");
include_once '../../configs/dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once("./tchHead.php"); ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <?php include_once("./tchHeader.php"); ?>

    <!-- ======= Sidebar ======= -->
    <?php include_once("./tchSidebar.php"); ?>

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
                  <h5 class="card-title">Total Study Materials</h5>
<?php
$q1 =  $GLOBALS['conn']->query("SELECT COUNT(sm_id) noOfMaterial FROM tbl_material where sm_tchId = '".$_SESSION['user_id']."'");
if (mysqli_num_rows($q1) == 0) {
    $totalMaterial = "0";
} else {
    $material = mysqli_fetch_array($q1);
    $totalMaterial = $material["noOfMaterial"];
}
?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3 d-flex">
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
                  <h5 class="card-title">Total Tests</h5>
                  <?php
$q2 =  $GLOBALS['conn']->query("SELECT COUNT(test_id) noOfTest FROM tbl_test where tch_id = '".$_SESSION['user_id']."'");
if (mysqli_num_rows($q2) == 0) {
    $totalTest = "0";
} else {
    $test = mysqli_fetch_array($q2);
    $totalTest = $test["noOfTest"];
}
?>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <div class="ps-3 d-flex">
                      <h6><?php echo $totalTest; ?></h6>
                      <span class="text-muted small pt-2 ps-1"> tests</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
              <?php
$q3 =  $GLOBALS['conn']->query("SELECT COUNT(id) noOfStud FROM tbl_students where tch_id = '".$_SESSION['user_id']."'");
if (mysqli_num_rows($q3) == 0) {
    $totalStud = "0";
} else {
    $stud = mysqli_fetch_array($q3);
    $totalStud = $stud["noOfStud"];
}
?>
                <div class="card-body">
                  <h5 class="card-title">Total Students</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3 d-flex">
                      <h6><?php echo $totalStud; ?></h6>
                      <span class="text-muted small pt-2 ps-1"> students</span>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Enrolled Students <span>| This Month</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Email Address</th>
                        <th scope="col">Date Enrolled</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $q4 = "SELECT s.tch_id, u.u_fullname, u.u_email, u.u_createdAt FROM tbl_students s
 JOIN tbl_users u ON s.user_id = u.u_id 
 WHERE s.tch_id = '" . $_SESSION['user_id'] . "' AND u.u_status = 'A' AND MONTH(u.u_createdAt) = MONTH(CURDATE())
  AND YEAR(u.u_createdAt) = YEAR(CURDATE()) ORDER BY u.u_createdAt DESC;";
                    // echo $q4;
                    $result1 = mysqli_query($GLOBALS['conn'], $q4);

                    if (mysqli_num_rows($result1) > 0) {
                      while ($myTest_info = mysqli_fetch_array($result1)) {
                    ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $no; ?></a></th>
                          <td><?php echo $myTest_info[1]; ?></td>
                          <td><?php echo $myTest_info[2]; ?></td>
                          <td><?php echo date("j F Y", strtotime($myTest_info[3])); ?></td>
                          <td><span class="badge bg-success">Active</span></td>
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

  <?php include_once("./tchFooter.php"); ?>
</body>

</html>
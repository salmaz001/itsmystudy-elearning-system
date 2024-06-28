<?php
include_once("./backend/checkingLoginAdm.php");
include_once '../../configs/dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">
<?= include_once("./headAdm.php"); ?>

<body>
    <?= include_once("./headerAdm.php"); ?>
    <?= include_once("./sidebarAdm.php"); ?>


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
                    <div class="col-xxl-6 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Teachers</h5>
                                <?php
                                $q_tch =  $GLOBALS['conn']->query("SELECT COUNT(u_id) noOfTch FROM tbl_users where u_type = 2");
                                if (mysqli_num_rows($q_tch) == 0) {
                                    $totalTeachers = "0";
                                } else {
                                    $tch = mysqli_fetch_array($q_tch);
                                    $totalTeachers = $tch["noOfTch"];
                                }
                                ?>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="ps-3 d-flex">
                                        <h6><?php echo $totalTeachers; ?></h6>
                                        <span class="text-muted small pt-2 ps-1"> teachers</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-6 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Students</h5>
                                <?php
                                $q_tch =  $GLOBALS['conn']->query("SELECT COUNT(u_id) noOfStud FROM tbl_users where u_type = 3");
                                if (mysqli_num_rows($q_tch) == 0) {
                                    $totalStud = "0";
                                } else {
                                    $tch = mysqli_fetch_array($q_tch);
                                    $totalStud = $tch["noOfStud"];
                                }
                                ?>
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
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Study Materials Added <span>| This Week</span></h5>
                                <?php
                                $q1 =  $GLOBALS['conn']->query("SELECT COUNT(sm_id) noOfMaterial FROM tbl_material WHERE WEEK(sm_dateUpdated) = WEEK(CURDATE())");
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

                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Tests Added <span>| This Week</span></h5>
                                <?php
                                $q2 =  $GLOBALS['conn']->query("SELECT COUNT(test_id) noOfTest FROM tbl_test WHERE WEEK(created_at) = WEEK(CURDATE())");
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

                    <!-- <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Enrolled Students <span>| This Week</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Enrolled Study Material</th>
                        <th scope="col">Date Enrolled</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div> -->

                </div>
            </div>

        </section>

    </main><!-- End #main -->
    <?= include_once("./footerAdm.php"); ?>

</body>

</html>
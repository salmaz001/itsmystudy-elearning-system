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

//fetch from db
if (isset($_POST["view_test"])) {
    $test_id = $_POST["test_id"];

    $queryTest = "Select test_name, test_desc, test_noQuest, created_at
    FROM tbl_test WHERE tch_id = '" . $_SESSION['user_id'] . "' AND test_id = '" . $test_id . "' LIMIT 1";
    $result = mysqli_query($GLOBALS['conn'], $queryTest);

    $test_info = mysqli_fetch_array($result);
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
                <h1>Test</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="listTestPage.php">Test</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">

                    <div class="text-center mt-4" id="divmsg"></div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="test-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Test Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="studentResult-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Students Result</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabContent">
                                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="test-tab">
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th class="col-md-3">Test Name:</th>
                                                        <td scope="col"><?php echo $test_info[0]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Description:</th>
                                                        <td><?php echo $test_info[1]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Number of Questions:</th>
                                                        <td><?php echo $test_info[2]; ?> Questions</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Date Created:</th>
                                                        <td><?php echo $test_info[3]; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <h5 class="card-title">Questions And Answers</h5>

                                            <?php
                                            $queryQues = "Select ques, image, ques_id FROM tbl_ques WHERE  test_id = '" . $test_id . "'";
                                            $resultQues = mysqli_query($GLOBALS['conn'], $queryQues);
                                            $quesNo = 1;

                                            while ($ques_info = mysqli_fetch_array($resultQues)) {
                                            ?>
                                                <div class="card pt-3">
                                                    <div class="card-body">
                                                        <p><b>Question <?php echo $quesNo; ?> - </b> <?php echo $ques_info[0]; ?></p>
                                                        <?php
                                                        if ($ques_info[1] != '-') {
                                                        ?>
                                                            <img src="./backend/<?php echo $ques_info[1]; ?>" class="rounded mx-auto d-block" style="max-height:250px;" alt="question_image">
                                                        <?php
                                                        }
                                                        $queryOpt = "Select options, correct_ans FROM tbl_options WHERE  test_id = '" . $test_id . "' AND ques_id = '" . $ques_info[2] . "'";
                                                        $resultOpt = mysqli_query($GLOBALS['conn'], $queryOpt);
                                                        $optNo = 1;
                                                        ?>
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                <?php
                                                                while ($opt_info = mysqli_fetch_array($resultOpt)) {

                                                                ?>

                                                                    <tr>
                                                                        <th class="col-sm-2">Option <?php echo $optNo; ?>:</th>
                                                                        <td scope="col">

                                                                            <?php echo $opt_info[0];
                                                                            if ($opt_info[1] == 1) { ?>
                                                                                <span class="badge bg-success mx-2"><i class="bi bi-check-circle me-1"></i> Correct Answer</span>

                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                    $optNo++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            <?php
                                                $quesNo++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="studentResult-tab">
                                    <div class="card-body">
                                    <h5 class="card-title">List of Students Result</h5>
                                        <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col-1">No</th>
                    <th scope="col-1" class="col-lg-3">Student Name</th>
                    <th scope="col-1">No. of Correct Answer</th>
                    <th scope="col-1">Result (%)</th>
                    <th scope="col-2">Date Taken</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                  $query = "Select st.stud_id, st.marks, st.totCorrectAns, dateTaken, u.u_fullname
                  FROM tbl_stud_test st
                  left join tbl_users u on st.stud_id = u.u_id WHERE st.tch_id = '" . $_SESSION['user_id'] . "' AND st.test_id = '".$test_id."' order by st.dateTaken desc";
                  // echo $query;
                  $result = mysqli_query($GLOBALS['conn'], $query);


                  while ($test_info = mysqli_fetch_array($result)) {
                  ?>

                    <tr>
                      <th scope="col-1"><?php echo $num; ?></th>
                      <td><?php echo $test_info[4]; ?></td>
                      <td><?php echo $test_info[2]; ?></td>
                      <td><?php echo $test_info[1]; ?></td>
                      <td><?php echo date("j F Y", strtotime($test_info[3])); ?></td>
                    </tr>
                  <?php
                    $num++;
                  } ?>

                </tbody>
                <!-- End Table with stripped rows -->
              </table>
                                    </div>
                                    </div>
                                </div><!-- End Bordered Tabs -->

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
                    if (msg == 'AddMaterial') {
                        message = "New study material has been added succesfully."
                    } else if (msg == 'DelMaterial') {
                        message = "Lesson has been deleted successfully"
                    }
                    document.getElementById("divmsg").innerHTML =
                        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
                    setTimeout(function() {
                        document.getElementById('divmsg').innerHTML = '';
                    }, 6000);
                    break;
                case 'error':
                    if (msg == 'AddMaterial') {
                        message = "ERROR! Please try add the study material again."
                    } else if (msg == 'DelMaterial') {
                        message = "ERROR! Please try delete the lesson again."
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
<?php
} else {
    Header("Location:./listTestPage.php");
}
?>
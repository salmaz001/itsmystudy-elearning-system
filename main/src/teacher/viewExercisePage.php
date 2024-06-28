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
if (isset($_POST["view_exercise"])) {
    $ex_id = $_POST["ex_id"];

    $queryEx = "Select ex_name, ex_desc, ex_noQuest, created_at
    FROM tbl_exercise WHERE tch_id = '" . $_SESSION['user_id'] . "' AND ex_id = '" . $ex_id . "' LIMIT 1";
    $result = mysqli_query($GLOBALS['conn'], $queryEx);

    $ex_info = mysqli_fetch_array($result);
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
                        <li class="breadcrumb-item"><a href="listExercisePage.php">Exercise</a></li>
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

                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th class="col-md-3">Exercise Name:</th>
                                                        <td scope="col"><?php echo $ex_info[0]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Description:</th>
                                                        <td><?php echo $ex_info[1]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Number of Questions:</th>
                                                        <td><?php echo $ex_info[2]; ?> Questions</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Date Created:</th>
                                                        <td><?php echo $ex_info[3]; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <h5 class="card-title">Questions And Answers</h5>

                                            <?php
                                            $queryQues = "Select ques, image, ques_id FROM tbl_ex_ques WHERE  ex_id = '" . $ex_id . "'";
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
                                                        $queryOpt = "Select options, correct_ans FROM tbl_ex_opt WHERE  ex_id = '" . $ex_id . "' AND ques_id = '" . $ques_info[2] . "'";
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
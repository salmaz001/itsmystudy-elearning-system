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

$tch_id = $_POST["tch_id"];
$sm_id = $_POST["sm_id"];
$sm_fileLoc = $_POST["sm_fileLoc"];
$sm_desc = $_POST["sm_desc"];
$sm_title = $_POST["sm_title"];
$sm_chapter = $_POST["sm_chapter"];
$tch_name = $_POST["tch_name"];
$sm_desc = $_POST["sm_desc"];
$stud_id = $_SESSION["user_id"];

//insert into db
if (isset($_POST["enroll_lesson"])) {



    $q1 = "INSERT INTO tbl_stud_material(material_id, topic_id, stud_id, tch_id, dateEnrolled) VALUES ('" . $sm_id . "','" . $sm_chapter . "','" . $stud_id . "', '" . $tch_id . "', NOW());";

    if (mysqli_query($GLOBALS['conn'], $q1)) {
        $_SESSION["msg_status"] = "success";
        $_SESSION["msg"] = "EnrollLesson";
        Header("Location:./lessonPage.php");
    } else {
        $_SESSION["msg_status"] = "error";
        $_SESSION["msg"] = "EnrollLesson";
        Header("Location:./lessonPage.php");
    }
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
            <h1>Study Material</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="lessonPage.php">Study Material</a></li>
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
                            <h5 class="card-title">Chapter: <?= $sm_chapter; ?> | Title: <?= $sm_title; ?></h5>
                            <h6 class="card-subtitle mt-2 mb-2 text-muted">By: <?php echo $tch_name; ?></h6>
                            <p class="card-text mb-3">Description: <?= $sm_desc; ?></p>
                            <div class="container">
                                <embed src="<?php echo '../teacher/backend/' . $sm_fileLoc; ?>" type="application/pdf" width="100%" height="1000px" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?= include_once("./stdFooter.php"); ?>

    <script type="text/javascript">
        var msg_status = <?php echo json_encode($msg_status); ?>;
        var msg = <?php echo json_encode($msg); ?>;

        switch (msg_status) {
            case 'success':
                if (msg == 'EnrollLesson') {
                    message = "You have enrolled the material succesfully."
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
                if (msg == 'EnrollLesson') {
                    message = "ERROR! Please try enroll the study material again."
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
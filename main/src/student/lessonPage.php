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
                    <li class="breadcrumb-item active">Study Material</li>
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
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Study Materials</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">My Enrolled Study Materials</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row gy-4 mt-3">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <?php

                                        //fetch topic
                                        $q1 = "Select topic from tbl_topic";
                // die();
                $rslt = mysqli_query($GLOBALS['conn'], $q1);
                $topicData = array();
                $ct = 1;

                while ($topic = mysqli_fetch_array($rslt)) {
                    $topicData[$ct] = $topic[0];
                    $ct++;

                }
                                        //ALL STUDY MATERIALS
                                        $num = 1;
                                        $query = "Select m.sm_chapter, m.sm_title, m.sm_desc, m.sm_fileLoc, m.sm_id, m.sm_tchId, us.u_fullname FROM tbl_material m left join tbl_users us on m.sm_tchId = us.u_id LEFT JOIN tbl_stud_material stm ON  stm.material_id = m.sm_id AND stm.stud_id = '" . $_SESSION["user_id"] . "' LEFT JOIN tbl_students st ON st.user_id = '" . $_SESSION["user_id"] . "' AND st.tch_id = m.sm_tchId
                                        WHERE st.tch_id IS NOT NULL AND stm.material_id IS NULL
                                        order by m.sm_dateUpdated desc";
                                        $result = mysqli_query($GLOBALS['conn'], $query);


                                        while ($material_info = mysqli_fetch_array($result)) {
                                        ?>
                                            <div class="col-lg-3">
                                                <div class="info-box card">
                                                    <h3><?php echo ucWords($material_info[1]); ?></h3>
                                                    <p><b><?php echo $topicData[$material_info[0]]; ?></b></p>
                                                    <p><?php echo $material_info[2]; ?></p>
                                                    <h6 class="card-subtitle mt-2 mb-2 text-muted">By: <?php echo $material_info[6]; ?></h6>

                                                    <form action="enrollLessonPage.php" method="post" onsubmit="return confirm('Are you sure you want to enroll this study material?')">
                                                    <input type="hidden" name="tch_id" value="<?php echo $material_info[5]; ?>">
                                                    <input type="hidden" name="tch_name" value="<?php echo $material_info[6]; ?>">
                                                        <input type="hidden" name="sm_id" value="<?php echo $material_info[4]; ?>">
                                                        <input type="hidden" name="sm_fileLoc" value="<?php echo $material_info[3]; ?>">
                                                        <input type="hidden" name="sm_desc" value="<?php echo $material_info[2]; ?>">
                                                        <input type="hidden" name="sm_title" value="<?php echo $material_info[1]; ?>">
                                                        <input type="hidden" name="sm_chapter" value="<?php echo $material_info[0]; ?>">
                                                        <div class="d-grid gap-2 mt-3">
                                                            <button class="btn btn-primary" name="enroll_lesson" type="submit">Enroll Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php
                                            $num++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row gy-4 mt-3">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <?php
                                        //MY STUDY MATERIALS
                                        $num = 1;
                                        $q2 = "SELECT m.sm_chapter, m.sm_title, m.sm_desc, m.sm_fileLoc, m.sm_id, m.sm_tchId, us.u_fullname, stm.dateEnrolled FROM tbl_material m
                                        INNER JOIN tbl_stud_material stm ON stm.material_id = m.sm_id
                                        INNER JOIN tbl_users us ON m.sm_tchId = us.u_id
                                        WHERE stm.stud_id = '" . $_SESSION["user_id"] . "'
                                        ORDER BY m.sm_dateUpdated DESC;";                                        
                                        $result = mysqli_query($GLOBALS['conn'], $q2);


                                        while ($myLesson_info = mysqli_fetch_array($result)) {
                                        ?>
                                            <div class="col-lg-3">
                                                <div class="info-box card">
                                                    <h3><?php echo $myLesson_info[1]; ?></h3>
                                                    <p><b>Topic <?php echo $topicData[$myLesson_info[0]]; ?></b></p>
                                                    <p><?php echo $myLesson_info[2]; ?></p>
                                                    <p class="card-subtitle mt-2 mb-2 text-muted">Enrolled Date:<?php echo date("j F Y", strtotime($myLesson_info[7])); ?></p>

                                                    <form action="enrollLessonPage.php" method="post" >
                                                        <input type="hidden" name="tch_name" value="<?php echo $myLesson_info[6]; ?>">
                                                        <input type="hidden" name="tch_id" value="<?php echo $myLesson_info[5]; ?>">
                                                        <input type="hidden" name="sm_id" value="<?php echo $myLesson_info[4]; ?>">
                                                        <input type="hidden" name="sm_fileLoc" value="<?php echo $myLesson_info[3]; ?>">
                                                        <input type="hidden" name="sm_desc" value="<?php echo $myLesson_info[2]; ?>">
                                                        <input type="hidden" name="sm_title" value="<?php echo $myLesson_info[1]; ?>">
                                                        <input type="hidden" name="sm_chapter" value="<?php echo $myLesson_info[0]; ?>">
                                                        <div class="d-grid gap-2 mt-3">
                                                            <button class="btn btn-primary" name="view_lesson" type="submit">View</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php
                                            $num++;
                                        }
                                        ?>
                                    </div>
                                </div>
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
    if (msg == 'EnrollLesson') {
        message = "You have enrolled the study material succesfully. You can view the study material from your 'My Enrolled Study Material' tab"
    } 
    // else if (msg == 'DelMaterial') {
    //     message = "Lesson has been deleted successfully"
    // }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
    if (msg == 'EnrollLesson') {
        message = "ERROR! Please try enroll the study material again."
    } 
    // else if (msg == 'DelMaterial') {
    //     message = "ERROR! Please try delete the lesson again."
    // }
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
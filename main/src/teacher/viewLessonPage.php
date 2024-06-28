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

//fetch from db
if (isset($_POST["view_lesson"])) {
    $query = "Select sm_id, sm_chapter, sm_title, sm_desc, sm_fileLoc
    FROM tbl_material WHERE sm_tchId = '".$_SESSION['user_id']."' AND sm_id = '".$_POST['lesson_id']."' LIMIT 1";
    $result = mysqli_query($GLOBALS['conn'], $query);
                                                    
    $lesson_info = mysqli_fetch_array($result);
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
      <h1>Study Material</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="studyMaterialPage.php">Study Material</a></li>
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
              <h5 class="card-title">Title: <?= $lesson_info[2]; ?></h5>
              <h6 class="">Topic: <?= $topicData[$lesson_info[1]]; ?></h6>
              <p class="card-text mb-3">Description: <?= $lesson_info[3]; ?></p>
                <div class="container">
                    <embed src="<?php echo './backend/'.$lesson_info[4]; ?>" type="application/pdf" width="100%" height="1000px" />
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
            "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
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
            "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
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
    Header("Location:./studyMaterialPage.php");
}
?>

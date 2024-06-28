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
if (isset($_POST["edit_lesson"])) {
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
      <h1>Edit Study Material</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="studyMaterialPage.php">Study Material</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card ">
            <div class="card-body">
            <h5 class="card-title">Edit Study Material</h5>
              <form class="row g-3" method="post" action="./backend/editLesson.php" onsubmit="return confirm('Are you sure you want to submit?')" enctype="multipart/form-data">
                <div class="col-md-10">
                  <label for="chapter" class="form-label">Topic</label>
                  <input type="text" class="form-control" id="chapter" name="chapter" value="<?= $topicData[$lesson_info[1]]; ?>" disabled>
                </div>
                <div class="col-md-10">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="<?= $lesson_info[2]; ?>" required>
                </div>
                <div class="col-md-10">
                  <label for="textarea" class="form-label">Description</label>
                  <textarea class="form-control" style="height: 70px" name="desc"><?= $lesson_info[3]; ?></textarea>
                </div>
                <div class="col-md-10">
                <input type="hidden" name="file_loc" value="<?= $lesson_info[4]; ?>">
                <input type="hidden" name="tch_id" value="<?= $_SESSION['user_id']; ?>">
                <input type="hidden" name="lesson_id" value="<?= $_POST['lesson_id']; ?>">
                  <label for="file_docs" class="form-label">Upload File</label>
                    <input class="form-control" type="file" id="file" name="file">
                </div>
                <div class="text-center">
                  <button type="submit" name="edit" class="btn btn-primary mt-3">Add New Material</button>
                </div>
              </form>

            </div>
          </div>
        </section>

  </main><!-- End #main -->
  <?= include_once("./tchFooter.php"); ?>
  <script>
    // Get the input element for the file
    const fileInput = document.getElementById('file');

    // Set the maximum size in bytes
    // const maxSize = 1048576; // 1 MB
    const maxSize = 2097152; // 2 MB

    // Add an event listener to the file input
    fileInput.addEventListener('change', (event) => {
      const file = event.target.files[0];
      const fileSize = file.size;
      
      // Check if the file size exceeds the maximum size limit
      if (fileSize > maxSize) {
        alert('File size exceeds the maximum limit of 2 MB.');
        // Reset the file input to clear the selected file
        fileInput.value = '';
      }
    });
  </script>
</body>

</html>
<?php
} else {
    Header("Location:./studyMaterialPage.php");
}
?>
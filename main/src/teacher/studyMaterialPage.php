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
          <li class="breadcrumb-item active">Study Material</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Study Material</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col-1">No</th>
                    <th scope="col-1">Topic</th>
                    <th scope="col-1">Title</th>
                    <th scope="col-1">Description</th>
                    <th scope="col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  $query = "Select m.sm_id, m.sm_chapter, m.sm_title, m.sm_desc, m.sm_tchId, t.id, t.topic
                  FROM tbl_material m left join tbl_topic t on t.id = m.sm_chapter WHERE m.sm_tchId = '".$_SESSION['user_id']."' AND status = 1 order by m.sm_dateUpdated desc";
                  $result = mysqli_query($GLOBALS['conn'], $query);
                                                

                  while ($lesson_info = mysqli_fetch_array($result)) {
                  ?>

                  <tr>
                  <th scope="col-1"><?php echo $num; ?></th>
                  <td><?php echo $lesson_info[5] . '- '. $lesson_info[6]; ?></td>
                  <td><?php echo $lesson_info[2]; ?></td>
                  <td><?php echo $lesson_info[3]; ?></td>
                  <td>
                  <div class="d-flex">
                    
                                                        <form action="viewLessonPage.php" method="post">
                                                            <input type="hidden" name="tch_id"
                                                                value="<?php echo $lesson_info[4]; ?>">
                                                            <input type="hidden" name="lesson_id"
                                                                value="<?php echo $lesson_info[0]; ?>">
                                                            <button class="btn btn-outline-primary"
                                                                style="margin-right:5px;" name="view_lesson"
                                                                type="submit">View</button>
                                                        </form>
                                                        <form action="editLessonPage.php" method="post">
                                                            <input type="hidden" name="tch_id"
                                                                value="<?php echo $lesson_info[4]; ?>">
                                                            <input type="hidden" name="lesson_id"
                                                                value="<?php echo $lesson_info[0]; ?>">
                                                            <button class="btn btn-outline-secondary"
                                                                name="edit_lesson" type="submit" style="margin-right:5px;">Edit</button>
                                                        </form>
                                                        <form action="./backend/deleteLesson.php" method="post" onsubmit="return confirm('Are you sure you want to delete this material? This action cannot be undone.')">
                                                            <input type="hidden" name="tch_id"
                                                                value="<?php echo $lesson_info[4]; ?>">
                                                            <input type="hidden" name="lesson_id"
                                                                value="<?php echo $lesson_info[0]; ?>">
                                                            <button class="btn btn-outline-danger"
                                                                name="delete_lesson" type="submit" style="margin-right:5px;">Delete</button>
                                                        </form>
                                                        </div>
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
      } else if (msg == 'EditMaterial') {
        message = "Lesson has been updated successfully"
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
      } else if (msg == 'EditMaterial') {
        message = "ERROR! Please try update the lesson again."
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
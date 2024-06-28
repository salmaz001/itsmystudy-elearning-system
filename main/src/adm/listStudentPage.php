<?php
include_once '../../configs/dbconfig.php';
include_once("./backend/checkingLoginAdm.php");
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
<?= include_once("./headAdm.php"); ?>

<body>
    <?= include_once("./headerAdm.php"); ?>
    <?= include_once("./sidebarAdm.php"); ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Student</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
      <div class="row">
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Students</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col-1">No</th>
                    <th scope="col-1">Full Name</th>
                    <th scope="col-1">Email</th>
                    <th scope="col-1">Identification No</th>
                    <!-- <th scope="col">Mobile No</th> -->
                    <th scope="col">Gender</th>
                    <th scope="col">Supervisor</th>
                    <!-- <th scope="col">Date of Birth</th>
                    <th scope="col">Age</th> -->
                    <th>Status</th>
                    <th scope="col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  $query = "Select us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, tc.ic_no, tc.dob, tc.gender , tc.tch_id
                  FROM tbl_students tc 
                  left join 
                  tbl_users us
                  on tc.user_id = us.u_id order by us.u_createdAt desc, us.u_status ASC";
                  // die();
                  $result = mysqli_query($GLOBALS['conn'], $query);
                                                

                  while ($stud_info = mysqli_fetch_array($result)) {
                    $q1 = "select u_fullname from tbl_users where u_id = '" . $stud_info[9] . "' LIMIT 1";
                    $r = mysqli_query($GLOBALS['conn'], $q1);
                    $tch_info = mysqli_fetch_array($r)
                  ?>

                  <tr>
                  <th scope="row"><?php echo $num; ?></th>
                  <td><?php echo $stud_info[1]; ?></td>
                  <td><?php echo $stud_info[2]; ?></td>
                  <td><?php echo $stud_info[6]; ?></td>
                  <!-- <td><?php echo $stud_info[4]; ?></td> -->
                  <td><?php echo ucWords($stud_info[8]); ?></td>
                  <td><?php echo ucWords($tch_info[0]); ?></td>
                  <td class="text-center" >
                  <?php
                  switch ($stud_info[5]) {
                    case 'A':?>
                      <span class="badge rounded-pill bg-success" style="width: 50px;">Active</span>
                  <?php 
                      break;
                    default:
                                                                ?>
                                                        <span class="badge rounded-pill bg-danger"
                                                            style="width: 50px;">Inactive</span>
                                                        <?php
                                                                    break;
                                                            }
                                                            ?>
                                                    </td>
                                                    <td class="text-center d-flex align-items-center">
                                                        <form action="viewStudent.php" method="post" class="pb-2 d-flex">
                                                            <input type="hidden" name="stud_id"
                                                                value="<?php echo $stud_info[0]; ?>">
                                                            <input type="hidden" name="stud_icNo"
                                                                value="<?php echo $stud_info[6]; ?>">
                                                            <button class="btn btn-outline-primary"
                                                                style="margin-right:5px;" name="viewstud"
                                                                type="submit"><i class="bi bi-eye-fill"></i></button>
                                                        </form>
                                                        <form action="./backend/deleteStudent.php" method="post">
                                                            <input type="hidden" name="stud_id"
                                                                value="<?php echo $stud_info[0]; ?>">
                                                            <input type="hidden" name="stud_icNo"
                                                                value="<?php echo $stud_info[6]; ?>">
                                                            <button class="btn btn-outline-secondary"
                                                                name="delStud" type="submit"><i class="bi bi-trash-fill"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $num++;
                                                } ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    </main><!-- End #main -->
    <?= include_once("./footerAdm.php"); ?>
<script type="text/javascript">

var msg_status = <?php echo json_encode($msg_status); ?>;
var msg = <?php echo json_encode($msg); ?>;

switch (msg_status) {
    case 'success':
      if (msg == 'AddStudent') {
        message = "New student has been added succesfully, an email confirmation with their user credentials has been sent to their email."
      } else if (msg == 'DelStudent'){
        message = "Student has been deleted successfully"
      }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
      if (msg == 'AddStudent') {
        message = "ERROR! Please try add the student again."
      } else if (msg == 'AddStudent_emailExist') {
        message = "ERROR! Email already been registered, please try with another email."
      } else if (msg == 'DelStudent'){
        message = "ERROR! Please try delete the student again."
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
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
            <h1>Teacher</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Teacher</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
      <div class="row">
      <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Teachers</h5>

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
                    <!-- <th scope="col">Date of Birth</th>
                    <th scope="col">Age</th> -->
                    <th>Status</th>
                    <th scope="col-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  $query = "Select us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, tc.ic_no, tc.dob, tc.gender 
                  FROM tbl_teachers tc 
                  left join 
                  tbl_users us
                  on tc.user_id = us.u_id order by us.u_fullname desc";
                  // die();
                  $result = mysqli_query($GLOBALS['conn'], $query);
                                                

                  while ($tch_info = mysqli_fetch_array($result)) {
                  ?>

                  <tr>
                  <th scope="row"><?php echo $num; ?></th>
                  <td><?php echo $tch_info[1]; ?></td>
                  <td><?php echo $tch_info[2]; ?></td>
                  <td><?php echo $tch_info[6]; ?></td>
                  <!-- <td><?php echo $tch_info[4]; ?></td> -->
                  <td><?php echo $tch_info[8]; ?></td>
                  <td class="text-center">
                  <?php
                  switch ($tch_info[5]) {
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
                                                    <td class="d-flex">
                                                        <form action="viewTeacher.php" method="post">
                                                            <input type="hidden" name="tch_id"
                                                                value="<?php echo $tch_info[0]; ?>">
                                                            <input type="hidden" name="tch_icNo"
                                                                value="<?php echo $tch_info[6]; ?>">
                                                            <button class="btn btn-outline-primary"
                                                                style="margin-right:5px; float:left;" name="viewtch"
                                                                type="submit"><i class="bi bi-eye-fill"></i></button>
                                                        </form>
                                                        <!-- <form action="edit_tch_form.php" method="post">
                                                            <input type="hidden" name="tch_id"
                                                                value="<?php echo $tch_info[0]; ?>">
                                                            <input type="hidden" name="tch_icNo"
                                                                value="<?php echo $tch_info[6]; ?>">
                                                            <button class="btn btn-outline-secondary"
                                                                name="edittch" type="submit"><i class="bi bi-trash-fill"></i></button>
                                                        </form> -->
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
      if (msg == 'AddTeacher') {
        message = "New Teacher has been added succesfully, an email confirmation with their user credentials has been sent to their email."
      }
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>"+ message +"</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
    case 'error':
      if (msg == 'AddTeacher') {
        message = "ERROR! Please try add the teacher again."
      } else if (msg == 'AddTeacher_emailExist') [
        message = "ERROR! Email already been registered, please try with another email."
      ]
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
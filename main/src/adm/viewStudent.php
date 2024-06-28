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
          <li class="breadcrumb-item"><a href="./listStudentPage.php">Student</a></li>
          <li class="breadcrumb-item active">View Student</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="text-center mt-4" id="divmsg"></div>

        <div class="col-lg-12">
          <?php
          if (isset($_POST["viewstud"])) {
            $query = "Select us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, st.ic_no, st.dob, st.gender , us.u_createdAt
            FROM tbl_students st 
            left join 
            tbl_users us
            on st.user_id = us.u_id
            where us.u_id = '" . $_POST['stud_id'] . "' LIMIT 1";
            $result = mysqli_query($GLOBALS['conn'], $query);
            $stud_info = mysqli_fetch_array($result);
          } else {
            echo "<script>alert('No student has been selected');document.location='./listStudentPage.php'</script>";
          }

          ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Student Information</h5>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <th class="col-lg-2">Account ID</th>
                    <td scope="col"><?php echo $stud_info[0]; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Status</th>
                    <td><?php echo $stud_info[5] == "A" ? "ACTIVE" : "INACTIVE"; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Date Joined</th>
                    <td><?php echo $stud_info[9]; ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th scope="row">Full Name</th>
                    <td><?php echo $stud_info[1]; ?></td>
                  </tr>

                  <tr>
                    <th scope="row">Email Address</th>
                    <td><?php echo $stud_info[2]; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Mobile Number</th>
                    <td><?php echo $stud_info[4]; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Identification No.</th>
                    <td><?php echo $stud_info[6]; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Date of Birth</th>
                    <td><?php echo $stud_info[7]; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Gender</th>
                    <td><?php echo $stud_info[8]; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?= include_once("./footerAdm.php"); ?>
</body>

</html>
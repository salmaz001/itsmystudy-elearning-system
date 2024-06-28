<?php
include_once("./backend/checkingLoginAdm.php");
?>
<!DOCTYPE html>
<html lang="en">
<?= include_once("./headAdm.php"); ?>

<body>
    <?= include_once("./headerAdm.php"); ?>
    <?= include_once("./sidebarAdm.php"); ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registration</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./listTeacherPage.php">Teacher</a></li>
                    <li class="breadcrumb-item active">Register</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
        <div class="card ">
            <div class="card-body">
            <h5 class="card-title">New Teacher Registration Form</h5>
              <form class="row g-3" method="post" action="./backend/addNewTeacher.php" onsubmit="return confirm('Are you sure you want to submit?')">
                <div class="col-md-6">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                  <label for="mobileNo" class="form-label">Mobile No.</label>
                  <input type="text" class="form-control" id="mobileNo" name="mobileNo" required>
                </div>
                <div class="col-md-6">
                  <label for="icNo" class="form-label">Identification No.</label>
                  <input type="text" class="form-control" id="icNo" name="icNo" required>
                </div>
                <div class="col-md-6">
                  <label for="dob" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  <select id="gender" name="gender" class="form-select" required>
                    <option selected disabled>Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                  </select>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary mt-3">Add New Teacher</button>
                </div>
              </form>

            </div>
          </div>
        </section>

    </main><!-- End #main -->
    <?= include_once("./footerAdm.php"); ?>

</body>

</html>
<?php
include_once("./backend/checkingLogin.php");
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
      <h1>Add Exercise</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="listExercisePage.php">Exercise</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="card ">
        <div class="card-body">
          <h5 class="card-title">Add New Exercise</h5>
          <form class="row g-3" method="post"  action="./addExercisePage1.php" enctype="multipart/form-data">
            <div class="col-md-10">
              <label for="ex_name" class="form-label">Exercise Name</label>
              <input type="text" class="form-control" id="ex_name" name="ex_name" required>
            </div>
            <div class="col-md-10 pb-5">
              <label for="textarea" class="form-label">Exercise Description</label>
              <textarea class="form-control" style="height: 70px" name="desc" required></textarea>
            </div>
            <hr>
            <h5>Questions</h5>
            <p>You need to choose the correct answer for each of the questions, there will be 3 choice options for each questions and you can add only one image for the question if necessary.</p>
            <div class="col-md-10">
              <label for="numQues" class="form-label">Number of Questions</label>
              <input type="number" class="form-control" id="numQues" name="numQues" min="3" required>
            </div>
            <div class="text-center">
              <button type="submit" name="submit_ex1" class="btn btn-primary mt-3">Next</button>
            </div>
          </form>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?= include_once("./tchFooter.php"); ?>
  <script>
  </script>
</body>

</html>
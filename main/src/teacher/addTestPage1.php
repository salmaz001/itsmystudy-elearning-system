<?php
include_once("./backend/checkingLogin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?= include_once("./tchHead.php"); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Detect back button click event
    // window.onbeforeunload = function(event) {
    //     return ("Are you sure you want to leave? Changes you made may not be saved");
    // };
</script>
</head>

<body>

  <!-- ======= Header ======= -->
  <?= include_once("./tchHeader.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?= include_once("./tchSidebar.php"); ?>
<?php
if (isset($_POST["submit_test1"])) {
  $_SESSION['ques'] = array(
    'name' => $_POST['test_name'],
    'desc' => $_POST['desc'],
    'numQues' => $_POST['numQues']
);
$numQues = $_POST["numQues"];
  } else {
      echo "<script>alert('Error, please try again.');document.location='./addTestPage.php'</script>";
  }
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="listTestPage.php">Test</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="card ">
        <div class="card-body">
          <h5 class="card-title">Add New Test</h5>
          <form class="row g-3" method="post" action="./backend/addTest.php" onsubmit="return confirm('Are you sure you want to submit? You cannot edit the test once you have submit the form')" enctype="multipart/form-data">
            <h5>Questions</h5>
            <p>You need to choose the correct answer for each of the questions, minimum questions for 1 test are 3 questions, 3 choice options for each questions and you can add only one image for the question if necessary.</p>
            <div id="questions">
              <?php
for($i = 1; $i <= $numQues; $i++) {
  ?>
<div id="question<?php echo $i; ?>">
                <hr>
                <div class="col-md-10 mb-2">
                  <label for="text" class="form-label"><b>Question <?php echo $i; ?></b></label>
                  <input type="text" class="form-control" name="question[]" required>
                </div>
                <div class="col-md-10">
                  <label for="file_docs" class="form-label">Upload Image for the question (if any)</label>
                  <input class="form-control" type="file" name="file[]" accept="image/*" multiple="false">
                </div>
                <br>
                <div class="col-md-10" id="options<?php echo $i; ?>">
                  <h5>Answer Options</h5>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Option 1</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="options[<?php echo $i; ?>][]" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Option 2</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="options[<?php echo $i; ?>][]" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Option 3</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="options[<?php echo $i; ?>][]" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-10 pb-5">
                  <label class="form-label">Select Correct Answer</label>
                  <select class="form-select" name="correct_answer[<?php echo $i; ?>]" required>
                    <option selected>Select</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                  </select>
                </div>
              </div>
  <?php
}
              ?>
              
            </div>
            <div class="text-center">
              <button type="submit" name="submit_test_final" class="btn btn-primary mt-3">Add Test</button>
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
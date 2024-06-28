<?php
include_once '../../configs/dbconfig.php';
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
      <h1>Add Study Material</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item"><a href="studyMaterialPage.php">Study Material</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card ">
            <div class="card-body">
            <h5 class="card-title">Upload New Study Material</h5>
              <form class="row g-3" method="post" action="./backend/addStudyMaterial.php" onsubmit="return confirm('Are you sure you want to submit?')" enctype="multipart/form-data">
                <div class="col-md-10">
                  <label for="chapter" class="form-label">Topic</label>
                  <select id="chapter" name="chapter" class="form-select" required>
                <option selected disabled>Select Topic</option>
                <?php
                $query = "Select id, topic from tbl_topic order by id asc";
                // die();
                $result = mysqli_query($GLOBALS['conn'], $query);

                while ($topic = mysqli_fetch_array($result)) {
                ?>
                  <option value="<?php echo $topic[0]; ?>"><?php echo $topic[1]; ?></option>
                <?php
                }
                ?>
              </select>
                </div>
                <div class="col-md-10">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-10">
                  <label for="textarea" class="form-label">Description</label>
                  <textarea class="form-control" style="height: 70px" name="desc"></textarea>
                </div>
                <div class="col-md-10">
                  <label for="file_docs" class="form-label">Upload File</label>
                    <input class="form-control" type="file" id="file" name="file" required>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary mt-3">Add New Material</button>
                </div>
              </form>

            </div>
          </div>
        </section>

  </main><!-- End #main -->
  <?= include_once("./tchFooter.php"); ?>
  <script>
    // Get the input element for the file
    // const fileInput = document.getElementById('file');

    // // Set the maximum size in bytes
    // // const maxSize = 1048576; // 1 MB
    // const maxSize = 2097152; // 2 MB

    // // Add an event listener to the file input
    // fileInput.addEventListener('change', (event) => {
    //   const file = event.target.files[0];
    //   const fileSize = file.size;
      
    //   // Check if the file size exceeds the maximum size limit
    //   if (fileSize > maxSize) {
    //     alert('File size exceeds the maximum limit of 2 MB.');
    //     // Reset the file input to clear the selected file
    //     fileInput.value = '';
    //   }
    // });
  </script>
</body>

</html>
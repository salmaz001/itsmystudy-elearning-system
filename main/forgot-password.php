<?php
session_start();

if (isset($_SESSION['reg_status'])) {
  $reg_status = $_SESSION['reg_status'];
  unset($_SESSION['reg_status']);
} else {
  $reg_status = "";   // No message to display 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ITSMYSTUDY</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/logo2.png" rel="icon">
  <link href="../assets/img/logo2.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>

<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo1.png" alt="">
                  <!-- <span class="d-none d-lg-block">ITSMYSTUDY</span> -->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
                <div class="text-center mt-4" id="divmsg"></div>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot your password?</h5>
                    <p class="text-center small">Enter your email to reset your password</p>
                  </div>

                  <form class="row g-3 needs-validation" name="reset_pwd" id="reset_pwd" novalidate method="POST"  onsubmit="return validateEmail()">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>
                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100" id="submit-btn" type="submit" name="reset_pwd">Reset Password</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0 text-center"><a href="index.php">Login</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
<!-- -------------------------------------------------- S C R I P T ---------------------------------------------- -->
<script>
$(document).ready(function() {
  $('#reset_pwd').submit(function(event) {
    event.preventDefault(); // prevent form from submitting normally
    var formData = $(this).serialize(); // serialize the form data
    $("#submit-btn").attr("disabled", true);
    $('#divmsg').html("<div class='text-start alert alert-primary bg-primary text-light border-0 alert-dismissible fade show'><strong>Loading..</strong></div>");
    $.ajax({
      type: 'POST',
      url: 'backend/reset_pwd.php',
      data: formData,
      success: function(response) {
        $('#divmsg').html(''); 
        $('#divmsg').html(response); // display response from server
        $("#submit-btn").attr("disabled", false);
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 4000);
      }
    });
  });
});

  function validateEmail() {
  const emailInput = document.querySelector('input[type="email"]');
  const email = emailInput.value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  if (!emailRegex.test(email)) {
    alert('Please enter a valid email address');
    return false; // prevents form from submitting
  }
  
  return confirm('Are you sure you want to reset your password?'); // allows form to submit
}
</script>
<script type="text/javascript">

var regStatus = <?php echo json_encode($reg_status); ?>;

switch (regStatus) {
    // case 'success':
    //     document.getElementById("divmsg").innerHTML =
    //     "<div class='alert alert-light-success'><strong>You have successfully registered! Please enter your sign-in credentials to continue.</strong></div>";
    //     setTimeout(function() {
    //         document.getElementById('divmsg').innerHTML = '';
    //     }, 4000);
    //     break;
    case 'errlogin':
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>ERROR. Incorrect Sign-In credentials! Please enter your correct Sign-In credentials.</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 4000);
        break;
    case 'errloginrec': 
        document.getElementById("divmsg").innerHTML =
        "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>ERROR. Invalid Sign-In credentials! Please enter your correct Sign-In credentials.</strong></div>";
        setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
        }, 4000);
        break;

}
</script>
</body>

</html>
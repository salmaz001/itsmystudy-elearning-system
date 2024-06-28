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
if (isset($_POST["answer_test"])) {
  $test_id = $_POST["test_id"];
  $tch_id = $_POST["tch_id"];

  $queryTest = "Select test_name, test_desc, test_noQuest, created_at
  FROM tbl_test WHERE test_id = '" . $test_id . "' LIMIT 1";
  $result = mysqli_query($GLOBALS['conn'], $queryTest);

  $test_info = mysqli_fetch_array($result);
?>
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?= include_once("./stdHead.php"); ?>
  </head>

  <body>

    <!-- ======= Header ======= -->
    <?= include_once("./stdHeader.php"); ?>

    <!-- ======= Sidebar ======= -->
    <?= include_once("./stdSidebar.php"); ?>

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Answer Test</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
            <li class="breadcrumb-item"><a href="listTestPage.php">Test</a></li>
            <li class="breadcrumb-item active">Answer Test</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">

          <div class="text-center mt-4" id="divmsg"></div>

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <div class="card-body">
                  <h5 class="card-title"><?php echo $test_info[0]; ?></h5>
                  <p><?php echo $test_info[1]; ?></p>
                  <!-- <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <th scope="row">Description:</th>
                        <td><?php echo $test_info[1]; ?></td>
                      </tr>
                    </tbody>
                  </table> -->
                  <hr>
                  <!-- <h5 class="card-title">Questions</h5> -->
                  <p>Please answer all the questions before you submit your answers.</p>
                  <form action="./backend/answerTest.php" method="post" onsubmit="return confirm('Are you sure you want to submit?')">

                  <?php
                  $queryQues = "Select ques, image, ques_id FROM tbl_ques WHERE  test_id = '" . $test_id . "'";
                  $resultQues = mysqli_query($GLOBALS['conn'], $queryQues);
                  $quesNo = 1;
                  $questions = array();
                  $options = array();

                  while ($ques_info = mysqli_fetch_array($resultQues)) {
                    $questionId = $ques_info[2];
                    $questionText = $ques_info[0];
                    $questionImage = $ques_info[1];

                    $questions[] = array(
                      'question' => $questionText,
                      'id' => $questionId,
                      'image' => $questionImage,
                  );

                }
                shuffle($questions);
                foreach ($questions as $index => $question):
                  ?>
                    <div class="card pt-3">
                      <div class="card-body">
                      <input type="hidden" name="quesNo<?php echo $quesNo; ?>" value="<?php echo $question['id']; ?>">
                        <?php
                        if ($question['image'] != '-') {
                        ?>
                          <img src="../teacher/backend/<?php echo $question['image']; ?>" class="rounded mx-auto d-block" style="max-height:250px;" alt="question_image">
                        <?php
                        }
                        ?>
                        <p><b>Question <?php echo $quesNo; ?> - </b> <?php echo $question['question']; ?></p>
                        <?php
                        $queryOpt = "Select options, opt_id, correct_ans FROM tbl_options WHERE  test_id = '" . $test_id . "' AND ques_id = '" . $question['id'] . "'";
                        $resultOpt = mysqli_query($GLOBALS['conn'], $queryOpt);
                        $optNo = 1;
                        ?>
                        <table class="table table-borderless">
                          <tbody>
                            <div class="col-sm-10">
                              <?php
                              while ($opt_info = mysqli_fetch_array($resultOpt)) {
                                if ($opt_info[2] == 1) { ?>
                                  <input type="hidden" name="correct_ans<?php echo $quesNo; ?>" value="<?php echo $opt_info[1]; ?>">
                                <?php
                                }
                                ?>
                                <tr>
                                  <td scope="col">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="opt<?php echo $quesNo; ?>" id="opt<?php echo $quesNo; ?>" value="<?php echo $opt_info[1]; ?>">
                                      <label class="form-check-label" for="opt<?php echo $quesNo; ?>">
                                        <?php echo $opt_info[0]; ?>
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                              <?php
                                $optNo++;
                              }
                              ?>
                            </div>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  <?php
                    $quesNo++;
                  endforeach;
                  ?>
                  
                  <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                  <input type="hidden" name="tch_id" value="<?php echo $tch_id; ?>">
                  <input type="hidden" name="quest_no" value="<?php echo $test_info[2]; ?>">
                  <div class="text-center">
              <button type="submit" name="submit_answer" class="btn btn-primary mt-3">Submit Answer</button>
            </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
        </div>
      </section>
    </main><!-- End #main -->
    <?= include_once("./stdFooter.php"); ?>
    <script>
      function validatePassword() {
        var pwd = document.getElementById("password").value;

        var regix = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
        if (regix.test(pwd) == false) {
          alert("Password must contain at least 8 characters long, 1 lowercase letter, 1 uppercase letter and 1 number");
          return false;
        }

        var repwd = document.getElementById("repassword").value;
        if (repwd != pwd) {
          alert("Your Password do not match");
          return false;
        }

        return confirm('Are you sure you want to change your password?');
      }
    </script>

    <script type="text/javascript">
      var msg_status = <?php echo json_encode($msg_status); ?>;
      var msg = <?php echo json_encode($msg); ?>;

      switch (msg_status) {
        case 'success':
          if (msg == 'editProfile') {
            message = "Profile has been updated successfully"
          } else if (msg == 'changePwd') {
            message = "Password has been changed successfully"
          }
          document.getElementById("divmsg").innerHTML =
            "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
          setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
          }, 6000);
          break;
        case 'error':
          if (msg == 'editProfile') {
            message = "ERROR! Please try update the information again."
          } else if (msg == 'changePwd') {
            message = "ERROR! Please try change the password again."
          }
          document.getElementById("divmsg").innerHTML =
            "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
          setTimeout(function() {
            document.getElementById('divmsg').innerHTML = '';
          }, 6000);
          break;
      }
    </script>
  </body>

  </html>
<?php
} else {
  Header("Location:./listTestPage.php");
}
?>
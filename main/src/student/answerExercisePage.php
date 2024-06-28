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
if (isset($_POST["answer_exercise"])) {
  $ex_id = $_POST["ex_id"];
  $tch_id = $_POST["tch_id"];

  $queryEx = "Select ex_name, ex_desc, ex_noQuest, created_at
  FROM tbl_exercise WHERE ex_id = '" . $ex_id . "' LIMIT 1";
  $result = mysqli_query($GLOBALS['conn'], $queryEx);

  $test_info = mysqli_fetch_array($result);
?>
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?= include_once("./stdHead.php"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>

  <body>

    <!-- ======= Header ======= -->
    <?= include_once("./stdHeader.php"); ?>

    <!-- ======= Sidebar ======= -->
    <?= include_once("./stdSidebar.php"); ?>

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Answer Exercise</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
            <li class="breadcrumb-item"><a href="listExercisePage.php">Exercise</a></li>
            <li class="breadcrumb-item active">Answer Exercise</li>
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
                  <p>Please click on the option that you think are the answer.</p>
                  <!-- <form action="./backend/answerExercise.php" method="post" onsubmit="return confirm('Are you sure you want to submit?')"> -->

                  <?php
                  $queryQues = "Select ques, image, ques_id FROM tbl_ex_ques WHERE  ex_id = '" . $ex_id . "'";
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
                        $queryOpt = "Select options, opt_id, correct_ans FROM tbl_ex_opt WHERE  ex_id = '" . $ex_id . "' AND ques_id = '" . $question['id'] . "'";
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
                                      <input class="form-check-input option" type="radio" name="opt<?php echo $quesNo; ?>" id="opt<?php echo $quesNo; ?>" value="<?php echo $opt_info[1]; ?>">
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
<span class="result"></span>
                      </div>
                    </div>
                  <?php
                    $quesNo++;
                  endforeach;
                  ?>
                  
                  <input type="hidden" name="ex_id" value="<?php echo $ex_id; ?>">
                  <input type="hidden" name="tch_id" value="<?php echo $tch_id; ?>">
                  <input type="hidden" name="quest_no" value="<?php echo $test_info[2]; ?>">
                  <div class="text-center">
              <a class="btn btn-primary mt-3" href="listExercisePage.php">Done Answer</a>
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
$(document).ready(function() {
  $('.option').click(function() {
    var selectedOption = $(this).val();
    var questionId = $(this).closest('.card-body').find('input[type=hidden]').val();
    var resultElement = $(this).closest('.card-body').find('.result');

    $.ajax({
      type: 'POST',
      url: './backend/checkAnswerExercise.php', // Replace with the URL of your server-side script
      data: {
        selectedOption: selectedOption,
        questionId: questionId
      },
      success: function(response) {
        resultElement.html(response); // Update the result element with the response
      }
    });
  });
});
</script>

  </body>

  </html>
<?php
} else {
  Header("Location:./listExercisePage.php");
}
?>
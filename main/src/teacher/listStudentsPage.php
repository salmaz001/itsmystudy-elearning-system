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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?= include_once("./tchHead.php"); ?>
  <!-- ajax  -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
  <!-- ======= Header ======= -->
  <?= include_once("./tchHeader.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?= include_once("./tchSidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Students</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mainpage.php">Home</a></li>
          <li class="breadcrumb-item active">Students</li>
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
              <div class="col-lg-12 align-items-end d-flex justify-content-end pb-4">
                <div class="col-md-3 align-items-end d-flex justify-content-end">

                  <select ame="topic_filter" id="topic_filter" class="form-select" required>
                    <option selected disabled>Filter by Topic</option>
                    <option value="all">All Students</option>
                    <?php
                    $query = "Select id, topic FROM tbl_topic";
                    // die();
                    $result = mysqli_query($GLOBALS['conn'], $query);

                    while ($topic = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $topic[0]; ?>" class="filter"><?php echo $topic[1]; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <table id="tableData" class="table tablecolour" style="width:100%">
                <thead>
                  <th>No</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Identification No</th>
                  <th>Mobile No</th>
                  <th>Gender</th>
                  <th>Date Enrolled</th>
                </thead>
                <tbody>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?= include_once("./tchFooter.php"); ?>

  <script type="text/javascript">
    var msg_status = <?php echo json_encode($msg_status); ?>;
    var msg = <?php echo json_encode($msg); ?>;

    switch (msg_status) {
      case 'success':
        if (msg == 'AddMaterial') {
          message = "New Students has been added succesfully."
        } else if (msg == 'DelMaterial') {
          message = "Lesson has been deleted successfully"
        } else if (msg == 'EditMaterial') {
          message = "Lesson has been updated successfully"
        }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-success bg-success text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;
      case 'error':
        if (msg == 'AddMaterial') {
          message = "ERROR! Please try add the Students again."
        } else if (msg == 'DelMaterial') {
          message = "ERROR! Please try delete the lesson again."
        } else if (msg == 'EditMaterial') {
          message = "ERROR! Please try update the lesson again."
        }
        document.getElementById("divmsg").innerHTML =
          "<div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show'><strong>" + message + "</strong></div>";
        setTimeout(function() {
          document.getElementById('divmsg').innerHTML = '';
        }, 6000);
        break;

    }
  </script>
  <script type="text/javascript" language="javascript">
    // $(document).ready(function(){

    //  load_data();

    //  function load_data(topic)
    //  {
    //   var dataTable = $('#order_data').DataTable({
    //    "processing":true,
    //    "serverSide":true,
    //    "order":[],
    //    "ajax":{

    //     url:"fetch_student_by_topic.php",
    //     type:"POST",
    //     data:{topic:topic}
    //    }
    //   });
    //  }

    //  $(document).on('change', '#topic_filter', function(){
    //   var topic = $(this).val();
    //   $('#order_data').DataTable().destroy();
    //   if(topic != '')
    //   {
    //    load_data(topic);
    //   }
    //   else
    //   {
    //    load_data();
    //   }
    //  });

    $(document).ready(function() {

      inserted = false; // product record not inserted yet
      editData = false;

      // Get all PRODUCT data records
      $('#tableData').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        //
        // 'deferRender':    true,
        // 'scrollX':        true,
        // 'scrollY':        200,
        // 'scrollCollapse': true,
        // 'scroller':       true,
        // 'searching':      false,
        // 'paging':         true,
        'info': false,
        'order': [],
        "columnDefs": [{
          "width": "15%",
          "targets": 0,
          "width": "15%",
          "targets": 1,
          "width": "25%",
          "targets": 2,
          "width": "35%",
          "targets": 3,
          "width": "15%",
          "targets": 4,
          "width": "15%",
          "targets": 5,
          "width": "15%",
          "targets": 6,
        }],
        'fixedColumns': true,
        'ajax': {
          'url': 'fetch_student_all.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [3]
          },

        ]
      });

      $('#tableData td').css('white-space', 'initial');

      $(document).on('change', '#topic_filter', function() {
        var topic = $(this).val();
        $('#tableData').DataTable().destroy();
        $('#tableData').DataTable({
          "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
          },
          'serverSide': 'true',
          'processing': 'true',
          'paging': 'true',
          'info': false,
          'order': [],
          "columnDefs": [{
            "width": "15%",
            "targets": 0,
            "width": "15%",
            "targets": 1,
            "width": "25%",
            "targets": 2,
            "width": "35%",
            "targets": 3,
            "width": "15%",
            "targets": 4,
            "width": "15%",
            "targets": 5,
            "width": "15%",
            "targets": 6,
          }],
          'fixedColumns': true,
          'ajax': {
            'url': 'fetch_student_by_topic.php',
            'type': 'post',
            'data': {
              topic: topic
            }
          },
          "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [3]
            },

          ]
        });

      });
      $('#tableData td').css('white-space', 'initial');

    });

    // });
  </script>
</body>

</html>
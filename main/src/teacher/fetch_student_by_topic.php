<?php

include_once '../../configs/dbconfig.php';
include_once("./backend/checkingLogin.php");

$topic = $_POST["topic"];
$topicSql = "";
// $topicSql = "left join tbl_stud_material stm 
// ON us.u_id = stm.stud_id ";
$output= array();

if($topic != "all"){
//  $topicSql = " AND stm.topic_id = '" . $topic . "'";
 $sql = "Select DISTINCT us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, tc.ic_no, tc.dob, tc.gender , tc.tch_id, us.u_createdAt, stm.dateEnrolled
FROM tbl_students tc 
LEFT JOIN tbl_users us ON tc.user_id = us.u_id
LEFT JOIN tbl_stud_material stm ON us.u_id = stm.stud_id
JOIN (
    SELECT stud_id, MAX(dateEnrolled) AS maxDateEnrolled
    FROM tbl_stud_material
    GROUP BY stud_id
) AS maxEnrolled ON stm.stud_id = maxEnrolled.stud_id AND stm.dateEnrolled = maxEnrolled.maxDateEnrolled
WHERE tc.tch_id = '" . $_SESSION['user_id'] . "'
AND us.u_status = 'A'
AND stm.topic_id = stm.topic_id = '" . $topic . "' ;";
// left join 
// tbl_users us
// on tc.user_id = us.u_id 
// left join tbl_stud_material stm 
// ON us.u_id = stm.stud_id
// WHERE tc.tch_id = '" . $_SESSION['user_id'] . "' and us.u_status = 'A' ". $topicSql ."";


// $sql = "SELECT DISTINCT us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, tc.ic_no, tc.dob, tc.gender, tc.tch_id, us.u_createdAt, stm.dateEnrolled
// FROM tbl_students tc
// LEFT JOIN tbl_users us ON tc.user_id = us.u_id
// LEFT JOIN tbl_stud_material stm ON us.u_id = stm.stud_id
// JOIN (
//     SELECT stud_id, MAX(dateEnrolled) AS maxDateEnrolled
//     FROM tbl_stud_material
//     GROUP BY stud_id
// ) AS maxEnrolled ON stm.stud_id = maxEnrolled.stud_id AND stm.dateEnrolled = maxEnrolled.maxDateEnrolled
// WHERE tc.tch_id = '" . $_SESSION['user_id'] . "'
//     AND us.u_status = 'A'
//     AND stm.topic_id = stm.topic_id = '" . $topic . "' ;";

// echo $sql;die();
} else {
$sql = "Select us.u_id, us.u_fullname, us.u_email, us.u_type, us.u_mobileNo, us.u_status, tc.ic_no, tc.dob, tc.gender , tc.tch_id, us.u_createdAt
FROM tbl_students tc 
left join 
tbl_users us
on tc.user_id = us.u_id WHERE tc.tch_id = '" . $_SESSION['user_id'] . "' and us.u_status = 'A' ";

}

// echo $sql;
// if(mysqli_query($GLOBALS['conn'], $sql)){
// 	echo "jj";
// } else {
// 	echo "kkk";
// }

$totalQuery = mysqli_query($GLOBALS['conn'], $sql);

$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'no',
	1 => 'fullname',
	2 => 'email',
	3 => 'ic_no',
	4 => 'mobile_no',
	5 => 'gender',
	6 => 'date_enrolled',
);

// if(isset($_POST['search']['value']))
// {
// 	$search_value = $_POST['search']['value'];
// 	$sql .= " AND (us.u_fullname like '%".$search_value."%'";
// 	$sql .= " OR us.u_email like '%".$search_value."%'";
// 	$sql .= " OR us.u_mobileNo like '%".$search_value."%'";
// 	$sql .= " OR tc.ic_no like '%".$search_value."%'";
// 	$sql .= " OR tc.gender like '%".$search_value."%'";
// 	$sql .= " OR us.u_createdAt like '%".$search_value."%')";
// }

// if(isset($_POST['order']))
// {
// 	$column_name = $_POST['order'][0]['column'];
// 	$order = $_POST['order'][0]['dir'];
// 	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
// }
// else
// {
// 	$sql .= " ORDER BY id desc";
// }




// if($_POST['length'] != -1)
// {
// 	$start = $_POST['start'];
// 	$length = $_POST['length'];
// 	$sql .= " LIMIT  ".$start.", ".$length;
// }


$query = mysqli_query($GLOBALS['conn'], $sql);


$count_rows = mysqli_num_rows($query);
$data = array();
$num = 1;

while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $num;
	$sub_array[] = $row['u_fullname'];
	$sub_array[] = $row['u_email'];
	$sub_array[] = $row['ic_no'];
	$sub_array[] = $row['u_mobileNo'];
	$sub_array[] = $row['gender'];
	$sub_array[] = date('d F Y',strtotime($topic != "all" ? $row['dateEnrolled'] : $row['u_createdAt']));
	// $sub_array[] = '<a href="#!"  data-id="'.$row['id'].'"  class="btn btn-info btn-sm editBtn " >&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
	//                 <a href="#!"  data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';

	$data[] = $sub_array;
    $num++;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);

echo json_encode($output);

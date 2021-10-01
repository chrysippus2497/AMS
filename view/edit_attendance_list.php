<?php 

require_once('../Functions.php');
	if(isset($_POST['updatebtn'])) {

	$id 		= $_POST['update_id'];
	$course 	= $_POST['course'];
	$year_level = $_POST['year_level'];
	$section 	= $_POST['section'];
    $date_time 	= $_POST['date_time'];
    $course 	= $_POST['course'];

    $sql = new mysqli("localhost", "root", "", "attendance-monitoring-system");
    $query = "UPDATE attendance SET course = '$course', year_level = '$year_level', section = '$section', date_time = '$date_time' WHERE id='$id'";
	$query_run = mysqli_query($sql,$query);

	if($query_run) {
		header("Location: ./attendance.php?edit=success");
	}
	else {
		header("Location: ./attendance.php?update=error");
	}
}

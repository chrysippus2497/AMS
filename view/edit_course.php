<?php 

require_once('../Functions.php');
	if(isset($_POST['updatebtn'])) {

	$id 		= $_POST['update_id'];
	$course 	= $_POST['course'];
	$code 		= $_POST['code'];

    $sql = new mysqli("localhost", "root", "", "attendance-monitoring-system");
    $query = "UPDATE courses SET course = '$course', code = '$code' WHERE id='$id'";
	$query_run = mysqli_query($sql,$query);

	if($query_run) {
		header("Location: ./courses.php?edit=success");
	}
	else {
		header("Location: ./courses.php?update=error");
	}
}

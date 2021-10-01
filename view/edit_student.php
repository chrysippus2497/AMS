<?php 

require_once('../Functions.php');
	if(isset($_POST['updatebtn'])) {

	$id 		= $_POST['update_id'];
	$firstname 	= $_POST['firstname'];
	$lastname 	= $_POST['lastname'];
    $course 	= $_POST['course'];
    $year_level = $_POST['year_level'];
    $section    = $_POST['section'];

    $sql = new mysqli("localhost", "root", "", "attendance-monitoring-system");
    $query = "UPDATE students SET firstname = '$firstname', lastname = '$lastname', course = '$course', year_level = '$year_level', section = '$section' WHERE id='$id'";
	$query_run = mysqli_query($sql,$query);

	if($query_run) {
		header("Location: ./students.php?edit=success");
	}
	else {
		header("Location: ./students.php?update=error");
	}
}

<?php 

require_once('../Functions.php');
	if(isset($_POST['updatebtn'])) {

	$id 				= $_POST['update_id'];
	$section 			= $_POST['section'];
	$description 		= $_POST['description'];

    $sql = new mysqli("localhost", "root", "", "attendance-monitoring-system");
    $query = "UPDATE sections SET section = '$section', description = '$description' WHERE id='$id'";
	$query_run = mysqli_query($sql,$query);

	if($query_run) {
		header("Location: ./sections.php?edit=success");
	}
	else {
		header("Location: ./sections.php?update=error");
	}
}

<?php 

$mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
	
if(isset($_POST['deletebtn']))
{
	$id = $_POST['delete_id'];

	$message = "";

	$query = "DELETE FROM students WHERE id ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{

		header('location: ./students.php?delete=success');
	}
	else
	{

		header('location: ./students.php?delete=error');
	}
}

?>
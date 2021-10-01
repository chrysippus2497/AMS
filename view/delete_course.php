<?php 

$mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
	
if(isset($_POST['deletebtn']))
{
	$id = $_POST['delete_id'];

	$message = "";

	$query = "DELETE FROM courses WHERE id ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{

		header('location: ./courses.php?delete=success');
	}
	else
	{

		header('location: ./courses.php?delete=error');
	}
}

?>
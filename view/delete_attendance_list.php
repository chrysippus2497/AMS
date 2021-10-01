<?php 

$mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
	
if(isset($_POST['deletebtn']))
{
	$id = $_POST['delete_id'];

	$message = "";

	$query = "DELETE FROM attendance WHERE id ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{

		header('location: ./attendance.php?delete=success');
	}
	else
	{

		header('location: ./attendance.php?delete=error');
	}
}

?>
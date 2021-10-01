<?php 

$mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
	
if(isset($_POST['deletebtn']))
{
	$id = $_POST['delete_id'];

	$message = "";

	$query = "DELETE FROM sections WHERE id ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{

		header('location: ./sections.php?delete=success');
	}
	else
	{

		header('location: ./sections.php?delete=error');
	}
}

?>
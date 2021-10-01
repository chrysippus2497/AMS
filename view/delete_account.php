<?php 


	$conn = new mysqli("localhost","root","","attendance-monitoring-system");
	
	$delete_account_password = "";
	if(isset($_POST['delete_account_btn']))
	{

	$id = $_SESSION['id'];

	$delete_account_password = $_POST['delete_account_password'];
	$message = "";


	if(empty($delete_account_password))
	{
		header("location: ./settings.php?delete=error");
	}

	$sql = "SELECT * FROM users WHERE id='$id'";
	$stmt = mysqli_stmt_init($conn);
    $query_delete = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query_delete);

    if(!$query_delete){
           die("SQL query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($query_delete);
    $pwdCheck = password_verify($delete_account_password, $row['password']);
                    if ($pwdCheck == false) {

                    	header("location: ./settings.php?delete=wrongpwd");
                     
                    }
                    else if ($pwdCheck == true){
                    	$query = "DELETE FROM users WHERE id ='$id'";
						$query_run = mysqli_query($conn,$query);


						if($query_run)
						{
							session_start();
							setcookie(session_name(), '', 100);
							session_unset();
							session_destroy();
							$_SESSION = array();

							header('location: ../login.php?delete=success');
						}
						else
						{

							header('location: ./settings.php?delete=error');
						}

                    }



}

?>
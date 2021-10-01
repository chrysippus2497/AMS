<?php 
	
	require_once('../Functions.php');
	// database connection
	$conn = new mysqli("localhost", "root", "", "attendance-monitoring-system");

	$course 	= "";
	$code 	= "";


	$invalid_credentials = false;
    $uid = $_SESSION['id'];
	if(isset($_POST['add_btn'])){
        // Set cedentials

        $course          = $_POST['course'];
        $code            = $_POST['code'];

        // default value every post request/login button click event
        $invalid_credentials = false;

        // Check if credentials is empty
        if (empty($course) || empty($code))
        {
            // apply CSS style if firstname is empty
            if (empty($course))
                $invalid_course = 'is-invalid';

            // apply CSS style if lastname is empty
            if (empty($code))
                $invalid_code = 'is-invalid';


        }
            
        // executes if credentials is valid (not empty
           
    
            else 
            {
                // Call the register method to register new student
                if (register_course($uid, $course, $code))
                    header("Location: ./courses.php?registered=true");
                
                // Set invalid credentials to true if student already exists.
                else
                {
                    header("Location: ./courses.php?registered=false");
                    $invalid_credentials = true;
                }
            }
        }     

    ?>

<?php 
	
	require_once('../Functions.php');
	// database connection
	$conn = new mysqli("localhost", "root", "", "attendance-monitoring-system");

	$course 	= "";
	$code 	= "";


	$invalid_credentials = false;

    $section ="";
    $description = "";
    $uid = $_SESSION['id'];
	if(isset($_POST['add_btn'])){
        // Set cedentials

        $section          = $_POST['section'];
        $description      = $_POST['description'];

        // default value every post request/login button click event
        $invalid_credentials = false;

        // Check if credentials is empty
        if (empty($section))
        {
            
            if (empty($section))
                $invalid_section = 'is-invalid';

    



        }
            
        // executes if credentials is valid (not empty
           
    
            else 
            {
                // Call the register method to register new student
                if (register_section($uid, $section, $description))
                    header("Location: ./sections.php?registered=true");
                
                // Set invalid credentials to true if student already exists.
                else
                {
                    header("Location: ./sections.php?registered=false");
                    $invalid_credentials = true;
                }
            }
        }     

    ?>

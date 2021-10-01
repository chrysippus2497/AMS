<?php 
	
	require_once('../Functions.php');
	// database connection
	$conn = new mysqli("localhost", "root", "", "attendance-monitoring-system");
	$firstname 	= "";
	$lastname 	= "";
	$course 	= "";
	$year_level = "";

	$invalid_credentials = false;

	if(isset($_POST['btn_add_student'])){
        // Set cedentials

        $uid             = $_SESSION['id'];
        $firstname       = $_POST['firstname'];
        $lastname        = $_POST['lastname'];
        $course          = $_POST['course'];
        $section         = $_POST['section'];
        $year_level      = $_POST['year_level'];

        // default value every post request/login button click event
        $invalid_credentials = false;

        // Check if credentials is empty
        if (empty($firstname) || empty($lastname) || empty($course) || empty($section) || empty($year_level) )
        {
            // apply CSS style if firstname is empty
            if (empty($firstname))
                $invalid_firstname = 'is-invalid';

            // apply CSS style if lastname is empty
            if (empty($lastname))
                $invalid_lastname = 'is-invalid';

            if (empty($course))
                $invalid_course = 'is-invalid';

            if (empty($section))
                $invalid_section = 'is-invalid';

            // apply CSS style if year_level is empty
            if (empty($year_level))
                $invalid_year_level = 'is-invalid';

        }
            
        // executes if credentials is valid (not empty
           
    
            else 
            {
                // Call the register method to register new student
                if (register_student($uid, $firstname, $lastname, $course, $section, $year_level))
                    header("Location: ./students.php?registered=true");
                
                // Set invalid credentials to true if student already exists.
                else
                {
                    header("Location: ./students.php?registered=false");
                    $invalid_credentials = true;
                }
            }
        }     

    ?>

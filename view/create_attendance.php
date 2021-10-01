<?php 

	//create connection to database

	$servername = "localhost";
    $username = "root";
    $password = "";
    $database = "attendance-monitoring-system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $date 		= "";
    $course		= "";
    $year_level = "";
    $section = "";

    // For validation of credentials
        $invalid_credentials = false;

        $uid = $_SESSION['id'];
    if(isset($_POST['create_attendance_btn'])) {

    	$date 		= $_POST['date'];
    	$course 	= $_POST['course'];
    	$year_level = $_POST['year_level'];
        $section    = $_POST['section'];
    	$created_by = $_SESSION['username'];
    	$invalid_credentials = false;


    	 if (empty($date) || empty($course) || empty($year_level) || empty($section))
    	 {
            // apply CSS style if date is empty
            if (empty($date))
                $invalid_date = 'is-invalid';

            // apply CSS style if course is empty
            if (empty($course))
                $invalid_course = 'is-invalid';

            if (empty($section))
                $invalid_section = 'is-invalid';

            // apply CSS style if year_level is empty
            if (empty($year_level))
                $invalid_year_level = 'is-invalid';

         }
         else 
            {
                // Call the register method to register new user
                if (create_attendance($uid, $created_by, $course, $year_level, $section, $date))
                    if(attendance($uid, $created_by, $course, $year_level, $section, $date))
                    header("Location: ./attendance.php?create_attendance=success");
                
                // Set invalid credentials to true if username already exists.
                else
                {
                	header("Location: ./attendance.php?create_attendance=error");
                    $invalid_username = 'is-invalid';
                    $invalid_credentials = true;
                }
            }
    }



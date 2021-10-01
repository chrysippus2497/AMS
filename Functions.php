<?php

session_start();

// Checks if user is logged in. Return true if logged in and false otherwise.
function is_user_logged_in()
{
    if (isset($_SESSION['username']))
        return true;

    return false;
}

// Login user function
function login_user($username, $password)
{   
        // open database connection
    $conn = connect_to_database();

    $sql = "SELECT * From users WHERE username = '{$username}' ";
    $stmt = mysqli_stmt_init($conn);
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);

    if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
    }
    if($rowCount <= 0) {
                $accountNotExistErr = '<div class="alert alert-danger">
                        User account does not exist.
                    </div>';
   } 
    else {
        if ($row = mysqli_fetch_array($query)) {
                    // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
                    $pwdCheck = password_verify($password, $row['password']);
                    // If they don't match then we create an error message!
                    if ($pwdCheck == false) {
                      // If there is an error we send the user back to the signup page.
                      $wrongPwdErr = '<div class="alert alert-danger">
                        Wrong password.
                    </div>';
                    }
                    // Then if they DO match, then we know it is the correct user that is trying to log in!
                    else if ($pwdCheck == true) {

                      // Next we need to create session variables based on the users information from the database. If these session variables exist, then the website will know that the user is logged in.

                      // Now that we have the database data, we need to store them in session variables which are a type of variables that we can use on all pages that has a session running in it.
                      // This means we NEED to start a session HERE to be able to create the variables!
                      session_start();
                      // And NOW we create the session variables.
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['firstname'] = $row['firstname'];
                      $_SESSION['lastname'] = $row['lastname'];
                      $_SESSION['username'] = $row['username'];
                      return true;
                      // Now the user is registered as logged in and we can now take them back to the front page! :)
                      header("Location: ./dashboard.php?");
                      exit();
                    }
                  }
                }


    close_connection($conn);
    // return false if incorrect username or password
    return false;
}

function register_user($firstname, $lastname, $username, $password)
{
    // open database connection
    $conn = connect_to_database();

    // Check if username already exists.
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // return false if username already exists
    if ($result->num_rows > 0) 
        return false;
    
    // Insert username to the database
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (firstname, lastname, username, password)
    VALUES ('$firstname', '$lastname', '$username', '$password_hash')";
    
    // return true if user has successfully inserted to the database
    if ($conn->query($sql) === TRUE) {
      return true;
    }
    
    // return false if cannot insert user.
    return false;
}

function register_student($uid, $firstname, $lastname, $course, $section, $year_level)
{
    // open database connection
    $conn = connect_to_database();

    // Check if username already exists.
    $sql = "SELECT * FROM students WHERE firstname='$firstname' AND lastname='$lastname' AND course='$course' AND section='$section' AND uid='$uid'";
    $result = $conn->query($sql);

    // return false if username already exists
    if ($result->num_rows > 0) 
        return false;
    
    // Insert username to the database
    $sql = "INSERT INTO students (uid, firstname, lastname, course, section, year_level)
    VALUES ('$uid', '$firstname', '$lastname', '$course', '$section', '$year_level')";
    
    // return true if user has successfully inserted to the database
    if ($conn->query($sql) === TRUE) {
      return true;
    }
    
    // return false if cannot insert user.
    return false;
}

function update_password($old_password, $new_password)
{   
        // open database connection
    $conn = connect_to_database();

    
    $sql = "SELECT * From users WHERE id = '{$_SESSION['id']}' ";
    $stmt = mysqli_stmt_init($conn);
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);

     if($rowCount <= 0) {
                return false;
   } 
    else {
        if ($row = mysqli_fetch_array($query)) {
                    // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
                    $pwdCheck = password_verify($old_password, $row['password']);
                    // If they don't match then we create an error message!
                    if ($pwdCheck == false) {
                      // If there is an error we send the user back to the signup page.
                     return false;
                    }
                    // Then if they DO match, then we know it is the correct user that is trying to log in!
                    else if ($pwdCheck == true) {

                      $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
                        $update_password_query = "UPDATE users SET password = '$new_password_hash'";
                        $query_run = mysqli_query($conn,$update_password_query);

                        if($query_run) {
                            header("Location: ./settings.php?change_password=true");
                        }
                        else {
                            header("Location: ./settings.php?change_password=false");
                        }
                     
                    }
                  }
                }

    
    return false;
    close_connection($conn);
    // return false if incorrect username or password
    
}

function create_attendance($uid, $created_by, $course, $year_level, $section, $date)
{
    // open database connection
    $conn = connect_to_database();
    
    $sql = "SELECT * From attendance WHERE uid = '{$uid}' ";
    $stmt = mysqli_stmt_init($conn);
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);

    if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
    }
    if($rowCount > 0) {
                
                $row = mysqli_fetch_array($query);
                    // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
                if($row['course'] == $course && $row['year_level'] == $year_level && $row['section'] == $section && $row['date_time'] == $date)
                    return false;
                }

                    $create_attendance_sql = "INSERT INTO attendance (uid, course, year_level, section, date_time)
                    VALUES ('$uid', '$course', '$year_level', '$section','$date')";
                    
                    if(!$query){
                           die("SQL query failed: " . mysqli_error($conn));
                    }
                       
                                   
                    if ($conn->query($create_attendance_sql) === TRUE) {

                         
                        header("localtion: ./attendance.php?create_attendance=success");
                             // return true if user has successfully inserted to the database
                            return true;
                            
                    }
                    else {
                        header("localtion: ./attendance.php?create_attendance=error");
                    }

    
    // return false if cannot insert user.
    return false;
}


function attendance($uid, $created_by, $course, $year_level, $section, $date)
{   
   $conn = connect_to_database();
   $sql = "INSERT INTO student_attendance(created_by, firstname, lastname, course, year_level, section, date_time)
      SELECT 
         '$uid', firstname, lastname, course, year_level, section, '$date' 
      FROM 
         students
      WHERE
         course = '{$course}' AND year_level = '{$year_level}' AND section = '{$section}'";

         

        if ($conn->query($sql) === TRUE) {

                         
                        header("localtion: ./attendance.php?create_attendance=success");
                             // return true if user has successfully inserted to the database
                            return true;
                            
                }
                else {
                        header("localtion: ./attendance.php?create_attendance=error");
                    }
     return false;
       
}

// add_course
function register_course($uid, $course, $code)
{
    // open database connection
    $conn = connect_to_database();

    // Check if username already exists.
    $sql = "SELECT * FROM courses WHERE uid='$uid' AND course='$course'";
    $result = $conn->query($sql);

    // return false if username already exists
    if ($result->num_rows > 0) 
        return false;
    
    // Insert username to the database
    $sql = "INSERT INTO courses (uid, course, code)
    VALUES ('$uid', '$course', '$code')";
    
    // return true if user has successfully inserted to the database
    if ($conn->query($sql) === TRUE) {
      return true;
    }
    
    // return false if cannot insert user.
    return false;
}

//add section
function register_section($uid, $section, $description)
{
    // open database connection
    $conn = connect_to_database();

    // Check if username already exists.
    $sql = "SELECT * FROM sections WHERE uid='$uid' AND section='$section'";
    $result = $conn->query($sql);

    // return false if username already exists
    if ($result->num_rows > 0) 
        return false;
    
    // Insert username to the database
    $sql = "INSERT INTO sections (uid, section, description)
    VALUES ('$uid', '$section', '$description')";
    
    // return true if user has successfully inserted to the database
    if ($conn->query($sql) === TRUE) {
      return true;
    }
    
    // return false if cannot insert user.
    return false;
}



// Open database connection
function connect_to_database()
{
    // Database credentials
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

    return $conn;
}

// Close database connection
function close_connection($conn)
{
    $conn->close();
}

?>
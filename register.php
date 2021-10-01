  
<?php require_once('template/header.php'); ?>

<?php

    // Optional: For Successful registration notification only (CSS)
    $registered = false;
    if (isset($_GET['registered']))
        $registered = $_GET['registered'];

    // For CSS use only
    $invalid_username        = "";
    $invalid_password        = "";
    $invalid_retype_password = "";

    // For validation of credentials
    $invalid_credentials = false;

    // Credentials value: By default set to empty string
    $firstname       = "";
    $lastname        = "";
    $username        = "";
    $password        = "";
    $retype_password = "";

    /*
     *  Checks if the request is POST request 
     *  triggered when you login button
     */

   
    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {

        $mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
        // Set cedentials
        $firstname       = $mysqli -> real_escape_string($_POST['firstname']);
        $lastname        = $mysqli -> real_escape_string($_POST['lastname']);
        $username        = $mysqli -> real_escape_string($_POST['username']);
        $password        = $_POST['password'];
        $retype_password = $_POST['retype_password'];

        // default value every post request/login button click event
        $invalid_credentials = false;

        // Check if  all fields are empty
        if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($retype_password))
        {
            // apply CSS style if firstname is empty
            if (empty($firstname))
                $invalid_firstname = 'is-invalid';

            // apply CSS style if lastname is empty
            if (empty($lastname)) 
                $invalid_lastname = 'is-invalid';

            // apply CSS style if username is empty
            if (empty($username))
                $invalid_username = 'is-invalid';

            // apply CSS style if password is empty
            if (empty($password))
                $invalid_password = 'is-invalid';

            
            // apply CSS style if retype password is empty
            if (empty($retype_password))
                $invalid_retype_password = 'is-invalid';

        }

        else if(!preg_match("/^[a-zA-Z ]*$/", $firstname)) 
            $invalid_firstname = 'is-invalid';
        
        else if(!preg_match("/^[a-zA-Z ]*$/", $lastname)) 
            $invalid_lastname = 'is-invalid';
        
        else if(!preg_match("/^[a-zA-Z ]*$/", $username))
            $invalid_username = 'is-invalid';
        
            
        // executes if username and password is valid (not empty)
        else 
        {
            // Check if password and retype password did not match
            if ($password !== $retype_password)
                $invalid_retype_password = 'is-invalid';
    
            else 
            {
                // Call the register method to register new user
                if (register_user($firstname, $lastname, $username, $password))
                    header("Location: register.php?registered=true");
                
                // Set invalid credentials to true if username already exists.
                else
                {
                    $invalid_username = 'is-invalid';
                    $invalid_credentials = true;
                }
            }
                
        }
    }

?>
<style>
    
    body {
    font-family: 'Comfortaa', cursive;
    background-image: url("pictures/bg.png");
    background-repeat: no-repeat;
    background-size: cover;
    align-items: center;
    justify-content: center;    
    min-height: 100vh;
    margin: 0;

    }

</style>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-6 col-lg-5 " >
            <!-- Optional: For successful registration notification only, For CSS styles only -->
            <?php if ($registered): ?>
                <br>
                <br>
                <br>
                <br>
                <div class="alert alert-primary" role="alert">
                    <h4 class="text-center">Successfuly registered</h4>
                </div>

                <div class="d-flex justify-content-center my-5">
                    <a href="login.php" class="btn btn-primary px-5">Login</a>
                </div>
            <?php endif; ?>

            <?php if (!$registered): ?>
                <br>
                <br>
                <form 
                    class="p-3 border bg-white reg"
                    method="post" 
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <h4 class="text-center py-3">Register Form</h4>
                    <div class="fontuserreg">
                        <input 
                            class="form-control <?php echo $invalid_firstname; ?>"
                            type="text" 
                            value="<?php echo $firstname; ?>"
                            placeholder="Firstname"
                            name="firstname">
                            <!-- <i class="fa fa-user fa-lg"></i> -->

                        <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Please enter a valid firstname, only letters and white space allowed.
                            </div>
                            <br>
                        <?php endif; ?>

                      
                    
                    </div>
                    <div class="fontuserreg">
                        <input 
                            class="form-control <?php echo $invalid_lastname; ?>"
                            type="text" 
                            value="<?php echo $lastname; ?>"
                            placeholder="Lastname"
                            name="lastname">
                            <!-- <i class="fa fa-user fa-lg"></i> -->

                        <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Please enter a valid lastname, only letters and white space allowed.
                            </div>
                            <br>
                        <?php endif; ?>

                    </div>
                    <div class="fontuserreg">
                        <input 
                            class="form-control <?php echo $invalid_username; ?>"
                            type="text" 
                            value="<?php echo $username; ?>"
                            placeholder="Username"
                            name="username">
                            <!-- <i class="fa fa-user fa-lg"></i> -->

                        <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                               Please enter a valid username, only letters and white space allowed.
                            </div>
                            <br>
                        <?php endif; ?>

                         <!-- Validation error form backend -->
                        <?php if ($invalid_credentials): ?>
                        <p class="text-danger">
                            <small>Username already exists.</small>
                        </p>
                        <?php endif; ?>
                    </div>

                    <div class="fontpasswordreg">
                        <input 
                            class="form-control <?php echo $invalid_password; ?>"
                            type="password"
                            value="<?php echo $password; ?>"
                            placeholder="Password"
                            name="password">
                            <!-- <i class="fa fa-key fa-lg"></i> -->

                        <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Please enter a password.
                            </div>
                            <br>
                        <?php endif; ?>
                    </div>

                    <div class="fontpasswordreg">
                        <input 
                            class="form-control <?php echo $invalid_retype_password; ?>"
                            type="password"
                            value="<?php echo $retype_password; ?>"
                            placeholder="Confirm Password"
                            name="retype_password">
                            <!-- <i class="fa fa-key fa-lg"></i> -->

                        <!-- For CSS styles only -->
                        <?php if (!$invalid_credentials): ?>
                            <div class="invalid-feedback">
                                Two password did not match.
                            </div>
                            <br>
                        <?php endif; ?>
                    </div>

                
                    

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="my-4 btn btn-success px-5">Register</button>
                    </div>

                    <p class="text-center"> 
                    Already have an account? 
                        <a  href="login.php"> Login here</a>
                    </p>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once('template/footer.php'); ?>
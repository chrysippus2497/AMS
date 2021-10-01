<?php require_once('template/header.php'); ?>
<?php
    // Checks if user is logged in
    if (is_user_logged_in())
        header('Location: view/dashboard.php');   

?>

<?php
    $mysqli = new mysqli("localhost","root","","attendance-monitoring-system");
    // For CSS use only
    $invalid_username = "";
    $invalid_password = "";

    // For validation of credentials
    $invalid_credentials = false;

    // Credentials value: By default set to empty string
    $username = "";
    $password = "";

    /*
     *  Checks if the request is POST request 
     *  triggered when you login button
     */
    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        // Set username and password
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        // default value every post request/login button click event
        $invalid_credentials = false;

        // Check if either username or password are empty
        if (empty($username) || empty($password))
        {
            // apply CSS style if username is empty
            if (empty($username))
                $invalid_username = 'is-invalid';

            // apply CSS style if password is empty
            if (empty($password))
                $invalid_password = 'is-invalid';
        }
            
        // executes if username and password is valid (not empty)
        else 
        {
            // Call the login method and redirect the user to home page if credentials are correct
            if (login_user($username, $password))
                header("Location: view/dashboard.php");
                
            // Set invalid credentials to true if username and password is incorrect.
            else
            {
                $invalid_username = 'is-invalid';
                $invalid_password = 'is-invalid';

                $invalid_credentials = true;
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
<br><br>

<?php   
         $delete_account ="";
         if(isset($_GET["delete"]))
              {
                if($_GET["delete"] == "success")
                {
                  $delete_account = '<div class="alert alert-success" style="animation: fadeOut 2s forwards;
    animation-delay: 5s;"><center>Account has been deleted.</center></div>';
                }

              }
      ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-6 col-lg-5 " >
            <?php echo $delete_account?>
            <form class="p-3 border bg-white login" 
                method="post" 
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <center>
                <h5>Attendance Monitoring System</h5>
                <br>
                </center>

                <div class="fontuser">
                
                    <input 
                        class="form-control <?php echo $invalid_username; ?>"
                        type="text" 
                        value="<?php echo $username; ?>"
                        placeholder="Username"
                        name="username">
                        <i class="fa fa-user fa-lg"></i>


                    <!-- For CSS styles only -->
                    <?php if (!$invalid_credentials): ?>
                        <div class="invalid-feedback">
                            Please enter a username.
                        </div>
                        <br>
                    <?php endif; ?>
                </div>

                <div class="fontpassword">
                    <input 
                        class="form-control <?php echo $invalid_password; ?>"
                        type="password"
                        value="<?php echo $password; ?>"
                        placeholder="Password"
                        name="password">
                        <i class="fa fa-key fa-lg"></i>

                    <!-- For CSS styles only -->
                    <?php if (!$invalid_credentials): ?>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                        <br>
                    <?php endif; ?>
                    </div>

                <!-- Validation error form backend -->
                <?php if ($invalid_credentials): ?>
                    <p class="text-center text-danger">
                        <small>Invalid username or password</small>
                    </p>
                <?php endif; ?>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="my-4 btn btn-primary px-5">Login</button>
                </div>

                <p class="text-center"> Don't have an account? 
                    <a  href="register.php"> Register here</a>
                </p>
            </form>
        </div>
    </div>

<?php require_once('template/footer.php'); ?>

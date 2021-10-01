<?php require_once('template/header.php'); ?>

<?php
    // Checks if user is logged in
    if (is_user_logged_in())
        header('Location: view/dashboard.php');
     else 
     	header('location: login.php');
      
?>

<?php require_once('template/footer.php'); ?>
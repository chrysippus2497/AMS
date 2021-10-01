<?php

require_once('../Functions.php');

if (is_user_logged_in())
    header('Location: ./dashboard.php');

else
    header('Location: ../login.php');

?>
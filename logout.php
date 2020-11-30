<!---------------LOGOUT PAGE USE TO DESTROY ALL THE SESSION ------------------>
<?php

session_start();
if(session_destroy()) {
unset($_SESSION['username']);
unset($_SESSION['usertype']);
unset($_SESSION['userdata']);
header("location: index.php");
}
?>

<?php
if (!isset($_SESSION)) {
    session_start();
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
</head>

<body>

    <!-------------------------Sticky NavBar--------------------------->
    <nav class="navbar navbar-expand-lg sticky-top navbar-light nav-bg">
        <img class="navbar-brand" src="Screenshot.png" width="15%">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
           
            <?php
/*------------List to show when the user is login ---------------*/
if (isset($_SESSION['username'])) {
    if ($_SESSION['usertype'] == '1') {
?>    
<li class="nav-item">
<a class="nav-link">Hello,<?php echo $_SESSION['userid'] ?></a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="index.php">Book New Ride</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userDashboard.php">DashBoard</a>
    </li>
                <div>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Rides</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="checkStatus.php?status=1">Pending Rides</a>
    <a class="dropdown-item" href="checkStatus.php?status=2">Completed Rides</a>
    <a class="dropdown-item" href="checkStatus.php?status=0">Cancelled Rides</a>
    <a class="dropdown-item" href="checkStatus.php?status=3">All Rides</a>
  </div>
    </div>

        <div>
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Account Setting
  </button>
    <div class="dropdown-menu" aria-labelledby="dropdownButton">
    <a class="dropdown-item" href="userSettings.php">Update Information</a>
    <a class="dropdown-item" href="changepassword.php">Change Password</a>
     </div>
    </div>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
               
                
            <?php
        ;
    } else {
        header("location:adminfiles/adminpanel.php");
    }
} 
/*------------List to show when the User is Not logged In ---------------*/
else {
?>
                        <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
               <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Contact Us</a>
                        </li>
            <?php
    ;
}
?>

           </ul>
        </div>
    </nav>
  
<?php
if (!isset($_SESSION)) {
    session_start();
    
}

if (!isset($_SESSION['username'])) {
    header('location:../unauthorisedUser.php');
} else if ($_SESSION['usertype'] == '1') {
    header("../userpanel.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Custom styles for this template-->

</head>

<body id="page-top">
<a href="adminpanel.php" class="link">Back To DashBoard</a>
<?php
$pickup      = $_GET['pickup'];
$drop        = $_GET['drop'];
$date        = $_GET['date'];
$cabtype     = $_GET['cabtype'];
$distance    = $_GET['distance'];
$fare        = $_GET['fare'];
$customereid = $_GET['customer'];
$weight      = $_GET['weight'];
?>

<div class="row">
<div class="col-md-2 col-lg-2"></div>
<div class="col-md-8 col-lg-8">
<div class="row panel panel-default">
<div class="text-center panel-heading"><h1>Invoice</h1></div>
<div class="panel-body">
<div class="col-md-6 col-lg-6">
<h3>Date:</h3>
<h3>Customer Id<h3>
<h3>From:</h3>
<h3>To:</h3>
<h3>Total Distance: </h3>
<h3>Cab Type:</h3>
<h3>Luggage:</h3>
</div>
<div class="col-md-6 col-lg-6">
<h3><?php
echo $date;
?></h3>
<h3><?php
echo $customereid;
?></h3>
<h3><?php
echo $pickup;
?></h3>
<h3><?php
echo $drop;
?></h3>
<h3><?php
echo $distance;
?></h3>
<h3><?php
echo $cabtype;
?></h3>
<h3><?php
echo $weight;
?></h3>
</div>
</div>
<div class="panel-footer text-center">
<h2>Total Fare: <?php
echo $fare;
?></h2>
</div>
</div>
</div>
<div class="col-md-2 col-lg-2"></div>
</div>
</div>
</div>


</body>
</html>
<?php
/*------If User Session is Not Created header will take the user out--------------*/
if (!isset($_SESSION))
{
    session_start();

}

if (!isset($_SESSION['username']))
{
    header('location:index.php');
}
else if ($_SESSION['usertype'] == '0')
{
    header("adminfiles/adminpanel.php");
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
<a href="userDashboard.php" class="userinvo">BACK TO DASHBOARD</a>
<p>
<a onclick="window.print();" class="userinvo">PRINT</a>
</p>
<?php
$pickup      = $_GET['pickup'];
$drop        = $_GET['drop'];
$date        = $_GET['date'];
$cabtype     = $_GET['cabtype'];
$distance    = $_GET['distance'];
$fare        = $_GET['fare'];
$customereid = $_GET['name'];
$weight      = $_GET['weight'];
?>

<div id="usertable">
    <h1>RIDE INVOICE</h1>
<table >
        <tr><td><h3>Date:</h3></td><td><h3><?php echo $date; ?></h3></td></tr>
        <tr><td><h3>Name:</h3></td><td><h3><?php echo $customereid; ?></h3></td></tr>
        <tr><td><h3>From:</h3></td><td><h3><?php echo $pickup; ?></h3></td></tr>
        <tr><td><h3>To:</h3></td><td><h3><?php echo $drop; ?></h3></td></tr>
        <tr><td><h3>Total Distance:</h3></td><td><h3><?php echo $distance; ?></h3></td></tr>
        <tr><td><h3>Cab Type:</h3></td><td><h3><?php echo $cabtype; ?></h3></td></tr>
        <tr><td><h3>Luggage:</h3></td><td><h3><?php echo $weight; ?></h3></td></tr>
</table>


<h2>Total Fare: <?php echo $fare; ?></h2>
</div>


</body>
</html>
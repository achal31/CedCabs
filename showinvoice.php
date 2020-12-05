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
include('header.php');
?>

<div id="page-top">
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
<p>
<a onclick="window.print();" class="userinvo">PRINT</a>
</p>
<div id="usertable">
    <h1>RIDE INVOICE</h1>
<table id="userinvoicetable">
        <tr><td class="invotable"><h4>DATE OF RIDE</h4></td><td class="invotable"><h4><?php echo $date; ?></h4></td></tr>
        <tr><td class="invotable"><h4>NAME</h4></td><td class="invotable"><h4><?php echo $customereid; ?></h4></td></tr>
        <tr><td class="invotable"><h4>PICKUP POINT</h4></td><td class="invotable"><h4><?php echo $pickup; ?></h4></td></tr>
        <tr><td class="invotable"><h4>DROP POINT</h4></td><td class="invotable"><h4><?php echo $drop; ?></h4></td></tr>
        <tr><td class="invotable"><h4>TOTAL DISTANCE</h4></td><td class="invotable"><h4><?php echo $distance; ?> KM</h4></td></tr>
        <tr><td class="invotable"><h4>CAB TYPE</h4></td><td class="invotable"><h4><?php echo $cabtype; ?></h4></td></tr>
        <tr><td class="invotable"><h4>LUGGAGE WEIGHT</h4></td><td class="invotable"><h4><?php echo $weight; ?> KG</h4></td></tr>
        <tr><td class="invotable"colspan="2"><h2>TOTAL FARE: ₹<?php  echo $fare; ?></h2></td></tr>
</table>


</div>

</div>
<?php 
include('footer.php');
?>
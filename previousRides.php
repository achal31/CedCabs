<?php include('headeruser.php');
session_start();
?>

<div id="previousridewrapper">
<form action="previousRides.php" method="post">
        <input type="submit" value="MONTH" name="filter">
        <input type="submit" value="DATE" name="filter">
        <input type="submit" value="FARE" name="filter">
        <input type="submit" value="DISTANCE" name="filter">
</form>
<h2>Previous Rides</h2>
</div>

<?php

include_once('user.php');
if(isset($_POST['filter']))
{
$previousrides=new user();
$sql=$previousrides->rideDetail($_SESSION['username'],$_POST['filter']);
}
else{
    $previousrides=new user();
$sql=$previousrides->rideDetail($_SESSION['username'],"");
}
$i=0;
$total=0;
$html="";
$html.="<table>";
$html.="<tr>";
$html.="<th>S.No</th>";
$html.="<th>Ride Date</th>";
$html.="<th>Pick Up</th>";
$html.="<th>Drop</th>";
$html.="<th>Total Distance</th>";
$html.="<th>Luguage</th>";
$html.="<th>Total Fare</th>";
$html.="</tr>";
foreach($sql as $result)
{
    $html.="<tr>"; 
    $html.="<td>$i</td>";
    $html.="<td>$result[ride_date]</td>";
    $html.="<td>$result[tripstart]</td>";
    $html.="<td>$result[tripend]</td>";
    $html.="<td>$result[total_distance]</td>";
    $html.="<td>$result[luggage]</td>";
    $html.="<td>$result[total_fare]</td>";
    $total=$total+(int)$result['total_fare'];
    $html.="</tr>";
    $i++;
}
$html.="<tr><td colspan='6'><td>Total Spending : $total</td></tr>";
$html.="</table>";
echo $html;
?>
<?php
session_start();
include ("headeruser.php");
?>
<h1>CHECK STATUS</h1>;
<?php
include_once ('user.php');
// Object creation
$userdata = new user();
$sql = $userdata->getStatus($_SESSION['username']);
$i = 1;
$html = "";
$html .= "<table>";
$html .= "<tr>";
$html .= "<th>S.No</th>";
$html .= "<th>Ride Date</th>";
$html .= "<th>Pick Up</th>";
$html .= "<th>Drop</th>";
$html .= "<th>Total Distance</th>";
$html .= "<th>Luguage</th>";
$html .= "<th>Total Fare</th>";
$html .= "<th>Status</th>";
$html .= "</tr>";
foreach ($sql as $result)
{
    $html .= "<tr>";
    $html .= "<td>$i</td>";
    $html .= "<td>$result[ride_date]</td>";
    $html .= "<td>$result[tripstart]</td>";
    $html .= "<td>$result[tripend]</td>";
    $html .= "<td>$result[total_distance]</td>";
    $html .= "<td>$result[luggage]</td>";
    $html .= "<td>$result[total_fare]</td>";
    if ($result['status'] == 0)
    {
    $html .= "<td>Cancelled</td>";
    }
    else if ($result['status'] == 1)
    {
    $html .= "<td>Pending</td>";
    }
    else if ($result['status'] == 2)
    {
    $html .= "<td>Completed</td>";
    }

    $html .= "</tr>";
    $i++;
}
    $html .= "</table>";
    echo $html;

?>

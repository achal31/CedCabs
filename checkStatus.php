<?php
/*------If User Session is Not Created header will take the user out--------------*/
include("header.php");
if (!isset($_SESSION)) {
    session_start();
    
}

if (!isset($_SESSION['username'])) {
    header('location:unauthorisedUser.php');
} else if ($_SESSION['usertype'] == '0') {
    header("adminfiles/adminpanel.php");
}
?>

<div id="heading"><h2>CHECK STATUS</h2></div>
<div id="previousridewrapper">

<!----------Drop Down Toggle Switch--------------->
<div id="filtermenu">
<ul id="filter">
<button class="triggerbtn" id="distance1">SORT BY DISTANCE</button>
<button class="triggerbtn" id="fare1">SORT BY FARE</button>
<button class="triggerbtn" id="weight1">SORT BY WEIGHT</button>
<button class="triggerbtn" id="date1">FILTER BY DATES</button>
<button class="triggerbtn" id="week1">FILTER BY WEEK</button>
<button class="triggerbtn" id="cab1">FILTER BY CABS</button>
<button class="triggerbtn" id="status1">FILTER BY STATUS</button>

<!---------------Drop Down Panel--------------------->
<div id="status" class="hide">
<li><a href="checkStatus.php?status=2" class="filtera">COMPLETED</a></li>
<li><a href="checkStatus.php?status=1" class="filtera">PENDING</a></li>
<li><a href="checkStatus.php?status=0" class="filtera">CANCELLED</a></li>
</div>
<div id="distance" class="hide">
<li><a href="checkStatus.php?filter=total_distance&order=ASC" class="filtera">Ascending Order</a></li>
<li><a href="checkStatus.php?filter=total_distance&order=DESC" class="filtera">Descending Order</a></li>
</div>
<div id="date" class="hide">
<form method="POST" action="checkStatus.php">
<input type="date" name="date1" required>
<input type="date" name="date2" required>
<input type="submit" name="filterdate" value="Filter" class="triggerbtn">
</form>
</div>
<div id="week" class="hide">
<form method="POST" action="checkStatus.php">
<input type="week" name="week" required>
<input type="submit" name="filterweek" value="Filter" class="triggerbtn">
</form>
</div>
<div id="weight" class="hide">
<li><a href="checkStatus.php?filter=luggage&order=ASC" class="filtera">Ascending Order</a></li>
<li><a href="checkStatus.php?filter=luggage&order=DESC" class="filtera">Descending Order</a></li>
</div>
<div id="fare" class="hide">
<li><a href="checkStatus.php?filter=total_fare&order=ASC" class="filtera">Ascending Order</a></li>
<li><a href="checkStatus.php?filter=total_fare&order=DESC" class="filtera">Descending Order</a></li>
</div>
<div id="cab" class="hide">
<li><a href="checkStatus.php?cab=cab_type&order=CedMini" class="filtera">CedMini</a></li>
<li><a href="checkStatus.php?cab=cab_type&order=CedMicro" class="filtera">CedMicro</a></li>
<li><a href="checkStatus.php?cab=cab_type&order=CedRoyal" class="filtera">CedRoyal</a></li>
<li><a href="checkStatus.php?cab=cab_type&order=CedSUV" class="filtera">CedSUV</a></li>
</div>
</ul> 
    </div>
</div>


<div id="tbl">
    
<!----------------------------Calling Function For each Filter------------------------------->
<?php
include_once('user.php');
if (isset($_GET['status'])) {
    $userdata = new user();
    $sql      = $userdata->getStatus($_SESSION['username'], $_GET['status']);
} else if (isset($_POST['week'])) {
    $previousrides = new user();
    $sql           = $previousrides->rideDetail($_SESSION['username'], $_POST['week'], "", 4);
} else if (isset($_GET['cab'])) {
    $previousrides = new user();
    $sql           = $previousrides->rideDetail($_SESSION['username'], $_GET['cab'], $_GET['order'], 3);
} else if (isset($_POST['date1'])) {
    $previousrides = new user();
    $sql           = $previousrides->rideDetail($_SESSION['username'], $_POST['date1'], $_POST['date2'], 2);
} else if (isset($_GET['filter'])) {
    $previousrides = new user();
    $sql           = $previousrides->rideDetail($_SESSION['username'], $_GET['filter'], $_GET['order'], 1);
} else {
    // Object creation
    $userdata = new user();
    $sql      = $userdata->getStatus($_SESSION['username'], "");
}
$i    = 1;
$html = "";
$html .= "<table>";
$html .= "<tr>";
$html .= "<th>S.No</th>";
$html .= "<th>Ride Date</th>";
$html .= "<th>Pick Up</th>";
$html .= "<th>Drop</th>";
$html .= "<th>Cab Type</th>";
$html .= "<th>Total Distance</th>";
$html .= "<th>Luguage</th>";
$html .= "<th>Total Fare</th>";
$html .= "<th>Status</th>";
$html .= "</tr>";
if($sql=='0')
{
    echo"<h2>No Data Available</h2>";
}
else{


foreach ($sql as $result) {
    $html .= "<tr>";
    $html .= "<td>$i</td>";
    $html .= "<td>$result[ride_date]</td>";
    $html .= "<td>$result[tripstart]</td>";
    $html .= "<td>$result[tripend]</td>";
    $html .= "<td>$result[cab_type]</td>";
    $html .= "<td>$result[total_distance]</td>";
    $html .= "<td>$result[luggage]</td>";
    $html .= "<td>$result[total_fare]</td>";
    if ($result['status'] == 0) {
        $html .= "<td>Cancelled</td>";
    } else if ($result['status'] == 1) {
        $html .= "<td>Pending</td>";
    } else if ($result['status'] == 2) {
        $html .= "<td>Completed</td>";
    }
    
    $html .= "</tr>";
    $i++;
}
$html .= "</table>";
echo $html;
}
?>
</div>

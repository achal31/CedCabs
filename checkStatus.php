<?php
/*------If User Session is Not Created header will take the user out--------------*/
include ("header.php");
include_once ('user.php');
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

if (isset($_GET['delete']))
{

    $previousrides = new user();
    $sql = $previousrides->ridedelete($_GET['id']);
    echo "<script>alert('Your Ride Has Been Cancelled');</script>";

}
?>
<div id="checkstatuspanel">
<div id="heading"><h1>RIDE LIST</h1></div>
<div id="previousridewrapper">

<!-------------TOGGLE BUTTON TO TARGET DROP DOWN------------------->
<div id="filtermenu">
<ul id="filter">
<button class="triggerbtn" id="distance1">SORT BY DISTANCE</button>
<button class="triggerbtn" id="fare1">SORT BY FARE</button>
<button class="triggerbtn" id="weight1">SORT BY WEIGHT</button>
<button class="triggerbtn" id="date1">FILTER BY DATES</button>
<button class="triggerbtn" id="week1">FILTER BY WEEK</button>
<button class="triggerbtn" id="cab1">FILTER BY CABS</button>
<button class="triggerbtn"><a href='checkStatus.php?status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>'>CLEAN FILTER</a></button>

<!----------------DROP DOWN TO SHOW FILTER OPTION ---------------------->
<div id="distance" class="hide">
<li><a id="distanceasc" href="checkStatus.php?id=distance&inner=distanceasc&filter=total_distance&order=ASC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Ascending Order</a></li>
<li><a id="distancedsc" href="checkStatus.php?id=distance&inner=distancedsc&filter=total_distance&order=DESC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Descending Order</a></li>
</div>

<div id="date" class="hide">
<form method="GET" action="checkStatus.php">
<input type="date" name="date1" id="dateone" required >
<input type="date" name="date2" id="datetwo" required >
<input type="submit" name="filterdate" value="Filter" class="triggerbtn">
<input value="<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" name="status" type="hidden">
</form>
</div>

<div id="week" class="hide">
<form method="GET" action="checkStatus.php">
<input type="week" name="week" id="weekend" required>
<input type="submit" name="filterweek" value="Filter" class="triggerbtn">
<input value="<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" name="status" type="hidden">
</form>
</div>

<div id="weight" class="hide">

<li>
    <a id="weightasc" href="checkStatus.php?id=weight&inner=weightasc&filter=luggage&order=ASC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Ascending Order</a>
</li>

<li>
    <a id="weightdsc" href="checkStatus.php?id=weight&inner=weightdsc&filter=luggage&order=DESC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Descending Order</a>
</li>

</div>

<div id="fare" class="hide">

<li>
    <a id="fareasc" href="checkStatus.php?id=fare&inner=fareasc&filter=total_fare&order=ASC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Ascending Order</a>
</li>

<li>
    <a id="faredsc" href="checkStatus.php?id=fare&inner=faredsc&filter=total_fare&order=DESC&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">Descending Order</a></li>
</div>

<div id="cab" class="hide">

<li>
    <a id="mini"  href="checkStatus.php?id=cab&inner=mini&cab=cab_type&order=CedMini&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">CedMini</a>
</li>

<li>
    <a id="micro" href="checkStatus.php?id=cab&inner=micro&cab=cab_type&order=CedMicro&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">CedMicro</a>
</li>

<li>
    <a id="royal" href="checkStatus.php?id=cab&inner=royal&cab=cab_type&order=CedRoyal&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">CedRoyal</a>
</li>

<li>
    <a id="suv" href="checkStatus.php?id=cab&inner=suv&cab=cab_type&order=CedSUV&status=<?php if (isset($_GET['status']))
{
    echo $_GET['status'];
} ?>" class="filtera">CedSUV</a>
</li>

</div>
</ul> 
    </div>

</div>
<div id="table">
    
<!----------------------------Calling Function For each Filter------------------------------->
<?php
if (isset($_GET['status']) || isset($_POST['status']))
{
    if (isset($_GET['week']))
    {
        $previousrides = new user();
        $sql = $previousrides->userdash($_SESSION['username'], $_GET['week'], "", 4, $_GET['status']);
    }
    else if (isset($_GET['date1']))
    {
        $previousrides = new user();
        $sql = $previousrides->userdash($_SESSION['username'], $_GET['date1'], $_GET['date2'], 2, $_GET['status']);
    }
    else if (isset($_GET['cab']))
    {
        $previousrides = new user();
        $sql = $previousrides->userdash($_SESSION['username'], $_GET['cab'], $_GET['order'], 3, $_GET['status']);
    }

    else if (isset($_GET['filter']))
    {
        $previousrides = new user();
        $sql = $previousrides->userdash($_SESSION['username'], $_GET['filter'], $_GET['order'], 1, $_GET['status']);
    }
    else
    {
        $userdata = new user();
        $sql = $userdata->rideDetail($_SESSION['username'], $_GET['status']);
    }

}

$i = 1;
$html = "";
$html .= "<table>";
$html .= "<tr>";
$html .= "<th class='checkstatus'>S.No</th>";
$html .= "<th class='checkstatus'>Ride Date</th>";
$html .= "<th class='checkstatus'>Pick Up</th>";
$html .= "<th class='checkstatus'>Drop</th>";
$html .= "<th class='checkstatus'>Cab Type</th>";
$html .= "<th class='checkstatus'>Total Distance</th>";
$html .= "<th class='checkstatus'>Luguage</th>";
$html .= "<th class='checkstatus'>Total Fare</th>";
$html .= "<th class='checkstatus'>Status</th>";
if ($_GET['status'] == '1')
{
    $html .= "<th class='checkstatus'>Cancel Ride</th>";
}
if ($_GET['status'] == '2')
{
    $html .= "<th class='checkstatus'>Print Invoice</th>";
}
$html .= "</tr>";

if ($sql == '0')
{
    echo "<h2>No Data Available</h2>";
}
else
{

    foreach ($sql as $result)
    {
        $html .= "<tr>";
        $html .= "<td class='checkstatus'>$i</td>";
        $html .= "<td class='checkstatus'>$result[ride_date]</td>";
        $html .= "<td class='checkstatus'>$result[tripstart]</td>";
        $html .= "<td class='checkstatus'>$result[tripend]</td>";
        $html .= "<td class='checkstatus'>$result[cab_type]</td>";
        $html .= "<td class='checkstatus'>$result[total_distance] KM</td>";
        $html .= "<td class='checkstatus'>$result[luggage] KG</td>";
        $html .= "<td class='checkstatus'>₹$result[total_fare]</td>";
        if ($result['status'] == 0)
        {
            $html .= "<td class='checkstatus'>Cancelled</td>";
        }
        else if ($result['status'] == 1)
        {
            $html .= "<td class='checkstatus'>Pending</td>";
            if ($_GET['status'] == '1')
            {
                $html .= "<td class='checkstatus'><a onClick=\"javascript: return confirm('Please confirm if you want to cancel the ride request');\" href='checkStatus.php?id=$result[ride_id]&delete=1&status=1'>Cancel</a></td>";
            }
        }
        else if ($result['status'] == 2)
        {
            $html .= "<td class='checkstatus'>Completed</td>";

        }
        if ($_GET['status'] == 2)
        {
            $html .= "<td class='checkstatus'><a href='showinvoice.php?name=$_SESSION[userid]&date=$result[ride_date]&pickup=$result[tripstart]&drop=$result[tripend]&cabtype=$result[cab_type]&distance=$result[total_distance]&weight=$result[luggage]&fare=$result[total_fare]'>View Invoice</a></td>";
        }

        $html .= "</tr>";
        $i++;
    }
    $html .= "</table>";
    echo $html;
}
?>
</div>
<div id=pad></div>
</div>
<?php
include ('footer.php');
?>
<script>

    $(document).ready(function(){
        <?php if (isset($_GET['id']))
{ ?>
        $("#<?php echo $_GET['id'] ?>").show();
        $("#<?php echo $_GET['inner'] ?>").css("cssText", "color: red !important;",);
       
        <?php
}
else
{
    if (isset($_GET['date1']))
    { ?>
              $("#date").show();
            $("#dateone").val("<?php echo $_GET['date1']; ?>");
            $("#datetwo").val("<?php echo $_GET['date2']; ?>");
            <?php
    }
    else if (isset($_GET['week']))
    { ?>
                $("#week").show();
                $("#weekend").val("<?php echo $_GET['week']; ?>");
            <?php
    }
} ?>

    })
</script>

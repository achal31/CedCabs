<?php
include ("header.php");
if (!isset($_SESSION))
{
    session_start();

}
if(empty($_POST['pickup']) && empty($_SESSION['userdata']))
{
    header("Location:index.php");
}
?>
<div id="confirmbookingpanel">
<?php
if (isset($_POST['book']))
{

    $html = "";
    $html .= "<table id='rideinvoice'>";
    include_once ('user.php');
    $userdata = new user();
    $pickup = $_POST['pickup'];
    $drop = $_POST['drop'];
    if (empty($_POST['weight']))
    {
        $weight = 0;
    }
    else
    {
        $weight = $_POST['weight'];
    }
    $fare = $_POST['getfa'];
    $date = date("Y/m/d");
    $cabtype = $_POST['cabtype'];

    if (!isset($_SESSION['username']) && (!isset($_SESSION['userdata'])))
    {

        $_SESSION['userdata'] = array(
            'pickup' => $pickup,
            'drop' => $drop,
            'weight' => $weight,
            'fare' => $fare,
            'date' => $date,
            'cabtype' => $cabtype,
            'distance' => $totaldistance,
            'time' => time()
        );
        header("location:login.php");
    }
    else if ($_SESSION['usertype'] == '0')
    {
        header("adminfiles/adminpanel.php");
    }
    else if (!isset($_SESSION['username']) && (isset($_SESSION['userdata'])))
    {
        $_SESSION['userdata'] = array(
            'pickup' => $pickup,
            'drop' => $drop,
            'weight' => $weight,
            'fare' => $fare,
            'date' => $date,
            'cabtype' => $cabtype,
            'distance' => $totaldistance,
            'time' => time()
        );
        header("location:login.php");
    }
    else
    {
        if (isset($_SESSION['username']) && !isset($_SESSION['userdata']))
        {
            echo "<div id='confirm'><h3 id='headingconfirm'>ThankYou For Booking,Your Request Has Been Send</h3>
    <h4 id='invo'>Booking Invoice</h4>";
            $totaldistance = $userdata->calculateFare($_SESSION['username'], $pickup, $drop, $weight, $fare, $cabtype);
            $html .= "<tr><th class='confirmbooking'>PickUp Location</th><td class='confirmbooking'>$pickup</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Drop Location</th><td class='confirmbooking'>$drop</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Cab Type</th><td class='confirmbooking'>$cabtype</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Ride Date</th><td class='confirmbooking'>$date</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Total Distance</th><td class='confirmbooking'>$totaldistance</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Luggage</th><td class='confirmbooking'>$weight</td></tr>";
            $html .= "<tr><th class='confirmbooking'>Total Fare</th> <td class='confirmbooking'>$fare</td></tr>";
            $html .= "</table>";
            echo $html;
            echo "</div>";
        }
        else
        {
            header("Location:index.php");
        }
    }

}
else if (isset($_SESSION['userdata']))
{
    if (($_SESSION['usertype']) == 1)
    {
        include_once ('user.php');
        $userdata = new user();
        $totaldistance = $userdata->calculateFare($_SESSION['username'], $_SESSION['userdata']['pickup'], $_SESSION['userdata']['drop'], $_SESSION['userdata']['weight'], $_SESSION['userdata']['fare'], $_SESSION['userdata']['cabtype']);
        echo "<div id='confirm'><h3 id='headingconfirm'>ThankYou For Booking,Your Request Has Been Send</h3>
    <h4 id='invo'>Booking Invoice</h4>";
        $html = "";
        $html .= "<table id='rideinvoice'>";
        $html .= "<tr><th  class='confirmbooking'>PickUp Location</th><td class='confirmbooking'>" . $_SESSION['userdata']['pickup'] . "</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Drop Location</th><td class='confirmbooking'>" . $_SESSION['userdata']['drop'] . "</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Cab Type</th><td class='confirmbooking'>" . $_SESSION['userdata']['cabtype'] . "</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Ride Date</th><td class='confirmbooking'>" . $_SESSION['userdata']['date'] . "</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Total Distance</th><td class='confirmbooking'>$totaldistance</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Luggage</th><td class='confirmbooking'>" . $_SESSION['userdata']['weight'] . "</td></tr>";
        $html .= "<tr><th class='confirmbooking'>Total Fare</th><td class='confirmbooking'>" . $_SESSION['userdata']['fare'] . "</td></tr>";
        $html .= "</table>";
        echo $html;
        echo "</div>";
        unset($_SESSION['userdata']);
    }
}
echo "<div id=pad></div>";
include ('footer.php');
?>
</div>

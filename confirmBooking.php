<?php
include("header.php");
if (!isset($_SESSION)) {
    session_start();
    
}
?>

<?php
if (isset($_POST['book'])) {
    
    echo "<h3>ThankYou For Booking,Your Request Has Been Send</h3>
            <h4>Booking Invoice</h4>";
    $html = "";
    $html .= "<table>";
    include_once('user.php');
    $userdata = new user();
    $pickup   = $_POST['pickup'];
    $drop     = $_POST['drop'];
    if (empty($_POST['weight'])) {
        $weight = 0;
    } else {
        $weight = $_POST['weight'];
    }
    $fare          = $_POST['getfa'];
    $date          = date("Y/m/d");
    $cabtype       = $_POST['cabtype'];
    if (!isset($_SESSION['username'])) {
        $totaldistance = $userdata->calculateFare($_SESSION['username'], $pickup, $drop, $weight, $fare, $cabtype);
        $_SESSION['userdata']=array('pickup'=>$pickup,'drop'=>$drop,'weight'=>$weight,'fare'=>$fare,'date'=>$date,'cabtype'=>$cabtype,'distance'=> $totaldistance);
       
        echo "<script>window.location.href='login.php'</script>";
    } else if ($_SESSION['usertype'] == '0') {
        header("adminfiles/adminpanel.php");
    }
    if(!isset($_SESSION['userdata']))
    {
    $_SESSION['userdata']=array('pickup'=>$pickup,'drop'=>$drop,'weight'=>$weight,'fare'=>$fare,'date'=>$date,'cabtype'=>$cabtype);

    $totaldistance = $userdata->calculateFare($_SESSION['username'], $pickup, $drop, $weight, $fare, $cabtype);
    $html .= "<tr><th>PickUp Location</th><td>$pickup</td></tr>";
    $html .= "<tr><th>Drop Location</th><td>$drop</td></tr>";
    $html .= "<tr><th>Cab Type</th><td>$cabtype</td></tr>";
    $html .= "<tr><th>Ride Date</th><td>$date</td></tr>";
    $html .= "<tr><th>Total Distance</th><td>$totaldistance</td></tr>";
    $html .= "<tr><th>Luggage</th><td>$weight</td></tr>";
    $html .= "<tr><th>Total Fare</th> <td>$fare</td></tr>";
    $html .= "</table>";
    echo $html;
    }
    
}
else if(isset($_SESSION['userdata']))
{  if(isset($_SESSION['usertype']))
    {
    echo "<h3>ThankYou For Booking,Your Request Has Been Send</h3>
    <h4>Booking Invoice</h4>";
    $html="";
    $html .= "<table>";
    $html .= "<tr><th>PickUp Location</th><td>".$_SESSION['userdata']['pickup']."</td></tr>";
    $html .= "<tr><th>Drop Location</th><td>".$_SESSION['userdata']['drop']."</td></tr>";
    $html .= "<tr><th>Cab Type</th><td>".$_SESSION['userdata']['cabtype']."</td></tr>";
    $html .= "<tr><th>Ride Date</th><td>".$_SESSION['userdata']['date']."</td></tr>";
    $html .= "<tr><th>Total Distance</th><td>".$_SESSION['userdata']['distance']."</td></tr>";
    $html .= "<tr><th>Luggage</th><td>".$_SESSION['userdata']['weight']."</td></tr>";
    $html .= "<tr><th>Total Fare</th><td>".$_SESSION['userdata']['fare']."</td></tr>";
    $html .= "</table>";
    echo $html;
    include_once('user.php');
    $userdata = new user();
    $totaldistance = $userdata->calculateFare($_SESSION['username'], $_SESSION['userdata']['pickup'],$_SESSION['userdata']['drop'],$_SESSION['userdata']['weight'],$_SESSION['userdata']['fare'],$_SESSION['userdata']['cabtype']);
   unset($_SESSION['userdata']);
}
}


?>
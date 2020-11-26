<?php 
    session_start();
include("headeruser.php");
?>

<?php
if(isset($_POST['book']))
    {
        if(empty($_SESSION['username']))
        {
            echo "<script>alert('Please login to Book The Cab');</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
        else{
            echo "<h3>ThankYou For Booking,Your Request Has Been Send</h3>
            <h4>Booking Invoice</h4>";
            $html="";
            $html.="<table>";
            include_once('user.php');
            $userdata=new user();
            $pickup=$_POST['pickup'];
            $drop=$_POST['drop'];
            $weight=$_POST['weight'];
            $fare=$_POST['getfa'];
            $date=date("Y/m/d");
            $totaldistance=$userdata->calculateFare($_SESSION['username'],$pickup,$drop,$weight,$fare);
            
                
                $html.="<tr><th>PickUp Location</th><td>$pickup</td></tr>";
                $html.="<tr><th>Drop Location</th><td>$drop</td></tr>";
                $html.="<tr><th>Ride Date</th><td>$date</td></tr>";
                $html.="<tr><th>Total Distance</th><td>$totaldistance</td></tr>";
                $html.="<tr><th>Luggage</th><td>$weight</td></tr>";
                $html.="<tr><th>Total Fare</th> <td>$fare</td></tr>";
                $html.="</table>";
                echo $html;
        }

    }
?>
<?php
include("adminheader.php");
include("sidebar.php");
include_once('admin.php');
if(isset($_GET['rideid']))
{  
    if(isset($_GET['approve']))
    {
   
    $userdata=new admin();
    $userdata->acceptRide($_GET['rideid']);
    }
    else if(isset($_GET['decline']))
    {
    
    $userdata=new admin();
    $userdata->declineRide($_GET['rideid']);
    }
}
?>
<div id="wrapper">
    <?php
    if(isset($_GET['status']))
    {
        $userdata=new admin();
        $sql=$userdata->riderequest($_GET['status']);
        $i=1;
        $total=0;
        $html="";
        $html.="<table>";
        $html.="<form><tr>";
        $html.="<th>S.No</th>";
        $html.="<th>Ride Date</th>";
        $html.="<th>Pick Up</th>";
        $html.="<th>Drop</th>";
        $html.="<th>Total Distance</th>";
        $html.="<th>Luguage</th>";
        $html.="<th>Total Fare</th>";
        $html.="<th colspan='2' >Status</th>";
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
            if($result['status']==0)
            {
                $html.="<td>Cancelled</td>";
            }else if($result['status']==1)
            {
                $html.="<td><a href='rideRequest.php?rideid=$result[ride_id]&approve=1' class='approve'>Approve</a><a href='rideRequest.php?rideid=$result[ride_id]&decline=1' class='decline'>Decline</a></td>";
            }else{
                $html.="<td>Completed</td>";  
            }
           
            $html.="</tr>";
            $i++;
        }
        $html.="</form></table>";
        echo $html;
    }
   

     ?>
</div>


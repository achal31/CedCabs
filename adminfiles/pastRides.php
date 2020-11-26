<?php 
include("adminheader.php");
include("sidebar.php");
include_once('admin.php');
if(isset($_GET['delete']))
{
    $id=$_GET['id'];
    $userdata=new admin();
    $userdata->deleterideDetail($id);
}
?>

    <div id="filtermenu">
<ul id="filter">
    
  <li><a href="pastRides.php?filter=distance">Distance</a></li>
  <li><a href="pastRides.php?filter=fare">Fare</a></li>
  <li><a href="pastRides.php?filter=date">Date</a></li>
  <li><a href="pastRides.php?filter=name">Name</a></li>
</ul> 
    </div>

    <div id="wrapper">
    <?php

     $userdata=new admin();    
        $i=1;
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
            $html.="<th>Delete</th>";
            $html.="</tr>";
if(isset($_GET['filter']))
{
    $sql=$userdata->pastrides($_GET['filter']);
}
else{
    $sql=$userdata->pastrides("");
}
       
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
            $html.="<td><a href='pastRides.php?id=$result[ride_id]&delete=1'>Delete</a></td>";
            $html.="</tr>";
            $i++;
        }
            $html.="</table>";
            echo $html;
    
     ?>
</div>

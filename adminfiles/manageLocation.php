<?php
include("adminheader.php");
include("sidebar.php");
include_once('admin.php');
if(isset($_GET['id']))
{  
    if(isset($_GET['availability'])==1)
    {
    $userdata=new admin();
    $userdata->locationavailability($_GET['id']);
    }
    else if(isset($_GET['delete'])==1)
    {
        $userdata=new admin();
        $userdata->locationdelete($_GET['id']);
    }
}
?>
<div id="wrapper">
    <?php
    include_once('admin.php');
    $userdata=new admin();
    $sql=$userdata->managelocation();
    $i=1;
    $html="";
    $html.="<table>";
    $html.="<tr>";
    $html.="<th>S.No</th>";
    $html.="<th>Location</th>";
    $html.="<th>Distance</th>";
    $html.="<th>Status</th>";
    $html.="<th>Available/Unavailable</th>";
    $html.="<th>Delete</th>";
    $html.="<th>Edit</th>";      
    $html.="</tr>";
    foreach($sql as $result)
    {
        $html.="<tr>"; 
        $html.="<td>$i</td>";
        $html.="<td>$result[name]</td>";
        $html.="<td>$result[distance]</td>";
        if($result['is_available']==0)
        {
            $html.="<td>Available</td>";
        }else{
            $html.="<td>Unavailable</td>";
        }
        $html.="<td><a href='manageLocation.php?id=$result[id]&availability=1'>Available/Unavailable</a></td>";
        $html.="<td><a href='manageLocation.php?id=$result[id]&delete=1'>Delete</a></td>";
        $html.="<td><a href='addLocation.php?id=$result[id]&edit=1&name=$result[name]&distance=$result[distance]'>Edit</a></td>";
        $html.="</tr>";
        $i++;
    }
    $html.="</table>";
    echo $html;
     ?>
        
</div>

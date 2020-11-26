<?php
include("adminheader.php");
include("sidebar.php");
include_once('admin.php');
if(isset($_GET['userid']))
{  
    if(isset($_GET['status'])==1)
    {
    
    $userdata=new admin();
    $userdata->userStatus($_GET['userid']);
    }
}
?>
<div id="wrapper">
    <?php
    if(isset($_GET['request']))
    {
        $userdata=new admin();
        $sql=$userdata->manageuser($_GET['request']);
        $i=1;
        $html="";
        $html.="<table>";
        $html.="<form><tr>";
        $html.="<th>S.No</th>";
        $html.="<th>User Name</th>";
        $html.="<th>Date Of SignUp</th>";
        $html.="<th>Mobile Number</th>";
        $html.="<th>Status</th>";
        $html.="<th>Block/Unblock</th>";
        $html.="</tr>";
        if($_GET['request']==0)
        {
            echo"<h1>BLOCKED USER</h1>";
        }
        if($_GET['request']==1)
        {
            echo"<h1>UNBLOCKED USER</h1>";
        }
        if($_GET['request']==2)
        {
            echo"<h1>ALL USER</h1>";
        }
        foreach($sql as $result)
    {
        $html.="<tr>"; 
        $html.="<td>$i</td>";
        $html.="<td>$result[name]</td>";
        $html.="<td>$result[dateofsignup]</td>";
        $html.="<td>$result[mobile]</td>";
        if($result['isblock']==0)
        {
            $html.="<td>Block</td>";
        }else{
            $html.="<td>Unblock</td>";
        }
        
        $html.="<td><a href='manageUser.php?userid=$result[user_id]&status=1'>Block/UnBlock</a></td>";
        $html.="</tr>";
        $i++;
    }
        $html.="</table>";
        echo $html;

        
    }
    
    
    
     ?>
</div>

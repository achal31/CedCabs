<?php
include("adminheader.php");
include("sidebar.php");
include_once('admin.php');
$distance = '';
if(isset($_GET['edit']))
{    
    $name=$_GET['name'];
    $distance.=$_GET['distance'];
    $id=$_GET['id'];
}
if(isset($_POST['Save'])=='Add Location')
{
    if($_POST['Save']=='Add Location')
    {
    $locationname=$_POST['location'];
    $distance=$_POST['distance'];
    $userdata=new admin();
    $userdata->newlocation($locationname,$distance);
    }

else if($_POST['Save']=='Update Location')
{
    $locationname=$_POST['location'];
    $distance=$_POST['distance'];
    $id=$_POST['id'];
    $userdata=new admin();
    $userdata->Updatelocation($id,$locationname,$distance);
}
}
?>
<div id="wrapper">
<form action="addLocation.php" method="POST">
    <input type="text" name="location" placeholder="Enter The Location" value="<?php if(isset($_GET['edit'])) { echo $name ; }?>">
    <p></p>
    <input type="text" name="distance" placeholder="Enter The distance"  id="dynamic" value="<?php if(isset($_GET['edit'])) { echo $distance ; }?>">
    <p></p>
    <input type="hidden" name="id" value="<?php if(isset($_GET['edit'])) { echo $id; }?>">
    <input type="submit" name="Save" value="<?php if(isset($_GET['edit'])) { echo "Update Location" ; } else { echo "Add Location"; }?>" id="save">
</form>
</div>
<?php 
include("adminheader.php");
include("sidebar.php");
?>
<div id="wrapper">
    <h1>Total Earnings</h1>
<h2>
<?php
include_once('admin.php');

    $userdata=new admin();
    $userdata->totalearning();

?>
</h2>
</div>

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
?>
<div id="panel">
    <a href="#"><div id="userspending" class="usertile">
    <div class="content">
        <h2>Your Spending</h2><h2>₹<?php
$total = 0;
$previousrides = new user();
$sql = $previousrides->userdashboard($_SESSION['username'], 1);
if ($sql == '0')
{
    echo "<h2>No Data Avialable</h2>";
}
foreach ($sql as $result)
{
    $total = $total + $result['total_fare'];
}
echo $total;
?></h2>
</div></div></a>
    <a href="checkStatus.php?status=1"><div id="pendingrides" class="usertile">
    <div class="content">
    <h2>Pending Rides</h2>
    <h2>
        <?php
$previousrides = new user();
$sql = $previousrides->userdashboard($_SESSION['username'], 2);
echo mysqli_num_rows($sql); ?>
    </h2>
    </div> 
</div></a>
    <a href="checkStatus.php?status=2"><div id="completedrides" class="usertile">
    <div class="content">
    <h2>Completed Rides</h2>
    <h2>
        <?php $previousrides = new user();
$sql = $previousrides->userdashboard($_SESSION['username'], 3);
echo mysqli_num_rows($sql); ?>
    </h2>
    </div>
</div></a>
    <a href="checkStatus.php?status=0"><div id="cancelledrides" class="usertile">
    <div class="content">
    <h2>Cancelled Rides</h2>
    <h2>
        <?php
$previousrides = new user();
$sql = $previousrides->userdashboard($_SESSION['username'], 4);
echo mysqli_num_rows($sql); ?>
        </h2>
    </div>
    </div></a>
    <a href="checkStatus.php?status=3"><div id="totalrides" class="usertile">
    <div class="content">
    <h2>Total Rides</h2>
    <h2>
        <?php
$previousrides = new user();
$sql = $previousrides->userdashboard($_SESSION['username'], 5);
echo mysqli_num_rows($sql); ?>
        </h2>
    </div>
    </div></a>
</div>
<div id=pad></div>
     <?php include ('footer.php');
?>

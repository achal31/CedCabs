<?php 
include('config.php');
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$pickup=$_POST['pickup1'];
$drop=$_POST['drop1'];
$cabtype=$_POST['cabtype1'];
$weight=$_POST['weight1'];

/*--------------To Store Pickup Location----------------------*/
$pickuplocation="SELECT distance From tbl_location where `name`='$pickup'";
 $displaydistance=mysqli_query($conn, $pickuplocation);

while ($getdistance=mysqli_fetch_array($displaydistance)) {
    $intialDistance=$getdistance['distance'];
}

/*--------------To Store Drop Location----------------------*/
$droplocation="SELECT distance From tbl_location where `name`='$drop'";
 $displaydistance=mysqli_query($conn, $droplocation);

while ($getdistance=mysqli_fetch_array($displaydistance)) {
    $finalDistance=$getdistance['distance'];
}

/*--------------To Calculate Total Distance----------------------*/
$totaldistance=abs($intialDistance-$finalDistance);
switch($totaldistance)
{
    case $totaldistance<=10: 
        switch($cabtype)
        {
           case 'CedMicro': $bill=50+($totaldistance*13.50); break; 
           case  'CedMini': $bill=150+($totaldistance*14.50); break;
           case 'CedRoyal': $bill=200+($totaldistance*15.50); break;
           case 'CedSUV': $bill=250+($totaldistance*16.50); break;
        }
    break;
    
    case $totaldistance<=60:
        switch($cabtype)
        {
           case 'CedMicro': $bill=50+(10*13.50)+(($totaldistance-10)*12); break; 
           case  'CedMini':  $bill=150+(10*14.50)+(($totaldistance-10)*13); break;
           case 'CedRoyal': $bill=200+(10*15.50)+(($totaldistance-10)*14); break;
           case 'CedSUV':$bill=250+(10*16.50)+(($totaldistance-10)*15); break;
        }
    break;
    
    case $totaldistance<=160:
        switch($cabtype)
        {
           case 'CedMicro': $bill=50+(10*13.50)+(50*12)+(($totaldistance-60)*10.20); break; 
           case  'CedMini': $bill=150+(10*14.50)+(50*13)+(($totaldistance-60)*11.20); break;
           case 'CedRoyal': $bill=200+(10*15.50)+(50*14)+(($totaldistance-60)*12.20); break;
           case 'CedSUV':$bill=250+(10*16.50)+(50*15)+(($totaldistance-60)*13.20); break;
        }
    break;

    case $totaldistance>160:
        switch($cabtype)
        {
           case 'CedMicro':  $bill=50+(10*13.50)+(50*12)+(100*10.20)+(($totaldistance-160)*8.50); break; 
           case  'CedMini': $bill=150+(10*14.50)+(50*13)+(100*11.20)+(($totaldistance-160)*9.50); break;
           case 'CedRoyal': $bill=200+(10*15.50)+(50*14)+(100*12.20)+(($totaldistance-160)*10.50); break;
           case 'CedSUV':$bill=250+(10*16.50)+(50*15)+(100*13.20)+(($totaldistance-160)*11.50); break;
        }
    break;  
}

/*-----Condition To Check Cab And Weight----------*/
if($cabtype!=='CedMicro' && $weight!=0)
{
switch($weight)
{
    case $weight<=10: $charge=50; break;
    case $weight<=20: $charge=100; break;
    case $weight>20: $charge=200; break;
}
switch($cabtype)
{
    case 'CedSUV': $bill=$bill+(($charge)*2); break;
    default:  $bill=$bill+$charge;
}
}

echo $bill;

?>
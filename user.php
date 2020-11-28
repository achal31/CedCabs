<?php
define('DB_SERVER', 'localhost'); // Your hostname
define('DB_USER', 'root'); // Databse username
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'cabservice'); // Database name
class user
{
    
    function __construct()
    {
        $conn      = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    
    public function rideDetail($username, $filter, $order, $type)
    {
        
        
        switch ($type) {
            case '0':
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `status`='2'");
                break;
            case '1':
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `status`='2' ORDER BY `$filter` $order ");
                break;
            case '2':
                $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` ='$username' AND DATE(`ride_date`) BETWEEN '$filter' AND '$order'");
                break;
            case '3':
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `cab_type`='$order'");
                break;
            case '4':
                $week       = (substr($filter, -2) - 1);
                $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$username' AND WEEK(`ride_date`)='$week'");
                break;
                
        }
        
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
        
    }
    
    public function calculateFare($username, $pickup, $drop, $weight, $fare, $cabtype)
    {
        
        $intialdistance = mysqli_query($this->dbh, "SELECT distance From tbl_location where `name`='$pickup'");
        while ($ridedata = mysqli_fetch_array($intialdistance)) {
            $pickupDistance = $ridedata['distance'];
        }
        $finaldistance = mysqli_query($this->dbh, "SELECT distance From tbl_location where `name`='$drop'");
        while ($ridedata = mysqli_fetch_array($finaldistance)) {
            $dropDistance = $ridedata['distance'];
        }
        $totaldistance = abs($pickupDistance - $dropDistance);
        
        $date = date("y/m/d");
        
        $insertCabdetail = mysqli_query($this->dbh, "INSERT into tbl_ride (`ride_date`,`tripstart`,`tripend`,`cab_type`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) values('$date','$pickup','$drop','$cabtype','$totaldistance','$weight','$fare','1','$username')");
        return $totaldistance;
    }
    
    public function usersettings($username, $change, $current, $new, $confirm)
    {
        
        
        $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_id`='$username' AND `$change`='$current'");
        $check      = mysqli_fetch_assoc($userdetail);
        $result     = $userdetail->num_rows;
        if ($result == 1) {
            if ($new == $confirm) {
                $update = mysqli_query($this->dbh, "UPDATE tbl_user SET `$change`='$new' WHERE `user_id`='$username'");
                echo "<script>alert('Updated Successfully');</script>";
            } else {
                echo "<script>alert('Wrong Detail Entered Please Check And Try Again');</script>";
            }
        } else {
            echo "<script>alert('Wrong Detail Entered Please Cheack And Try Again');</script>";
        }
    }
    public function getStatus($username, $status)
    {
        if ($status == "") {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username'");
        } else {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `status`='$status'");
        }
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        }
    }
}
?>
<!----------------USER CLASS FILE--------------------->
<?php
define('DB_SERVER', 'localhost'); // Your hostname
define('DB_USER', 'root'); // Databse username
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'cabservice'); // Database name
class user
{

    function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    /*----------------FUNCTION USED TO RETURN THE FILTED LIST TO THE USER------------------*/
    public function rideDetail($username, $type)
    {

        if ($type == '3')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username'");
        }
        else
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `status`='$type'");
        }

        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
        else
        {
            return 0;
        }

    }

    /*------FUNCTION USED TO CALCULATE THE TOTAL DISTANCE AND INSERT NEW RIDE IN THE DATABASE---------*/
    public function calculateFare($username, $pickup, $drop, $weight, $fare, $cabtype)
    {

        $intialdistance = mysqli_query($this->dbh, "SELECT distance From tbl_location where `name`='$pickup'");
        while ($ridedata = mysqli_fetch_array($intialdistance))
        {
            $pickupDistance = $ridedata['distance'];
        }
        $finaldistance = mysqli_query($this->dbh, "SELECT distance From tbl_location where `name`='$drop'");
        while ($ridedata = mysqli_fetch_array($finaldistance))
        {
            $dropDistance = $ridedata['distance'];
        }
        $totaldistance = abs($pickupDistance - $dropDistance);

        $date = date("y/m/d");

        $insertCabdetail = mysqli_query($this->dbh, "INSERT into tbl_ride (`ride_date`,`tripstart`,`tripend`,`cab_type`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) values('$date','$pickup','$drop','$cabtype','$totaldistance','$weight','$fare','1','$username')");
        return $totaldistance;
    }

    /*------------FUNCTION USED TO EXECUTE THE USERSETTINGS------------------*/
    public function usersettings($username, $change, $current1, $new1, $confirm1)
    {

        if ($change == 'password')
        {
            $current = md5($current1);

        }
        else
        {

            $current = $current1;
        }

        $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_id`='$username' AND `$change`='$current'");
        $check = mysqli_fetch_assoc($userdetail);
        $result = $userdetail->num_rows;
        if ($result == 1)
        {
            if ($new1 == $confirm1)
            {   
                
                if ($change == 'password')
                {
                    $new = md5($new1);
                }
                
                else
                {
                    $new = $new1;
                }
               if($current1!=$new1)
               {
                $update = mysqli_query($this->dbh, "UPDATE tbl_user SET `$change`='$new' WHERE `user_id`='$username'");
                echo "<script>alert('Updated Successfully');</script>";
                echo "<script>window.location.href='logout.php'</script>";
               }
               else {
                echo "<script>alert('Updating Same information is Not allowed');</script>";
               }
            }
            else
            {
                echo "<script>alert('Wrong Detail Entered Please Check And Try Again');</script>";
            }
        }
        else
        {
            echo "<script>alert('Wrong Detail Entered Please Cheack And Try Again');</script>";
        }
    }

    /*-------------FUNCTION USED TO RETURN THE FILTERED LIST-----------------------*/
    public function getStatus($username, $status)
    {
        if ($status == "")
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username'");
        }
        else
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$username' AND `status`='$status'");
        }
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
        else
        {
            return 0;
        }
    }

    public function userdash($userid, $filter, $order, $type, $list)
    {
        switch ($type)
        {
            case '1':if ($list == '3') { 
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' ORDER BY cast(`$filter` as unsigned) $order ");
                }else{
                    $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `status`='$list' ORDER BY cast(`$filter` as unsigned) $order ");
                }break;

            case '2':if ($list == '3') {
                $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` ='$userid' AND  DATE(`ride_date`) BETWEEN '$filter' AND '$order'");
                }else{
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` ='$userid' AND `status`='$list' AND  DATE(`ride_date`) BETWEEN '$filter' AND '$order'");
                }break;

            case '3':if ($list == '3') {
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `cab_type`='$order'");
                }else{
                    $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `cab_type`='$order' AND `status`='$list'");
                }break;

            case '4':$week = (substr($filter, -2) - 1);
                if ($list == '3') {
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$userid' AND WEEK(`ride_date`)='$week'");
                } else {
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$userid' AND WEEK(`ride_date`)='$week' AND `status`='$list'");
                }break;
        }
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
        else
        {
            return 0;
        }

    }
    public function userdashboard($userid, $type)
    {
        $total = 0;
        switch ($type)
        {
            case 1:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `status`='2'");break;
            case 2:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `status`='1'");break;
            case 3:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `status`='2'");break;
            case 4:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid' AND `status`='0'");break;
            case 5:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$userid'");break;
        }
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
        else
        {
            return 0;
        }
    }

    public function ridedelete($id)
    {
        $fetchRides = mysqli_query($this->dbh, "UPDATE `tbl_ride` SET `status`='0' WHERE `ride_id`=$id");
    }
}

?>

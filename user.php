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

    public function rideDetail($username, $filter)
    {

        $fetchuserId = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `user_name`='$username'");
        $userId = mysqli_fetch_array($fetchuserId);
        $user = $userId['user_id'];

        if ($filter == "")
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user' AND `status`='2'");
        }
        if ($filter == 'FARE')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user' AND `status`='2' ORDER BY `total_fare` ASC ");
        }
        if ($filter == 'DISTANCE')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user' AND `status`='2' ORDER BY `total_distance` ASC ");
        }
        if ($filter == 'DATE')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user' AND `status`='2' ORDER BY `ride_date` ");

        }
        if ($filter == 'MONTH')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user' AND `status`='2' ORDER BY MONTH(`ride_date`) ");

        }

        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }

    }

    public function calculateFare($username, $pickup, $drop, $weight, $fare)
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

        $date = date("Y/m/d");
        $fetchuserId = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `user_name`='$username'");
        $userId = mysqli_fetch_array($fetchuserId);
        $user = $userId['user_id'];

        $insertCabdetail = mysqli_query($this->dbh, "INSERT into tbl_ride (`ride_date`,`tripstart`,`tripend`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) values('$date','$pickup','$drop','$totaldistance','$weight','$fare','1','$user')");
        return $totaldistance;
    }

    public function usersettings($username, $change, $current, $new, $confirm)
    {
        if ($change == 'change Password')
        {

            $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_name`='$username' AND `password`='$current'");
            $check = mysqli_fetch_assoc($userdetail);
            $result = $userdetail->num_rows;
            if ($result == 1)
            {

                if ($new == $confirm)
                {
                    $updatepassword = mysqli_query($this->dbh, "UPDATE tbl_user SET `password`='$new' WHERE `user_name`='$username'");
                    echo "<script>alert('Password changes Successfully');</script>";
                }
                else
                {
                    echo "<script>alert('Password Doesnt match');</script>";
                }
            }
            else
            {
                echo "<script>alert('Your Have Entered A Wrong Password');</script>";
            }
        }
        if ($change == 'change Number')
        {

            $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_name`='$username' AND `mobile`='$current'");
            $check = mysqli_fetch_assoc($userdetail);
            $result = $userdetail->num_rows;
            if ($result == 1)
            {

                if ($new == $confirm)
                {
                    $updatepassword = mysqli_query($this->dbh, "UPDATE tbl_user SET `mobile`='$new' WHERE `user_name`='$username'");
                    echo "<script>alert('Number Updated Successfully');</script>";
                }
                else
                {
                    echo "<script>alert('Number Doesnt match');</script>";
                }
            }
            else
            {
                echo "<script>alert('Your Have Entered A Wrong Number');</script>";
            }
        }
        if ($change == 'change Username')
        {
            $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_name`='$username' AND `name`='$current'");
            $check = mysqli_fetch_assoc($userdetail);
            $result = $userdetail->num_rows;
            if ($result == 1)
            {

                if ($new == $confirm)
                {
                    $updatepassword = mysqli_query($this->dbh, "UPDATE tbl_user SET `name`='$new' WHERE `user_name`='$username'");
                    echo "<script>alert('Full Name Updated Successfully');</script>";
                }
                else
                {
                    echo "<script>alert('Full Name  Doesnt match');</script>";
                }
            }
            else
            {
                echo "<script>alert('Your Have Entered A Wrong Full Name ');</script>";
            }
        }
    }
    public function getStatus($username)
    {
        $fetchuserId = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `user_name`='$username'");
        $userId = mysqli_fetch_array($fetchuserId);
        $user = $userId['user_id'];
        $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `customer_user_id`='$user'");
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
    }
}
?>
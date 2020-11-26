<?php
define('DB_SERVER', 'localhost'); // Your hostname
define('DB_USER', 'root'); // Databse username
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'cabservice'); // Database name


class admin
{

    function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    public function riderequest($status)
    {
        switch($status)
        {
            case 0: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='0'");break;
            case 1: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='1'");break;
            case 2: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='2'");break;
        }
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }

    }

    public function acceptRide($userid)
    {
        $fetchRides = mysqli_query($this->dbh, "UPDATE tbl_ride SET `status`='2' WHERE ride_id='$userid'");
    }
    public function declineRide($userid)
    {
        $fetchRides = mysqli_query($this->dbh, "UPDATE tbl_ride SET `status`='0' WHERE ride_id='$userid'");
    }

    public function manageUser($status)
    {
        switch($status)
        {
            case 0: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`='0'");break;
            case 1: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`='1'");break;
            case 2: $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user ");break;
        }
       
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }

    }

    public function userStatus($userid)
    {
        $fetchdata = mysqli_query($this->dbh, "SELECT * FROM tbl_user WHERE `user_id`='$userid'");
        while ($ridedata = mysqli_fetch_array($fetchdata))
        {
            if ($ridedata['isblock'] == '0')
            {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_user SET `isblock`='1' WHERE `user_id`='$userid'");
            }
            else
            {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_user SET `isblock`='0' WHERE `user_id`='$userid'");
            }

        }
    }

    public function pastrides($filter)
    {
      switch($filter)
      {
        case "":$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0'");break;
        case 'distance':$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY `total_distance`");break;
        case 'fare':$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY `total_fare`");break;
        case 'name':$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY `tripstart`");break;
        case 'date':$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY `ride_date`");break;
        }
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }
    }

    public function deleterideDetail($id)
    {
        $fetchUser = mysqli_query($this->dbh, "DELETE FROM tbl_ride  WHERE `ride_id`='$id'");
    }

    public function managelocation()
    {

        $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_location");
        if (mysqli_num_rows($fetchRides) > 0)
        {
            return $fetchRides;
        }

    }

    public function locationavailability($id)
    {
        
        $fetchUser = mysqli_query($this->dbh, "SELECT * FROM `tbl_location` WHERE `id`='$id'");
        while ($ridedata = mysqli_fetch_array($fetchUser))
        {
            if ($ridedata['is_available'] == '0')
            {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='1' WHERE `id`='$id'");
            }
            else
            {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='0' WHERE `id`='$id'");
            }
        }

    }

    public function locationdelete($id)
    {
        $fetchUser = mysqli_query($this->dbh, "DELETE FROM tbl_location  WHERE `id`='$id'");
    }
    public function newlocation($name, $distance)
    {
        $fetchUser = mysqli_query($this->dbh, "INSERT INTO tbl_location (`name`,`distance`,`is_available`) VALUES('$name','$distance','0')");
        echo "<script>window.location.href='manageLocation.php'</script>";
    }
    public function Updatelocation($id, $locationname, $distance)
    {
        $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `name`='$locationname' ,`distance`='$distance' WHERE `id`='$id'");
        echo "<script>window.location.href='manageLocation.php'</script>";
    }

    public function totalearning()
    {
        $total = 0;
        $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_ride WHERE `status`='2'");
        while ($ridedata = mysqli_fetch_array($fetchUser))
        {
            $total = $total + (int)$ridedata['total_fare'];
        }
        echo $total;
    }
}

?>
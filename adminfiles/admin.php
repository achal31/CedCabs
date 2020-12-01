<?php
define('DB_SERVER', 'localhost'); // Your hostname
define('DB_USER', 'root'); // Databse username
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'cabservice'); // Database name


class admin
{
    
    function __construct()
    {
        $conn      = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    
    public function dashboard($tile)
    {
        switch ($tile) {
            case 1:
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='1'");
                break;
            case 2:
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='2'");
                break;
            case 3:
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`='1'");
                break;
            case 4:
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='0'");
                break;
            case 5:
                $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE  `isblock`='0'");
                break;
            case 6:
                $fetchRides = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `is_available`='0'");
                break;
        }
        return mysqli_num_rows($fetchRides);
        
    }
    
    
    
    public function riderequest($status)
    {
        $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`=$status");
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
    }
    
    public function ridefilter($status, $filter, $order)
    {
        
        
      if($filter=='cab_type')
      {
        $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`=$status AND `$filter`='$order'");
      }
      else {

        if($filter == "total_distance") {
            $filter = "cast(`$filter` AS unsigned)";
        }
        $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`=$status ORDER BY $filter $order");
      }
                    
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
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
        if ($status == 2) {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user");
        } else {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`=$status");
        }
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
        
    }
    
    
    
    public function filteruser($filter, $order, $request)
    {
        if ($request == '2') {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user ORDER BY $filter $order");
        } else {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`=$request ORDER BY $filter $order");
        }
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
    }
    
    
    
    public function userStatus($userid)
    {
        $fetchdata = mysqli_query($this->dbh, "SELECT * FROM tbl_user WHERE `user_id`='$userid'");
        while ($ridedata = mysqli_fetch_array($fetchdata)) {
            if ($ridedata['isblock'] == '0') {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_user SET `isblock`='1' WHERE `user_id`='$userid'");
            } else {
                $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_user SET `isblock`='0' WHERE `user_id`='$userid'");
            }
            
        }
    }
    
    public function filter($filter, $order)
    {
       
        if ($filter == "" && $order == "") {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0'");
        } else if ($filter == 1 && $order == 1) {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2'");
        } else if ($filter == 'cab_type') {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `$filter`='$order'");
        } else {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY `$filter` $order");
            
        }
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
    }
    
    
    
    
    
    public function deleterideDetail($id)
    {
        $fetchUser = mysqli_query($this->dbh, "DELETE FROM tbl_ride  WHERE `ride_id`='$id'");
    }
    
    
    
    public function managelocation($filter, $order)
    {  
        
        if ($filter == "") {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_location");
        } else {

        if($filter != "name") {
            $filter = "cast(`$filter` AS unsigned)";
        }
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_location ORDER BY $filter $order");
        }
        
        if (mysqli_num_rows($fetchRides) > 0) {
            return $fetchRides;
        } else {
            return 0;
        }
        

    }
    
    
    
    public function locationavailability($locationid)
    {
        
        $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `id`= $locationid");
       
            while ($ridedata = @mysqli_fetch_array($fetchUser)) {
                if ($ridedata['is_available'] == '0') {
                    $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='1' WHERE `id`='$locationid'");
                } else {
                    $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='0' WHERE `id`='$locationid'");
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
        $total     = 0;
        $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_ride WHERE `status`='2'");
        while ($ridedata = mysqli_fetch_array($fetchUser)) {
            $total = $total + (int) $ridedata['total_fare'];
        }
        echo $total;
    }
    
    public function changepass($username, $current1, $new1, $confirm)
    {
        
        $current=md5($current1);
        
        $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_id`='$username' AND `password`='$current'");
        $check      = mysqli_fetch_assoc($userdetail);
        $result     = $userdetail->num_rows;
        if ($result == 1) {
            if ($new1 == $confirm) {
                $new=md5($new1);
                $update = mysqli_query($this->dbh, "UPDATE tbl_user SET `password`='$new' WHERE `user_id`='$username'");
                echo "<script>alert('Updated Successfully');</script>";
            } else {
                echo "<script>alert('Wrong Detail Entered Please Check And Try Again');</script>";
            }
        } else {
            echo "<script>alert('Wrong Detail Entered Please Cheack And Try Again');</script>";
        }
    }

    
}

?>
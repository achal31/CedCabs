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

/***********************************DASHBOARD  BEGINS****************************** */

    /*----------------FUNCTION FOR SHOWING THE DASHBOARD DETAILS--------------------*/
    public function dashboard($tile)
    {
        switch ($tile)
        {
            case 1:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='1'");break;
            case 2:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='2'");break;
            case 3:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`='1' and `is_admin`='1'");break;
            case 4:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`='0'");break;
            case 5:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE  `isblock`='0' and `is_admin`='1'");break;
            case 6:$fetchRides = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `is_available`='0'");break;
        }
        return mysqli_num_rows($fetchRides);

    }

        /*----------------------Function used to show the Total Earning ----------------*/
        public function totalearning()
        {
            $total = 0;
            $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_ride WHERE `status`='2'");
            if (mysqli_num_rows($fetchUser) > 0)
            {
                return $fetchUser;
            }
            else
            {
                return 0;
            }
        }
        
 /***********************************DASHBOARD  ENDS****************************** */   


/*****************************************USER PART BEGINS************************************* */    
/*--------------------SHOWING THE REQUESTED USER LIST BY THE ADMIN BLOCK,UNBLOCK,ADMIN--------------*/
    public function manageUser($status)
    {
        switch($status)
        { 
            case 0:case 1:{$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`=$status AND `is_admin`='1'");break;}
            case 2:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `is_admin`='1'");break;
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
/*-----------------SHOWING THE FILTERED LIST OF THE USER-----------------------*/
    public function filteruser($filter, $order, $request)
    {
        switch($request)
        {
            case 0:case 1:{$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `isblock`=$request and `is_admin`='1' ORDER BY $filter $order");break;}
            case 2:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_user WHERE `is_admin`='1' ORDER BY $filter $order");break;
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

/*-------------------FUNCTION TO UPDATE THE USER STATUS--------------------*/
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
/*********************************USER PART END************************************* */

/**********************************LOCATION PART BEGINS****************************** */

/*-------------Function is used to Display location to the user------------*/
public function managelocation($filter, $order)
{

   /*----------To Show Default List of Location-----------------*/
   if ($filter == "")
   {
       $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_location");
   }
   /*-------------To Show the Filter Location List----------------*/
   else
   {
       /*--------------------Converting The varchar to unsigned to sort data-------------*/
       if ($filter != "name")
       {
           $filter = "cast(`$filter` AS unsigned)";
       }
       $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_location ORDER BY $filter $order");
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
/*------------------Function used to available and unavailable the location-------------------*/
public function locationavailability($locationid)
{

    $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `id`= $locationid");

    while ($ridedata = @mysqli_fetch_array($fetchUser))
    {
        /*----------------------To change Location to Not Available---------------------*/
         $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='1' WHERE `id`='$locationid'");
        
        
    }

}
public function locationUnavailability($locationid)
{

    $fetchUser = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `id`= $locationid");

    while ($ridedata = @mysqli_fetch_array($fetchUser))
    {
        /*----------------------To change Location to Not Available---------------------*/
      
        
            $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `is_available`='0' WHERE `id`='$locationid'");
        }
    

}
/*---------------------Function To Delete the Location------------------------------*/
public function locationdelete($id)
{
    
    $fetchUser = mysqli_query($this->dbh, "DELETE FROM tbl_location  WHERE `id`='$id'");
}

/*---------------------Function To Add New Location----------------------------------*/
public function newlocation($name, $distance)
{  $name=trim($name); 
    
    $checkusername = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `name`='$name'");
    $result        = $checkusername->num_rows;
    if ($result == 0) {

    $fetchUser = mysqli_query($this->dbh, "INSERT INTO tbl_location (`name`,`distance`,`is_available`) VALUES('$name','$distance','0')");
    echo "<script>window.location.href='manageLocation.php'</script>";
    } else {
        echo "<script>alert('Location Name Already Exist');</script>"; 
    }
}

public function availablelocation($filter,$order)
{
    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `$filter`='$order'");
    if (mysqli_num_rows($fetchRides) > 0)
   {
       return $fetchRides;
   }
   else
   {
       return 0;
   }

}
 /*---------------------Function To Update Location----------------------------------*/
public function Updatelocation($id, $locationname, $distance,$availablility)
{

    $checkusername = mysqli_query($this->dbh, "SELECT * FROM tbl_location WHERE `name`='$locationname'");
    $result        = $checkusername->num_rows;
    if ($result == 1) {

    $fetchUser = mysqli_query($this->dbh, "UPDATE tbl_location SET `name`='$locationname' ,`distance`='$distance' ,`is_available`='$availablility' WHERE `id`='$id'");
    if($fetchUser)
    {
    echo "<script>window.location.href='manageLocation.php'</script>";
    }
    else {
        echo "<script>alert('Location Name Already Exist');</script>"; 
    }
}

}
/***********************************LOCATION PART END******************************** */


/************************************ALL RIDES PART START***************************** */

/*--------------Function To Filter the data by Ride Type and do sorting-----------*/
    public function ridefilter($status, $filter, $order)
    {
        /*--------------Filter The List On the Bases of Cab Type-------------------*/
        if ($filter == 'cab_type')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`=$status AND `$filter`='$order'");
        }
        /*-------------------Filter The Data on sorting methods---------------------*/
        else
        {
            $filter = "cast(`$filter` AS unsigned)";

            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`=$status ORDER BY $filter $order");
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
/*-------------------------------FILTER CAB ON BASES OF WEEKS AND DAYS---------------------------- */
    public function filteration($type, $list, $order, $status)
    {
        switch ($type)
        {
            case 1:
                $week = (substr($list, -2) - 1);
                if ($status == 3)
                {$fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE WEEK(`ride_date`)='$week'");
                }else{
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE WEEK(`ride_date`)='$week' AND `status`='$status'");
                }break;

            case 2:
                if ($status == 3)
                { 
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE  DATE(`ride_date`) BETWEEN '$list' AND '$order'");
                }else{
                    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM `tbl_ride` WHERE `status`='$status' AND  DATE(`ride_date`) BETWEEN '$list' AND '$order'");
                }break;

            case 3:$fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE  `status`=$status");break;
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
/*--------------------------TO ACCEPT AND DECLINE THE RIDE REQUEST--------------------------------------*/
    public function acceptRide($userid)
    {
        $fetchRides = mysqli_query($this->dbh, "UPDATE tbl_ride SET `status`='2' WHERE ride_id='$userid'");
        echo "<script>alert('The Ride Request Has Been Approved');</script>";
        echo "<script>window.location.href='rideRequest.php?status=1'</script>";
    }
    public function declineRide($userid)
    {
        $fetchRides = mysqli_query($this->dbh, "UPDATE tbl_ride SET `status`='0' WHERE ride_id='$userid'");
        echo "<script>alert('The Ride Request Has Been Declined');</script>";
        echo "<script>window.location.href='rideRequest.php?status=1'</script>";
    }


/*-----------------------------SORT THE LIST--------------------------------------------------------------*/
    public function filter($filter, $order, $type)
    {

        if ($type == "")
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0'");
        }
        else if ($filter == 'cab_type')
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `$filter`='$order' ");
        }
        else if ($filter == 1 && $order == 1)
        {
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2'");
        }
        else if ($type == '1')
        {
            $filter = "cast(`$filter` AS unsigned)";
            $fetchRides = mysqli_query($this->dbh, "SELECT * From tbl_ride WHERE `status`='2' OR `status`='0' ORDER BY $filter $order");

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

    /*---------------Function Used To Delete the Ride Details----------------------------*/
    public function deleterideDetail($id)
    {
        echo "<script>alert('The Ride Detail Has Been Deleted);</script>";
        $fetchUser = mysqli_query($this->dbh, "DELETE FROM tbl_ride  WHERE `ride_id`='$id'");
        
    }

 /********************************ALL RIDES PART END ****************************************/   


    /*-------------------------Function Used to update user information----------------*/
    public function changepass($username, $current1, $new1, $confirm)
    {

        $current = md5($current1);

        $userdetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_id`='$username' AND `password`='$current'");
        $check = mysqli_fetch_assoc($userdetail);
        $result = $userdetail->num_rows;
        if ($result == 1)
        { if($current1 != $new1)
            {
            if ($new1 == $confirm)
            {
                $new = md5($new1);
                $update = mysqli_query($this->dbh, "UPDATE tbl_user SET `password`='$new' WHERE `user_id`='$username'");
                echo "<script>alert('Updated Successfully');</script>";
                echo "<script>window.location.href='../logout.php'</script>";
            }
            else
            {
                echo "<script>alert('New Password And Confirm Password Field Doesnt match');</script>";
            }
        }
        else {
            echo "<script>alert('Already Used Password Is Not Allowed To Update');</script>";
        }
        }
        else
        {
            echo "<script>alert('Data Doesnt Match With Your Account');</script>";
        }
    }
public function checkname($userid)
{
    $fetchRides = mysqli_query($this->dbh, "SELECT * FROM tbl_user where `user_id`='$userid'"); 
    if (mysqli_num_rows($fetchRides) > 0)
    {
        return $fetchRides;
    }
    else
    {
        return 0;
    }
}
/***************************************END OF THE ADMIN CLASS********************************** */
public function fetchRidedates()
{
    $fetchUser = mysqli_query($this->dbh,"SELECT sum(total_fare) AS total, ride_date, count(ride_date) FROM `tbl_ride` WHERE `status` = 2 GROUP BY DATE(`ride_date`)");


if(mysqli_num_rows($fetchUser)>0){
return $fetchUser;
}
else {
    echo 0;
}
}
}
?>

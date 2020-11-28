<?php
// session_start();

include('config.php');
class DB_con
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
    
    public function registration($name, $fullname, $date, $number, $pass)
    {
        $checkusername = mysqli_query($this->dbh, "SELECT * FROM tbl_user WHERE `user_name`='$name'");
        $result        = $checkusername->num_rows;
        if ($result == 0) {
            $password     = md5($pass);
            $insertdetail = mysqli_query($this->dbh, "insert into tbl_user(`user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) values('$name','$fullname','$date','$number','0','$password','1')");
            if ($insertdetail) {
                echo "<script>alert('Registration successfull.');</script>";
                echo "<script>window.location.href='login.php'</script>";
            } else {
                echo "<script>alert('Error');</script>";
            }
        } else {
            echo "<script>alert('User name Already exist');</script>";
        }
    }
    
    public function signin($name, $pasword)
    {
        $password     = md5($pasword);
        $signindetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where user_name='$name' and Password='$password'");
        
        $userdata = mysqli_fetch_assoc($signindetail);
        $result   = $signindetail->num_rows;
        if ($result == 1) {
            $username   = $userdata['user_id'];
            $userstatus = $userdata['isblock'];
            $checkadmin = $userdata['is_admin'];
            if ($checkadmin == 0) {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = '0';
                echo "<script>window.location.href='adminfiles/adminpanel.php'</script>";
            } else {
                if ($userstatus == 1) {
                    $_SESSION['usertype'] = '1';
                    $_SESSION['username'] = $username;
                    echo "<script>window.location.href='userpanel.php'</script>";
                } else {
                    echo "<script>alert('Please Wait For Admin To Provide Access');</script>";
                }
            }
            
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    }
    public function location()
    {
        $fetchLocation = mysqli_query($this->dbh, "SELECT * From tbl_location WHERE `is_available`='0'");
        if (mysqli_num_rows($fetchLocation) > 0) {
            return $fetchLocation;
        }
    }
    
}

?>
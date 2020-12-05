<?php
// session_start();

include('config.php');
class dbfunction
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
    
    /*--------------------Function Used to Register user to the database--------------------------*/
    public function 
    registration($name, $fullname, $date, $number, $pass)
    {   $name=trim($name);
        $name=strtolower($name);
        $fullname=trim($fullname);
        $checkusername = mysqli_query($this->dbh, "SELECT * FROM tbl_user WHERE `user_name`='$name'");
        $result        = $checkusername->num_rows;
        if ($result == 0) {
            $password     = md5($pass);
            $insertdetail = mysqli_query($this->dbh, "INSERT into tbl_user (`user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) values('$name','$fullname','$date','$number','0','$password','1')");
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
    
    /*---------------------Function Used to Sign In The User to the website-----------------------*/
    public function signin($name, $pasword,$remember)
    {
        $password     = md5($pasword);
        $signindetail = mysqli_query($this->dbh, "SELECT * FROM tbl_user where  user_name='$name' and Password='$password'");
        
        $userdata = mysqli_fetch_assoc($signindetail);
        $result   = $signindetail->num_rows;
        if ($result == 1) {
            $userid=$userdata['name'];
            $username   = $userdata['user_id'];
            $userstatus = $userdata['isblock'];
            $checkadmin = $userdata['is_admin'];

            /*----------Check Whether User is an admin-----------------*/
            if ($checkadmin == 0) {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = '0';
                echo "<script>window.location.href='adminfiles/adminpanel.php'</script>";
            } else {

                /*--------------Condition to Check whether it is user--------------*/
                if ($userstatus == 1) {
                    $_SESSION['userid']=$userid;
                    $_SESSION['usertype'] = '1';
                    $_SESSION['username'] = $username;

                    /*-------------Condition To Save Cookies--------------------*/
                    if($remember!="")
                    {
                        setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));  
                    }
                    else if($remember!='on'){
                        if(isset($_COOKIE["member_login"]))  
                        {
                            {  
                            setcookie ("member_login","");  
                            }  
                        }
                    }
                    
                    if(isset($_SESSION['userdata']))
                    {
                        if((time()-$_SESSION['userdata']['time'])>180){
                            unset($_SESSION['userdata']);
                            header("Location:index.php");
                        } else {
                            header("Location:confirmBooking.php");
                        }
                        
                    }
                    else{
                        echo "<script>window.location.href='userDashboard.php'</script>";
                    }
                    
                } else {
                    echo "<script>alert('Please Wait For Admin To Provide Access');</script>";
                }
            }
            
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    }

    /*-------------------Function to fetch the available location on the landing page----------------------*/
    public function location()
    { 
        $fetchLocation = mysqli_query($this->dbh, "SELECT * From tbl_location WHERE `is_available`='0'");
        if (mysqli_num_rows($fetchLocation) > 0) {
            return $fetchLocation;
        }
    }
    
}

?>
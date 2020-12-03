<!--------------LOGIN PAGE ---------------------------->
<?php
include('header.php');
include_once('function.php');
// Object creation
$userdata = new dbfunction();
if (isset($_POST['login'])) {
    // Posted Values
    $name    = $_POST['name'];
    $pasword = ($_POST['password']);
    if(isset($_POST['remember']))
    {
      /*-----------Condition When User Set To Remember the Cookies------------*/
  $remember=$_POST['remember'];
  $sql     = $userdata->signin($name, $pasword, $remember);
    }
    else{
      /*-----------Condition When User Dont Want To Remember the Cookies------------*/
      $sql     = $userdata->signin($name, $pasword, "");
    }
  
   
    
}
?>

<div id="loginpage">
<div id="wrapper">
    <h2 id="registerheading">USER LOGIN</h2>
    <form id="register" method="post" action="login.php">
        
        <p>
            <input type="text" name="name" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; }?>" placeholder="Enter The User Name" class="detail" required>
        </p>
        
        <p>
           <input type="password" name="password"  placeholder="Enter The Password" class="detail" id="password" required>
        </p>
      
        <p>
            <input type="checkbox" onclick="myFunction()">Show Password
            <input type="checkbox" name="remember">Remember
        </p>      

        <p>
        <input type="submit" name="login" value="Login" class="detailbutton"> 
 
        <a href="register.php" class="linkbutton">Create An Account</a> 
        </p>
        
        
        
</form>
</div>
</div>
<?php include('footer.php'); ?>
<script>
    function myFunction(id) {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}

</script>

<?php
include ('header.php');


?>
<!------------------------Form Container--------------------------->
<div class="background-overlay">
        <div class="row">

            <!------------------Headings------------------------------->
            <div class="col-sm-2 col-md-2 col-lg-2"></div>
            <div class="col-sm-8 col-md-8 col-lg-8 text-center text-white py-5">
                <h1>Book a City Taxi to your Destination in your Town
                </h1>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2"></div>

            <div class="col-sm-3 col-md-3 col-lg-3"></div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-center text-white ">
                <h4>Choose from a range of categories and prices</h4>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3"></div>

            <div class="col-sm-1 col-md-1 col-lg-1"></div>

            <!----------------Form-------------------->
            <div class="col-sm-10 col-md-10 col-lg-10">



                <form id="detailform" method="POST" action="confirmBooking.php">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 my-2">
                                <form>
                                <!----------PickUp Location------------->
                                <select class="form-control" id="pickup" name="pickup" required>
                                    <option value="" disabled selected>Select The Pick Up Location</option>
                                    <?php
include_once ('function.php');
$location = new dbfunction();
$sql = $location->location();
foreach ($sql as $locationdata)
{
?>
                                       <option value="<?php
    echo $locationdata['name'];
?>"><?php
    echo $locationdata['name'];
?></option>
                                        <?php
}
?>
                                       
                                        </select>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 my-2">
                                <!----------Drop Location------------->
                                <select class="form-control" id="drop" name="drop" required>
`                                   <option value="" disabled selected>Select The Drop Location</option>
                                <?php
include_once ('function.php');
$location = new dbfunction();
$sql = $location->location();
foreach ($sql as $locationdata)
{
?>
                                       <option value="<?php
    echo $locationdata['name'];
?>"><?php
    echo $locationdata['name'];
?></option>
                                        <?php
}
?>
                                       
        </select>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 my-2">
                                <!--------------Cab Type----------------->
                                <select class="form-control" id="cabtype" name="cabtype" required>
        <option value="" disabled selected>Select A Cab</option>
        <option value="CedMicro">CedMicro</option>
        <option value="CedMini">CedMini</option>
        <option value="CedRoyal">CedRoyal</option>
        <option value="CedSUV">CedSUV</option>
        </select>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 my-2">
                                <!-----------Field For Getting the Weight------->
                                <input type="text" class="form-control" placeholder="Enter the weight in kg" id="weight" name="weight" required>
                            </div>

                            <div class="col-lg-4"></div>
                            </div>
                            <div class="row">
                            <div class="col-sm-6 col-md-12 col-lg-4 my-4">
                               
                                <lable id="getfaredetail"><h4>Total Calculated Fare:</h4></lable>
                              <input type="text" class="form-control" id="getfare">
                              <input type="hidden" class="form-control" id="getfar" name="getfa">
                            </div>


                            <div class="col-sm-6 col-md-12 col-lg-4 my-4">
                              <button type="button" class="btn btn-info form-control" id="submit">Calculate Fare</button>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-4 my-4">
                              <button type="submit" class="btn btn-info form-control" name="book" id="book">Book Cab</button>
                            </div>
                            </form>

                            </div>
                    </div>
                </form>
                

            </div>

            
        </div>
    </div>

    <!--------Icon Container------------>
    <div id="icon">
        <div class="container">
            <div class="row icon">
                <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                    <p><i class='far fa-calendar-alt' style='font-size:28px; color:#e7b94f;'></i>
                        <h5>Easy Bookings</h5>
                        <p>I'm a textbox.Double click me to edit,The text or the change the way i look</p>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                    <p><i class='fas fa-dollar-sign' style='font-size:28px; color:#e7b94f;'></i>
                        <h5>Best Price Guaranteed</h5>
                        <p>I'm a textbox.Double click me to edit,The text or the change the way i look</p>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                    <p><i class='fas fa-home' style='font-size:28px; color:#e7b94f;'></i>
                        <h5>Home Pickups</h5>
                        <p>I'm a textbox.Double click me to edit,The text or the change the way i look</p>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                    <p><i class='fas fa-users' style='font-size:28px; color:#e7b94f;'></i>
                        <h5>24/7 Customer Care</h5>
                        <p>I'm a textbox.Double click me to edit,The text or the change the way i look</p>
                </div>
            </div>
        </div>
    </div>

    <!---------Contact Us Container------->
    <div id="contactus">
        <div class="container py-3">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                    <h2>CALL US 24/7</h2>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                    <h2>1-800-200-300</h2>
                </div>
            </div>
        </div>
    </div>

    <div id=pad></div>
   <?php include ('footer.php'); ?>

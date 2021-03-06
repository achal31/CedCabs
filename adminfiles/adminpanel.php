<?php
if (!isset($_SESSION)) {
    session_start();
    
}

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
} else if ($_SESSION['usertype'] == '1') {
    header("location:../userDashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminpanel.php">
                <div class="sidebar-brand-text mx-3"> <img class="navbar-brand" src="../Screenshot.png" width="100%"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="adminpanel.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Requests
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-taxi"></i>
                    <span>Manager Rides</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ride Request</h6>
                        <a class="collapse-item" href="rideRequest.php?status=1">Pending Rides</a>
                        <a class="collapse-item" href="rideRequest.php?status=2">Complete Rides</a>
                        <a class="collapse-item" href="rideRequest.php?status=0">Cancel Rides</a>
                        <a class="collapse-item" href="pastRides.php">All Rides</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-bell"></i>
                    <span>Manager Requests</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Requests</h6>
                        <a class="collapse-item" href="manageUser.php?request=0">Block User</a>
                        <a class="collapse-item" href="manageUser.php?request=1">Unblock User</a>
                        <a class="collapse-item" href="manageUser.php?request=2">All User</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Locations
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-map-marker"></i>
                    <span>Manage Location</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="manageLocation.php">Location List</a>
                        <a class="collapse-item" href="addLocation.php">Add Locations</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
               Invoice
            </div>
            <li class="nav-item">
                <a class="nav-link" href="printInvoice.php?status=2">
                    <i class="fa fa-print"></i>
                    <span>Print Invoice</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
               Account Settings
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="changepass.php">
                    <i class="fa fa-cogs"></i>
                    <span>Change Password</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fa fa-times"></i>
                    <span>Log out</span></a>
            </li>
          

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->




        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <h3 class="m-0 font-weight-bold text-primary">WELCOME,ADMIN</h3>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">DASHBOARD</h4>
                        </div>

                    <!-- Content Row -->
                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Total)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹<?php

/*-------------------------Showing Total Earning To The User----------------------*/
include_once('admin.php');
$total=0;
$userdata = new admin();
$sql=$userdata->totalearning();
if($sql=='0')
{
    echo "No Data Available";
}
else {
foreach($sql as $result)
{
$total=$total+(int)$result['total_fare'];
}
echo $total;
}




?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-inr fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <a class="collapse-item" href="manageUser.php?request=1">User(Active)</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="activeuser">
                                            
                                            <?php
/*-----------------------TO SHOW THE COUNT OF THE UNBLOCK USER-----------------------------*/
$sql      = $userdata->dashboard('3');
echo $sql;
echo "<input type='text' value='$sql' id='unblockuser' hidden>";
?>
                                           </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            <a class="collapse-item" href="manageUser.php?request=0">USER(BLOCK)</a>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" ><?php
/*-----------------------TO SHOW THE COUNT OF THE BLOCK USER-----------------------------*/
$sql      = $userdata->dashboard('5');
echo $sql;
echo "<input type='text' value='$sql' id='blockuser' hidden>";
?></div>
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                              Cancelled Rides</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

/*-----------------------TO SHOW THE COUNT OF THE CANCELLED RIDES-----------------------------*/
$sql      = $userdata->dashboard('4');
echo $sql;
echo "<input type='text' value='$sql' id='cancelled' hidden>";
?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            <a class="collapse-item" href="rideRequest.php?status=2">Complete Rides</a>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php

/*-----------------------TO SHOW THE COUNT OF THE COMPLETED RIDES-----------------------------*/
$sql      = $userdata->dashboard('2');
echo $sql;
echo "<input type='text' value='$sql' id='completed' hidden>";
?></div>
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            <a class="collapse-item" href="rideRequest.php?status=1">Pending Rides</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

/*-----------------------TO SHOW THE COUNT OF THE PENDING RIDES-----------------------------*/
$sql      = $userdata->dashboard('1');
echo $sql;
echo "<input type='text' value='$sql' id='pending' hidden>";
?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            <a class="collapse-item" href="manageLocation.php">Total Service Locations</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php

/*-----------------------TO SHOW THE COUNT OF THE TOTAL SERVICE LOCATION-----------------------------*/
$sql      = $userdata->dashboard('6');
echo $sql;

?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-map-marker fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php 
$sql      = $userdata->fetchRidedates('6');
$rideDate = [];
$totalEarning = [];
foreach($sql as $eachride) {
$rideDate[] = $eachride['ride_date'];
$totalEarning[] = $eachride['total'];
}
?>

<div id="chart" style="width:80%;"> <canvas id="myChart"></canvas></div>
                        <!-----------------------TO SHOW THE PIE CHART----------------------------->
                        <div id="piechart" onload="drawChart()"></div>
                        <div id="RIDERS"></div>
                       
                       
                        
                    </div>




                    <!-- Content Row -->



                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                               <span>Copyright &copy; Designed By Achal</span>

                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var ride_dates = <?php echo json_encode($rideDate); ?>;
    var ride_earning = <?php echo json_encode($totalEarning); ?>;
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ride_dates ,
        datasets: [{
            label: 'Total Earning with Respect to Date',
            backgroundColor: 'rgb(56, 95, 207, 0.6)',
            borderColor: 'rgb(255, 255, 255)',
            data: ride_earning
        }]
    },

    // Configuration options go here
    options: {}
});

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var active = parseInt(document.getElementById("unblockuser").value);
    var block = parseInt(document.getElementById("blockuser").value);
    var data = google.visualization.arrayToDataTable([
        ['USERS', 'TYPE'],
        ['ACTIVEUSER', active],
        ['BLOCKEDUSER', block],
    ]);

    var options = { 'title': 'USER DATA', 'width': 425, 'height': 300 };


    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(ride);

function ride() {
    var cancelled = parseInt(document.getElementById("cancelled").value);
    var completed = parseInt(document.getElementById("completed").value);
    var pending = parseInt(document.getElementById("pending").value);
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['CANCELLED RIDES', cancelled],
        ['COMPLETED RIDES', completed],
        ['PENDING RIDES', pending]
    ]);

    var options = { 'title': 'RIDE DATA', 'width': 425, 'height': 300 };


    var chart = new google.visualization.PieChart(document.getElementById('RIDERS'));
    chart.draw(data, options);
}
</script>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

            
</body>

</html>
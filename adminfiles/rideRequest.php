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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link  href="style.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="file.js"></script>


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
<li class="nav-item ">
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
<li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-taxi"
></i>
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
        <i class="fa fa-bell"
></i>
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
        <i class="fa fa-map-marker"
></i>
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
        <i class="fa fa-print"
></i>
        <span>Print Invoice</span></a>
</li>

<hr class="sidebar-divider">
<div class="sidebar-heading">
   Account Settings
</div>
<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="changepass.php">
        <i class="fa fa-cogs"
></i>
        <span>Change Password</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
<a class="nav-link" href="../logout.php">
        <i class="fa fa-times"
></i>
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
        <!-- End of Sidebar -->

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
                    <div class="card shadow mb-4">
                    <div id="filtermenu">
<ul id="filter">
<button class="triggerbtn" id="distance1">SORT BY DISTANCE</button>
<button class="triggerbtn" id="fare1">SORT BY FARE</button>
<button class="triggerbtn" id="cab1">FILTER BY CAB</button>
<button class="triggerbtn" id="date1">FILTER BY DATES</button>
<button class="triggerbtn" id="week1">FILTER BY WEEK</button>
<button class="triggerbtn"><a href="rideRequest.php?status=<?php if(isset($_GET['status'])){ echo $_GET['status']; } ?>">CLEAN FILTER</a></button>
<div id="distance" class="hide">
<li><a id="distanceasc" href="rideRequest.php?id=distance&inner=distanceasc&filter=total_distance&order=ASC&status=<?php
if (isset($_GET['status'])) {
    echo $_GET['status'];
} else {
    echo "0";
}
?>">Ascending Order</a></li>
<li><a id="distancedsc" href="rideRequest.php?id=distance&inner=distancedsc&filter=total_distance&order=DESC&status=<?php
if (isset($_GET['status'])) {
    echo $_GET['status'];
} else {
    echo "0";
}
?>">Descending Order</a></li>
</div>

<div id="date" class="hide">
<form method="GET" action="rideRequest.php">
<input type="date" name="date1" id="dateone" required >
<input type="date" name="date2" id="datetwo" required >
<input type="submit" name="filterdate" value="Filter" class="triggerbtn">
<input value="<?php if (isset($_GET['status'])){ echo $_GET['status'];}?>" name="status" type="hidden">
</form>
</div>

<div id="week" class="hide">
<form method="GET" action="rideRequest.php">
<input type="week" name="week" id="weekend" required>
<input type="submit" name="filterweek" value="Filter" class="triggerbtn">
<input value="<?php if (isset($_GET['status'])){ echo $_GET['status'];}?>" name="status" type="hidden">
</form>
</div>

<div id="fare" class="hide">

<li>
    <a id="faredsc" href="rideRequest.php?id=fare&inner=faredsc&filter=total_fare&order=ASC&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">Ascending Order</a>
</li>

<li>
    <a id="fareasc" href="rideRequest.php?id=fare&inner=fareasc&filter=total_fare&order=DESC&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">Descending Order</a>
</li>

</div>


<div id="cab" class="hide">

<li>
    <a id="mini" href="rideRequest.php?id=cab&inner=mini&filter=cab_type&order=CedMini&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">CabMini</a>
</li>

<li>
    <a id="micro" href="rideRequest.php?id=cab&inner=micro&filter=cab_type&order=CedMicro&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">CabMicro</a>
</li>

<li>
    <a id="royal" href="rideRequest.php?id=cab&inner=royal&filter=cab_type&order=CedRoyal&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">CabRoyal</a>
</li>

<li>
    <a id="suv" href="rideRequest.php?id=cab&inner=suv&filter=cab_type&order=CedSUV&status=<?php if (isset($_GET['status'])) { echo $_GET['status']; } ?>">CabSUV</a>
</li>

</div>

</ul> 
    </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">RIDES</h6>
                        </div>
                        <?php
include_once('admin.php');
if (isset($_GET['rideid'])) {
    if (isset($_GET['approve'])) {
        
        $userdata = new admin();
        $userdata->acceptRide($_GET['rideid']);
     
    } else if (isset($_GET['decline'])) {
        
        $userdata = new admin();
        $userdata->declineRide($_GET['rideid']);
       
    }
}
?>
<?php
if (isset($_GET['status'])) {
    
    $i     = 1;
    $total = 0;
    $html  = "";
    $html .= "<table class='table table-bordered' width='100%'' cellspacing='0'><thead>";
    $html .= "<form><tr>";
    $html .= "<th>S.No</th>";
    $html .= "<th>Ride Date</th>";
    $html .= "<th>Pick Up</th>";
    $html .= "<th>Drop</th>";
    $html .= "<th>Cab Type</th>";
    $html .= "<th>Total Distance</th>";
    $html .= "<th>Luguage</th>";
    $html .= "<th>Total Fare</th>";
    $html .= "<th colspan='2' >Status</th>";
    $html .= "</tr></thead><tbody>";
    if (isset($_GET['week'])) {
        $previousrides = new admin();
        $sql           = $previousrides->filteration(1,$_GET['week'],"",$_GET['status']);
     }
     else if (isset($_GET['date1'])) {
        $previousrides = new admin();
        $sql           = $previousrides->filteration(2,$_GET['date1'], $_GET['date2'],$_GET['status']);
    }else if (isset($_GET['filter'])) {
        $userdata = new admin();
        $sql      = $userdata->ridefilter($_GET['status'], $_GET['filter'], $_GET['order']);
    } else {
        $userdata = new admin();
        $sql      = $userdata->filteration(3,"","",$_GET['status']);
    }
    
    if ($sql == '0') {
        echo "<h2>No Data Available</h2>";
    } else {
        
        
        foreach ($sql as $result) {
            
            $html .= "<tr>";
            $html .= "<td>$i</td>";
            $html .= "<td>$result[ride_date]</td>";
            $html .= "<td>$result[tripstart]</td>";
            $html .= "<td>$result[tripend]</td>";
            $html .= "<td>$result[cab_type]</td>";
            $html .= "<td>$result[total_distance] KM</td>";
            $html .= "<td>$result[luggage] KG</td>";
            $html .= "<td>₹$result[total_fare]</td>";
            if ($result['status'] == 0) {
                $html .= "<td>Cancelled</td>";
            } else if ($result['status'] == 1) {
                $html .= "<td><a onClick=\"javascript: return confirm('Please confirm if You Want to Approve');\" class='link' href='rideRequest.php?rideid=$result[ride_id]&approve=1&status=2'>Approve</a><a onClick=\"javascript: return confirm('Please confirm if you want to Decline');\" href='rideRequest.php?rideid=$result[ride_id]&decline=1&status=0'  class='link'>Decline</a></td>";
            } else {
                $html .= "<td>Completed</td>";
            }
            
            $html .= "</tr>";
            $i++;
        }
        $html .= "</tbody></form></table>";
        
        echo $html;
    }
    
}


?>

</div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>
<script>

    $(document).ready(function(){
        <?php if(isset($_GET['id']))
        {?>
        $("#<?php echo $_GET['id']?>").show();
        $("#<?php echo $_GET['inner']?>").css("cssText", "color: red !important;",);
       
        <?php } else {
            if(isset($_GET['date1'])) {?>
              $("#date").show();
            $("#dateone").val("<?php echo $_GET['date1']; ?>");
            $("#datetwo").val("<?php echo $_GET['date2']; ?>");
            <?php } else if(isset($_GET['week'])){?>
                $("#week").show();
                $("#weekend").val("<?php echo $_GET['week']; ?>");
            <?php } } ?>
    })
</script>

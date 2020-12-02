<?php
if (!isset($_SESSION)) {
    session_start();
    
}

if (!isset($_SESSION['username'])) {
    header('location:../unauthorisedUser.php');
} else if ($_SESSION['usertype'] == '1') {
    header("../userpanel.php");
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   
    <!-- Custom styles for this template-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="script.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
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
        <i class="fas fa-fw fa-cog"></i>
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
        <i class="fas fa-fw fa-wrench"></i>
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
        <i class="fas fa-fw fa-folder"></i>
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
    <a class="nav-link" href="printInvoice.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Print Invoice</span></a>
</li>

<hr class="sidebar-divider">
<div class="sidebar-heading">
   Account Settings
</div>
<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="changepass.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Change Password</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
<a class="nav-link" href="../logout.php">
        <i class="fas fa-fw fa-table"></i>
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
        <!-- Main Content -->
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
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" disabled>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
    </button>
                </div>
            </div>
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
    <div id="filtermenu">
<ul id="filter">
<button data-toggle="collapse" data-target="#name" class="triggerbtn">SORT BY NAME</button>
<button data-toggle="collapse" data-target="#distance" class="triggerbtn">SORT BY DISTANCE</button>


<div id="name" class="collapse">
<li><a href="manageLocation.php?filter=name&order=ASC">Ascending Order</a></li>
<li><a href="manageLocation.php?filter=name&order=DESC">Descending Order</a></li>
</div>
<div id="distance" class="collapse">
<li><a href="manageLocation.php?filter=distance&order=ASC">Ascending Order</a></li>
<li><a href="manageLocation.php?filter=distance&order=DESC">Descending Order</a></li>
</div>
</ul> 
    </div>
        <!-- Page Heading -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Location List</h6>
                        </div>
        
        <?php
include_once('admin.php');
if (isset($_GET['id'])) {
    if (isset($_GET['availability']) == 1) {
        $userdata = new admin();
        $userdata->locationavailability($_GET['id']);
    } else if (isset($_GET['delete']) == 1) {
        $userdata = new admin();
        $userdata->locationdelete($_GET['id']);
    }
}
?>
 <div class="card-body">
<div class="table-responsive">
    <?php
include_once('admin.php');

if (isset($_GET['filter'])) {
    $userdata = new admin();
    $sql      = $userdata->managelocation($_GET['filter'], $_GET['order']);
} else {
    $userdata = new admin();
    $sql      = $userdata->managelocation("", "");
}
if ($sql == '0') {
    echo "<h2>NO DATA AVAILABLE</h2>";
} else {
    $i    = 1;
    $html = "";
    $html .= "<table class='table table-bordered' width='100%'' cellspacing='0'><thead>";
    $html .= "<tr>";
    $html .= "<th>S.No</th>";
    $html .= "<th>Location</th>";
    $html .= "<th>Distance</th>";
    $html .= "<th>Status</th>";
    $html .= "<th>Available/Unavailable</th>";
    $html .= "<th>Delete</th>";
    $html .= "<th>Edit</th>";
    $html .= "</tr></thead><tbody>";
    foreach ($sql as $result) {
        $html .= "<tr>";
        $html .= "<td>$i</td>";
        $html .= "<td>$result[name]</td>";
        $html .= "<td>$result[distance]</td>";
        if ($result['is_available'] == 0) {
            $html .= "<td>Available</td>";
        } else {
            $html .= "<td>Unavailable</td>";
        }
        $html .= "<td><a href='manageLocation.php?id=$result[id]&availability=1' class='link'>Available/Unavailable</a></td>";
        $html .= "<td><a href='manageLocation.php?id=$result[id]&delete=1' class='link'>Delete</a></td>";
        $html .= "<td><a href='addLocation.php?id=$result[id]&edit=1&name=$result[name]&distance=$result[distance]' class='link'>Edit</a></td>";
        $html .= "</tr>";
        $i++;
    }
    $html .= "</tbody></table>";
    echo $html;
}
?>
</div>
 </div>  
</div>
        
</div>

</div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
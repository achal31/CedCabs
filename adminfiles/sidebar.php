

<div class="sidebar-container">
  <div class="sidebar-logo">
   <img src="../Screenshot.png" width="150" height="80">
  </div>
  <ul class="sidebar-navigation">
  <button data-toggle="collapse" data-target="#user" class="toggle">Manage Users</button>
  <div id="user" class="collapse">
    <li>
      <a href="manageUser.php?request=0">
        <i class="fas fa-align-justify" aria-hidden="true"></i> Pending Request
      </a>
    </li>
    <li>
      <a href="manageUser.php?request=1">
        <i class="fas fa-align-justify" aria-hidden="true"></i> Approved Request
      </a>
    </li>
    <li>
      <a href="manageUser.php?request=2">
        <i class="fas fa-align-justify" aria-hidden="true"></i> All Request
      </a>
    </li>
    </div>
    <button data-toggle="collapse" data-target="#ride" class="toggle">Manage Rides</button>
    <div id="ride" class="collapse">
    <li>
      <a href="rideRequest.php?status=1">
        <i class="fas fa-info-circle" aria-hidden="true"></i> Pending Rides
      </a>
    </li>
    <li>
      <a href="rideRequest.php?status=2">
        <i class="fas fa-info-circle" aria-hidden="true"></i> Completed Rides
      </a>
    </li>
    <li>
      <a href="rideRequest.php?status=0">
        <i class="fas fa-info-circle" aria-hidden="true"></i> Cancelled Rides
      </a>
    </li>
    <li>
      <a href="pastRides.php">
        <i class="fas fa-info-circle" aria-hidden="true"></i> All Rides
      </a>
    </li>
    </div>
    <button data-toggle="collapse" data-target="#location" class="toggle">Manage Locations</button>
    <div id="location" class="collapse">
    <li>
      <a href="manageLocation.php">
        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>Location List
      </a>
    </li>
    <li>
      <a href="addLocation.php">
        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>Add Location
      </a>
    </li>
    </div>
    <li>
      <a href="totalEarning.php">
        <i class="fas fa-dollar-sign" aria-hidden="true"></i> Manage Earnings
      </a>
    </li>
    <li>
      <a href="../login.php">
        <i class="fa fa-info-circle" aria-hidden="true"></i> Logout
      </a>
    </li>
  </ul>
</div>

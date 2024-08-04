<?php
// Check if the user is logged in
// if (!isset($_SESSION['isadmin'])) {
//   header('Location: login.php');
//   exit();
// }
require("header.php");
require("navbar.php");
require("sidebar.php");
require("core.php");
include("connection.php");

// Fetch the number of users and properties
$user_count_query = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = mysqli_query($db_conn, $user_count_query);
$user_count_row = mysqli_fetch_assoc($user_count_result);
$user_count = $user_count_row['user_count'];

$property_count_query = "SELECT COUNT(*) as property_count FROM properties";
$property_count_result = mysqli_query($db_conn, $property_count_query);
$property_count_row = mysqli_fetch_assoc($property_count_result);
$property_count = $property_count_row['property_count'];

?>
<style>
  .col-sm-6{
    width: 500px;
    
  }
</style>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">admin dashboard</h6>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add User</a>
            </div> -->
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category admin-wel">Welcome Admin</p>
                                    <h4 class="card-title">Tip:check the database</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <h4 class="card-title"><?php echo $user_count; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Properties</p>
                                    <h4 class="card-title"><?php echo $property_count; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Removed the Visitors and Sales Cards -->
        </div>
    </div>
</div>
</body>
</html>
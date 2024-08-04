<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="#" class="logo">
        <img src="../images/logo.png" alt="navbar brand" class="navbar-brand" height="45" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <!-- catagory dashboard -->
        <li class="nav-item active">
          <a data-bs-toggle="" href="#dashboard" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <a href="dashboard.php">Dashboard</a>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="dashboard">
            <ul class="nav nav-collapse">

            </ul>
          </div>
        </li>
        <!-- end of catagory dashboard -->
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section"> 
          <a href="../index.php">Home</a>
          </h4>

        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">
            <a href="logout.php">Logout</a>
          </h4>
        </li>

        <li class="nav-item active">
          <a data-bs-toggle="collapse" href="#database" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Database</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="database">
            <ul class="nav nav-collapse">
              <li>
                <a href="database.php">
                  <span class="sub-item">database</span>
                </a>
              </li>
              <!-- <li>
                <a href="charts.php">
                  <span class="sub-item">Charts</span>
                </a>
              </li> -->
              <li>
                <a href="property_db.php">
                  <span class="sub-item">properties</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->
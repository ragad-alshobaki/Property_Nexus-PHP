<style>
  .logout-dang {
    color: red;
  }

  /* Default styles for the list item */
  .nav-section {
    padding: 10px;
    transition: background-color 0.3s ease;
  }

  /* Style when hovering over the list item */
  .nav-section:hover {
    background-color: gray;
  }

  /* Style when the list item is active (focused) */
  .nav-section.active {
    background-color: darkgray;
    /* You can choose a different color if you prefer */
  }

  /* Ensure the link text color remains visible */
  .nav-section a {
    color: #fff;
    /* Change to whatever color you prefer */
    text-decoration: none;
  }
</style>
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
          <a href="dashboard.php">Dashboard</a>
          </a>
          <div class="collapse" id="dashboard">
            <ul class="nav nav-collapse">

            </ul>
          </div>
        </li>
        <!-- end of catagory dashboard -->
        <li class="nav-section" id="homeButton">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">
            <a href="../index.php">Home</a>
          </h4>
        </li>
        <li class="nav-section" id="homeButton">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">
          <a href="database.php">Users</a>
          </h4>
        </li>

        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">
            <a href="property_db.php">Properties</a>

          </h4>
          
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">
            <a href="logout.php" class="logout-dang">Logout</a>
          </h4>
        </li>





      </ul>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get all nav-section elements
    const navItems = document.querySelectorAll('.nav-section');

    // Add click event listeners to each nav item
    navItems.forEach(item => {
      item.addEventListener('click', function() {
        // Remove 'active' class from all nav items
        navItems.forEach(nav => nav.classList.remove('active'));

        // Add 'active' class to the clicked nav item
        this.classList.add('active');
      });
    });
  });
</script>
<!-- End Sidebar -->
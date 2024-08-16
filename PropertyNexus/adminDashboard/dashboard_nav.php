<?php
@session_start();
?>
<style>
/* Navbar styling */
.navbar {
    background-color: #333;
    padding: 10px 20px;
}

.navbar .navbar-nav .nav-item .nav-link {
    color: #fff;
    margin-right: 15px;
}

.navbar .navbar-nav .nav-item .nav-link:hover {
    color: #ff6347; /* Tomato color for hover */
}

/* Profile dropdown styling */
.profile-username {
    position: relative;
    display: inline-block;
    cursor: pointer;
    color: #fff;
    font-weight: bold;
}

.admin-list {
    display: none;
    position: absolute;
    background-color: #fff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    padding: 0;
    z-index: 10000;
    list-style: none;
    margin: 0;
    border-radius: 5px;
    min-width: 160px;
    right: 0;
    top: 40px;
}

/* Dropdown item styling */
.admin-list li {
    border-bottom: 1px solid #ddd;
    margin: 0; /* Remove any margin */
}

.admin-list li:last-child {
    border-bottom: none;
}

.admin-list li a {
    color: #333;
    text-decoration: none;
    padding: 10px 20px;
    display: block;
    font-size: 14px;
}

.admin-list li a:hover {
    background-color: #ff6347; /* Tomato color for hover */
    color: #fff;
    border-radius: 5px;
}

.navbar .profile-icon {
    font-size: 20px;
    margin-right: 5px;
    color: #ff6347;
}
</style>

<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="profile-username" id="profileUsername">
                        <i class="fas fa-user-circle profile-icon"></i> <!-- FontAwesome icon -->
                        <span>Admin</span>
                        <ul class="admin-list" id="adminList">
                            <li><a href="../include/profile.php">Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
// Toggle dropdown visibility
document.getElementById('profileUsername').addEventListener('click', function() {
    var adminList = document.getElementById('adminList');
    adminList.style.display = adminList.style.display === 'block' ? 'none' : 'block';
});

// Close dropdown when clicking outside
window.addEventListener('click', function(event) {
    if (!event.target.closest('.profile-username')) {
        var adminList = document.getElementById('adminList');
        if (adminList.style.display === 'block') {
            adminList.style.display = 'none';
        }
    }
});
</script>

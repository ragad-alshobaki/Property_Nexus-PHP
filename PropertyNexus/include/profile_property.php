<?php
session_start(); // Start the session

@define("HOST", "localhost");
@define("USER", "root");
@define("PW", "");
@define("DB", "PropertyNexus");

$db_conn = new mysqli(HOST, USER, PW, DB);

// Check connection
if ($db_conn->connect_error) {
    die("<b>Connection failed:</b> " . $db_conn->connect_error);
}

$rec = null; // Initialize $rec
$userID = isset($_SESSION['userID']) ? intval($_SESSION['userID']) : null; // Get userID from session

if ($userID) {
    // Prepare statement to prevent SQL injection
    $select_stmt = $db_conn->prepare("SELECT * FROM users WHERE userID = ?");
    $select_stmt->bind_param("i", $userID);
    $select_stmt->execute();
    $select_r = $select_stmt->get_result();

    if ($select_r->num_rows > 0) {
        $rec = $select_r->fetch_assoc();
    } else {
        die("User not found");
    }
    $select_stmt->close();
} else {
    die("No user ID in session");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/profile.css">
    <style>
        .profile img{
            width: 80px;
            height: 80px;
        }
        table {
            margin-top: 50px;
        }

        .profile img{
            width: 80px;
            height: 80px;
        }
         /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
}

.sidebar {
    width: 350px;
    background-color: #333;
    color: white;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    height: 800px;
}

.logo h2 {
    margin: 0;
    font-size: 1.5em;
}

.profile img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin:  0;
}

.nav ul {
    list-style: none;
    padding: 0;
}

.nav ul li {
    margin:  0;
}

.nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1.1em;
    display: block;
    padding: 10px;
    border-radius: 4px;
}

.nav ul li a:hover {
    background-color: #34495e;
}

.main-content {
    flex: 1;
}

.header h2 {
    margin: 0;
    font-size: 2em;
    color: #2c3e50;
}

.form-section {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
}

.form-group label {
    display: block;
    margin-bottom: 2px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-actions {
    text-align: right;
}

.btn {
    padding: 10px ;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1em;
}

.btn-success {
    background-color: #27ae60;
    color: white;
}

.btn-success:hover {
    background-color: #2ecc71;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
}

.btn-danger:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <!-- <h2>Property Nexus</h2> -->
                <img src="../images/new-logo.png" style="width: 190px;" alt="Logo">
            </div>
            <div class="profile">
                <?php 
                // echo " <img src='../{$rec['userImage']}' alt='No img' "; 
                ?>
            </div>
            <br>
            <br>
            <nav class="nav">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="profile_property.php">Property</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="header">
                <h2>Property</h2>
                <div class="profile-completion">
                </div>
            </header>
            <section>
                <table>
                    <thead>
                        <th>property Image</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>City</th>
                    </thead>
                    <tbody>
                        <?php 
                            $select_Q = "SELECT * FROM properties WHERE user_id = $userID";
                            $select_r = mysqli_query($db_conn, $select_Q);
                            $select_rCheck = mysqli_num_rows($select_r);
                            if ($select_rCheck > 0) {
                                while ($rec = mysqli_fetch_assoc($select_r)) {
                                echo "
                                    <tr>
                                        <td> <img src='../{$rec['p_image_url']}'style='width:150px;text-align: center;'> </td>
                                        <td> {$rec['p_title']} </td>
                                        <td> {$rec['p_type']} </td>
                                        <td> {$rec['p_price']} </td>
                                        <td> {$rec['p_description']} </td>
                                        <td> {$rec['p_city']} </td>
                                    </tr> ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
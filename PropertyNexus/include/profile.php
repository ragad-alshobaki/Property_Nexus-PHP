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
        header("Location: ../index.php"); // Redirect to index.php if user not found
        exit(); // Ensure that script execution stops after redirection
    }
    $select_stmt->close();
} else {
    header("Location: ../index.php"); // Redirect to index.php if no user ID in session
    exit(); // Ensure that script execution stops after redirection
}


// To update data
if (isset($_POST["updUser"]) && $userID !== null) {
    // Sanitize and prepare data for update
    $userFname = $_POST["uFname"];
    $userLname = $_POST["uLname"];
    $uPW = $_POST["u_pw"];
    $uEmail = $_POST["u_email"];
    $uAdress = $_POST["u_adress"];
    $uMobile = $_POST["u_mob"];

    // Prepare statement to prevent SQL injection
    $update_stmt = $db_conn->prepare("UPDATE users SET userFname = ?, userLname = ?, userAdress = ?, userPW = ?, userMobile = ?, userEmail = ? WHERE userID = ?");
    $update_stmt->bind_param("ssssssi", $userFname, $userLname, $uAdress, $uPW, $uMobile, $uEmail, $userID);

    if ($update_stmt->execute()) {
        echo '<script>alert("Update successfully!")</script>'; 
    } else {
        die("Update failed: " . $db_conn->error);
    }
    $update_stmt->close();
}

$db_conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/profile.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <style>
        .profile img{
            width: 80px;
            height: 80px;
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
    width: 290px;
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
    /* text-align: right; */
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
                <h2><b>Profile</b></h2>
                <div class="profile-completion">
                </div>
            </header>
            <section class="form-section">
                <form action="profile.php" method="post">
                    <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
                    <div class="form-group">
                        <label for="uFname">NAME</label>
                        <input type="text" id="name" name="uFname" placeholder="<?php echo htmlspecialchars($rec['userFname']); ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="uLname">USERNAME</label>
                        <input type="text" id="username" name="uLname" placeholder="<?php echo htmlspecialchars($rec['userLname']); ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="u_pw">CHANGE PASSWORD</label>
                        <input type="password" id="password" name="u_pw" placeholder="<?php echo htmlspecialchars($rec['userPW']); ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="u_email">E-MAIL</label>
                        <input type="email" id="email" name="u_email" placeholder="<?php echo htmlspecialchars($rec['userEmail']); ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="u_adress">ADDRESS</label>
                        <input type="text" id="location" name="u_adress" placeholder="<?php echo htmlspecialchars($rec['userAdress']); ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="u_mob">MOBILE</label>
                        <input type="text" name="u_mob" placeholder="<?php echo htmlspecialchars($rec['userMobile']); ?>"><br>
                    </div>
                    <div class="form-actions">
                        <!-- <input id="btn" type="submit" name="updUser" value="Save"> -->
                        <button type="submit" class="btn btn-success" name="updUser">Save</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>

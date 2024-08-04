<?php
session_start(); // Start the session

@define("HOST", "localhost");
@define("USER", "root");
@define("PW", "");
@define("DB", "PHP_project");

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
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Property Nexus</h2>
            </div>
            <div class="profile">
                <img src="" alt="Profile Picture" class="profile-pic">
                <h2>Team One</h2>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Property</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="header">
                <h2>Profile</h2>
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
                        <input type="submit" name="updUser" value="Save">
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>

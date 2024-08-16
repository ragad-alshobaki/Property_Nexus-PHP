<?php

session_start();
require_once("adminDashboard/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['uFname'];
    $lname = $_POST['uLname'];
    $password =$_POST['u_pw'];
    $email = $_POST['u_email'];
    $address = $_POST['u_adress'];
    $mobile = $_POST['u_mob'];

    $stmt = $db_conn->prepare("INSERT INTO users (userFname, userLname, userPW, userEmail, userAdress, userMobile, isAdmin) VALUES (?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssss", $fname, $lname, $password, $email, $address, $mobile);

    if ($stmt->execute()) {
        echo "Sign-up successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db_conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style/signupin.css">
</head>
<body>
    <div class="container">
        <div class="login-section">
            <h2>Signup</h2>
            <!-- <p>Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
            <form method="post" action="signup.php">
                <!-- <div class="nameCont"> -->
                    <label for="uFname">First Name:</label>
                    <input type="text" name="uFname" required>

                    <label for="uLname">Last Name:</label>
                    <input type="text" name="uLname" required>
                <!-- </div> -->
                <label for="u_pw">Password:</label>
                <input type="password" name="u_pw" required><br>

                <label for="u_email">Email:</label>
                <input type="email" name="u_email" required><br>

                <label for="u_adress">Address:</label>
                <input type="text" name="u_adress" required><br>

                <label for="u_mob">Mobile:</label>
                <input type="text" name="u_mob" required><br>

                <!-- <div class="remember-me"> -->
                    <!-- <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label> -->
                <!-- </div> -->
                <input type="submit" name="signup" value="Log In">
            </form>
        </div>
        <div class="image-section"></div>
    </div>
</body>
</html>


<?php
include("connection.php");

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['userID'])) {
    $userID = mysqli_real_escape_string($db_conn, $_POST['userID']);
    $userFname = mysqli_real_escape_string($db_conn, $_POST['userFname']);
    $userLname = mysqli_real_escape_string($db_conn, $_POST['userLname']);
    $userEmail = mysqli_real_escape_string($db_conn, $_POST['userEmail']);
    $userAdress = mysqli_real_escape_string($db_conn, $_POST['userAdress']);
    $userMobile = mysqli_real_escape_string($db_conn, $_POST['userMobile']);
    $userPW = mysqli_real_escape_string($db_conn, $_POST['userPW']);

    if (empty($fname) || empty($lname) || empty($email) || empty($mobile)) {
        echo "All fields except password are required.";
        exit();
    }

    $update_Q = "UPDATE users SET userFname = '$userFname', userLname = '$userLname', userAdress = '$userAdress', userEmail = '$userEmail', userMobile = '$userMobile'";
    if (!empty($pw)) {
        $update_Q .= ", userPW = '$userPW'";
    }
    $update_Q .= " WHERE userID = '$userID'";

    if (mysqli_query($db_conn, $update_Q)) {
        echo "User data has been updated successfully!";
    } else {
        echo "Query Failed: " . mysqli_error($db_conn);
    }
} else {
    echo "Invalid request.";
}
?>

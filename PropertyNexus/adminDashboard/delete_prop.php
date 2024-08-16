<?php
session_start(); // Make sure the session is started
include("connection.php");

if (isset($_POST['delete_property_id'])) {
    $p_ID = intval($_POST['delete_property_id']);
    
    // Check if user is owner or admin
    $stmt = $db_conn->prepare("SELECT user_id FROM properties WHERE p_ID = ?");
    $stmt->bind_param("i", $p_ID);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($_SESSION['userID'] === $user_id || $_SESSION['isAdmin'] == 1) {
        // Prepared statement to prevent SQL injection
        $stmt = $db_conn->prepare("DELETE FROM properties WHERE p_ID = ?");
        $stmt->bind_param("i", $p_ID);

        if ($stmt->execute()) {
            echo "Deleted successfully.";
        } else {
            echo "Can't delete! " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "You do not have permission to delete this property.";
    }

    $db_conn->close();
}
?>

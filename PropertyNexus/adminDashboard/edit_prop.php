<?php
include("connection.php");

// To fetch data
if (isset($_GET['p_ID'])) {
    $p_ID = $_GET['p_ID'];

    $select_Q = "SELECT * FROM properties WHERE p_ID = $p_ID";
    $select_r = mysqli_query($db_conn, $select_Q);
    if (!$select_r) {
        die("Query failed: " . mysqli_error($db_conn));
    } else {
        $rec = mysqli_fetch_assoc($select_r);
    }
}

// To update data
if (isset($_POST["updProp"])) {
    $p_ID = $_POST["p_ID"];
    $p_title = $_POST["p_title"];
    $p_price = $_POST["p_price"];
    $p_description = $_POST["p_description"];
    $p_city = $_POST["p_city"];
    $p_region = $_POST["p_region"];
    $p_floor = $_POST["p_floor"];
    $p_type = $_POST["p_type"];

    // Prepare and execute the update query
    $stmt = $db_conn->prepare("UPDATE properties SET p_title = ?, p_price = ?, p_description = ?, p_city = ?, p_region = ?, p_floor = ?, p_type = ? WHERE p_ID = ?");
    $stmt->bind_param("sssssssi", $p_title, $p_price, $p_description, $p_city, $p_region, $p_floor, $p_type, $p_ID);

    if ($stmt->execute()) {
        echo '<script>alert("Update successfully!")</script>';
    } else {
        die("Update failed: " . $stmt->error);
    }

    $stmt->close();
    $db_conn->close();
}
?>

<form action="edit_prop.php" method="post" enctype="multipart/form-data">
    <!-- Hidden field to pass the property ID -->
    <input type="hidden" name="p_ID" value="<?php echo htmlspecialchars($p_ID); ?>">

    <label for="p_title">Title:</label>
    <input type="text" name="p_title" value="<?php echo htmlspecialchars($rec['p_title']); ?>"><br>

    <label for="p_price">Price:</label>
    <input type="text" name="p_price" value="<?php echo htmlspecialchars($rec['p_price']); ?>"><br>

    <label for="p_description">Description:</label>
    <input type="text" name="p_description" value="<?php echo htmlspecialchars($rec['p_description']); ?>"><br>

    <label for="p_city">City:</label>
    <input type="text" name="p_city" value="<?php echo htmlspecialchars($rec['p_city']); ?>"><br>

    <label for="p_region">Region:</label>
    <input type="text" name="p_region" value="<?php echo htmlspecialchars($rec['p_region']); ?>"><br>

    <label for="p_floor">Floor:</label>
    <input type="text" name="p_floor" value="<?php echo htmlspecialchars($rec['p_floor']); ?>"><br>

    <label for="p_type">Type:</label>
    <input type="text" name="p_type" value="<?php echo htmlspecialchars($rec['p_type']); ?>"><br>

    <input type="submit" name="updProp" value="Save">
</form>

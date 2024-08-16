<?php
    // Database connection details
    require_once("dashboard_nav.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PropertyNexus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle new property addition
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_property'])) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $floor = $_POST['floor'];
        $image_url = $_POST['image_url'];
        $type = $_POST['type'];
        $user_id = $_POST['user_id']; // Assuming you're assigning a user to the property

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO properties (p_title, p_price, p_description, p_city, p_region, p_floor, p_image_url, p_type, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssisii", $title, $price, $description, $city, $region, $floor, $image_url, $type, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>Swal.fire('Added!', 'Property added successfully.', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Error!', 'Error adding property: " . $stmt->error . "', 'error');</script>";
        }

        // Close the statement
        $stmt->close();
    }

    // Delete property if delete request is made
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);

        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM properties WHERE p_ID = ?");
        $stmt->bind_param("i", $delete_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>Swal.fire('Deleted!', 'Property deleted successfully.', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Error!', 'Error deleting property: " . $stmt->error . "', 'error');</script>";
        }

        // Close the statement
        $stmt->close();
    }

    // Handle edit form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
        $edit_id = intval($_POST['edit_id']);
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $floor = $_POST['floor'];
        $image_url = $_POST['image_url'];
        $type = $_POST['type'];

        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE properties SET p_title = ?, p_price = ?, p_description = ?, p_city = ?, p_region = ?, p_floor = ?, p_image_url = ?, p_type = ? WHERE p_ID = ?");
        $stmt->bind_param("sisssisii", $title, $price, $description, $city, $region, $floor, $image_url, $type, $edit_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>Swal.fire('Updated!', 'Property updated successfully.', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Error!', 'Error updating property: " . $stmt->error . "', 'error');</script>";
        }

        // Close the statement
        $stmt->close();
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Property Management</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 20px;
            }

            .table-container {
                max-width: 1200px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
                font-size: 28px;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th, td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            .actions a {
                color: #007bff;
                text-decoration: none;
                margin-right: 10px;
            }

            .actions a:hover {
                text-decoration: underline;
            }

            .btn-add {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                margin-bottom: 20px;
                display: inline-block;
            }

            .btn-add:hover {
                background-color: #45a049;
            }

            /* Modal Styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
                border-radius: 10px;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .form-group input[type="text"],
            .form-group textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .form-group textarea {
                resize: vertical;
            }

            button[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>

    <div class="table-container">
        <h1>Property Management</h1>
        <button class="btn-add" id="addPropertyBtn">Add Property</button>
        
        <!-- Property List Table -->
        <?php
        // Fetch properties from the database
        $sql = "SELECT * FROM properties";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>City</th>
                            <th>Region</th>
                            <th>Floor</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            // Output data of each row
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td><img src='" . $row["p_image_url"] . "' alt='Property Image' style='width: 100px; height: auto;'></td>
            <td>" . $row["p_title"] . "</td>
            <td>" . $row["p_city"] . "</td>
            <td>" . $row["p_region"] . "</td>
            <td>" . $row["p_floor"] . "</td>
            <td>" . $row["p_description"] . "</td>
            <td>$" . $row["p_price"] . "</td>
            <td class='actions'>
                <a href='#' class='edit-btn' data-id='" . $row["p_ID"] . "'><i class='fas fa-edit'></i></a>
                <a href='?delete_id=" . $row["p_ID"] . "' onclick=\"return confirm('Are you sure you want to delete this property?')\"><i class='fas fa-trash-alt'></i></a>
            </td>
        </tr>";
}

            echo "</tbody></table>";
        } else {
            echo "<p>No properties found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Add Property Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Property</h2>
            <form method="post">
                <input type="hidden" name="new_property" value="1">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" placeholder="Enter price" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" placeholder="Enter description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" placeholder="Enter city" required>
                </div>
                <div class="form-group">
                    <label for="region">Region:</label>
                    <input type="text" name="region" id="region" placeholder="Enter region" required>
                </div>
                <div class="form-group">
                    <label for="floor">Floor:</label>
                    <input type="text" name="floor" id="floor" placeholder="Enter floor" required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label>
                    <input type="text" name="image_url" id="image_url" placeholder="Enter image URL" required>
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <input type="text" name="type" id="type" placeholder="Enter type" required>
                </div>
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" name="user_id" id="user_id" placeholder="Enter user ID" required>
                </div>
                <button type="submit">Add Property</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById("addPropertyBtn").onclick = function() {
        document.getElementById("addModal").style.display = "block";
    };

    document.querySelector(".close").onclick = function() {
        document.getElementById("addModal").style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == document.getElementById("addModal")) {
            document.getElementById("addModal").style.display = "none";
        }
    };
    </script>

    </body>
    </html>
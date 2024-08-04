<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete property if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM properties WHERE p_ID = ?");
    $stmt->bind_param("i", $delete_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Property deleted successfully.<br>";
    } else {
        echo "Error deleting property: " . $stmt->error . "<br>";
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
        echo "Property updated successfully.<br>";
    } else {
        echo "Error updating property: " . $stmt->error . "<br>";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Property Management</title>
    <style>
        /* Card styles */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 300px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card-content {
            padding: 16px;
        }
        .card-content h2 {
            font-size: 1.5em;
            margin: 0 0 10px 0;
        }
        .card-content p {
            margin: 0 0 10px 0;
            color: #555;
        }
        .card-content .price {
            font-size: 1.2em;
            color: #e74c3c;
            margin: 0 0 10px 0;
        }
        .card-actions {
            display: flex;
            justify-content: space-between;
            padding: 16px;
            background-color: #f9f9f9;
        }
        .card-actions a {
            text-decoration: none;
            color: #3498db;
            padding: 8px 16px;
            border: 1px solid #3498db;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .card-actions a:hover {
            background-color: #3498db;
            color: #fff;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
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
  

    </style>
</head>
<body>

<?php
// Fetch properties from the database
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-wrap: wrap;'>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>
                <img src='" . $row["p_image_url"] . "' alt='Property Image'>
                <div class='card-content'>
                    <h2>" . $row["p_title"] . "</h2>
                    <p>" . $row["p_city"] . "</p>
                    <p>" . $row["p_region"] . "</p>
                    <p>" . $row["p_floor"] . "</p>
                    <p>" . $row["p_description"] . "</p>
                    <p class='price'>$" . $row["p_price"] . "</p>
                </div>
                <div class='card-actions'>
                    <a href='#' class='edit-btn' data-id='" . $row["p_ID"] . "' data-title='" . $row["p_title"] . "' data-price='" . $row["p_price"] . "' data-description='" . $row["p_description"] . "' data-city='" . $row["p_city"] . "' data-region='" . $row["p_region"] . "' data-floor='" . $row["p_floor"] . "' data-image-url='" . $row["p_image_url"] . "' data-type='" . $row["p_type"] . "'>Edit</a>
                    <a href='?delete_id=" . $row["p_ID"] . "' onclick=\"return confirm('Are you sure you want to delete this property?');\">Delete</a>
                </div>
              </div>";
    }
    echo "</div>";
} else {
    echo "0 results";
}
?>

<!-- The Modal -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Property</h2>
    <form method="post" action="">
        <input type="hidden" name="edit_id" id="edit_id">
        Title: <input type="text" name="title" id="title"><br>
        Price: <input type="text" name="price" id="price"><br>
        Description: <input type="text" name="description" id="description"><br>
        City: <input type="text" name="city" id="city"><br>
        Region: <input type="text" name="region" id="region"><br>
        Floor: <input type="text" name="floor" id="floor"><br>
        Image URL: <input type="text" name="image_url" id="image_url"><br>
        Type: <input type="text" name="type" id="type"><br>
        <input type="submit" value="Update Property">
    </form>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("editModal");

// Get the button that opens the modal
var btns = document.getElementsByClassName("edit-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
for (let btn of btns) {
    btn.onclick = function() {
        document.getElementById('edit_id').value = this.getAttribute('data-id');
        document.getElementById('title').value = this.getAttribute('data-title');
        document.getElementById('price').value = this.getAttribute('data-price');
        document.getElementById('description').value = this.getAttribute('data-description');
        document.getElementById('city').value = this.getAttribute('data-city');
        document.getElementById('region').value = this.getAttribute('data-region');
        document.getElementById('floor').value = this.getAttribute('data-floor');
        document.getElementById('image_url').value = this.getAttribute('data-image-url');
        document.getElementById('type').value = this.getAttribute('data-type');
        modal.style.display = "block";
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>

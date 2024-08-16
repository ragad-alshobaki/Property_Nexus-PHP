
<?php

@session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

// Connect to the database
$db_conn = new mysqli($servername, $username, $password, $dbname);

if ($db_conn->connect_error) {
  die("Connection failed: " . $db_conn->connect_error);
}

// Handle property deletion
if (isset($_POST['delete_property_id'])) {
  if (!isset($_SESSION['userID'])) {
    die("You need to be logged in to delete a property.");
  }

  $property_id = intval($_POST['delete_property_id']);

  if ($property_id <= 0) {
    die("Invalid property ID.");
  }

  $stmt = $db_conn->prepare("SELECT user_id FROM properties WHERE p_ID = ?");
  $stmt->bind_param('i', $property_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    die("Property not found.");
  }

  $row = $result->fetch_assoc();

  if ($_SESSION['userID'] !== $row['user_id']) {
    die("You are not authorized to delete this property.");
  }

  $stmt = $db_conn->prepare("DELETE FROM properties WHERE p_ID = ?");
  $stmt->bind_param('i', $property_id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    header("Location: product.php?status=success");
    exit();
  } else {
    echo "Error deleting property.";
  }
}

// Handle property addition
if (isset($_POST['add_property'])) {
  if (!isset($_SESSION['userID'])) {
    die("You need to be logged in to add a property.");
  }

  $title = $_POST['p_title'];
  $price = $_POST['p_price'];
  $description = $_POST['p_description'];
  $city = $_POST['p_city'];
  $region = $_POST['p_region'];
  $floor = $_POST['p_floor'];
  $image_url = $_POST['p_image_url'];
  $type = $_POST['p_type'];

  $stmt = $db_conn->prepare("INSERT INTO properties (p_title, p_price, p_description, user_id, p_city, p_region, p_floor, p_image_url, p_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('sdsssisss', $title, $price, $description, $_SESSION['userID'], $city, $region, $floor, $image_url, $type);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    header("Location: product.php?status=success");
    exit();
  } else {
    echo "Error adding property.";
  }
}

// Search and filter properties
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$p_city = isset($_GET['city']) ? $_GET['city'] : '';
$p_region = isset($_GET['region']) ? $_GET['region'] : '';
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : PHP_INT_MAX;

$sql = "SELECT * FROM properties WHERE (p_title LIKE ? OR p_description LIKE ?)";
$params = ['ss', "%{$searchTerm}%", "%{$searchTerm}%"];

if ($p_city) {
  $sql .= " AND p_city = ?";
  $params[0] .= 's';
  $params[] = $p_city;
}

if ($p_region) {
  $sql .= " AND p_region = ?";
  $params[0] .= 's';
  $params[] = $p_region;
}

// if ($min_price) {
//   $sql .= " AND p_price >= ?";
//   $params[0] .= 'd';
//   $params[] = $min_price;
// }

if ($max_price) {
  $sql .= " AND p_price <= ?";
  $params[0] .= 'd';
  $params[] = $max_price;
}

$stmt = $db_conn->prepare($sql);
$stmt->bind_param(...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Real Estate Listings</title>
  <link rel="stylesheet" href="style/product.css">
</head>

<body>
  <div class="filter">
  <form action="product.php" method="get">
    <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search properties...">

    <select name="city" id="citySelect" onchange="updateRegions()">
        <option value="">Select City</option>
        <option value="Amman" <?php if ($p_city == 'Amman') echo 'selected'; ?>>Amman</option>
        <option value="Irbid" <?php if ($p_city == 'Irbid') echo 'selected'; ?>>Irbid</option>
        <option value="Al Zarqa" <?php if ($p_city == 'Al Zarqa') echo 'selected'; ?>>Al Zarqa</option>
        <option value="Al Karak" <?php if ($p_city == 'Al Karak') echo 'selected'; ?>>Al Karak</option>
        <option value="Maan" <?php if ($p_city == 'Maan') echo 'selected'; ?>>Maan</option>
        <option value="Al Tafilah" <?php if ($p_city == 'Al Tafilah') echo 'selected'; ?>>Al Tafilah</option>
        <option value="Aqaba" <?php if ($p_city == 'Aqaba') echo 'selected'; ?>>Aqaba</option>
        <option value="Al Balqaa" <?php if ($p_city == 'Al Balqaa') echo 'selected'; ?>>Al Balqaa</option>
        <option value="Ajloun" <?php if ($p_city == 'Ajloun') echo 'selected'; ?>>Ajloun</option>
        <option value="Al Mafraq" <?php if ($p_city == 'Al Mafraq') echo 'selected'; ?>>Al Mafraq</option>
        <option value="Jarash" <?php if ($p_city == 'Jarash') echo 'selected'; ?>>Jarash</option>
        <option value="Madaba" <?php if ($p_city == 'Madaba') echo 'selected'; ?>>Madaba</option>
    </select>

    <select name="region" id="regionSelect">
        <option value="">Select Region</option>
    </select>

    <input type="number" name="min_price" placeholder="Min Price" min="0" value="<?php echo htmlspecialchars($min_price); ?>">
    <input type="number" name="max_price" placeholder="Max Price" min="0" value="<?php echo htmlspecialchars($max_price); ?>">
    <div class="submit">
    <input type="submit" value="Search">
    <input type="submit" value="add property" class="add-btn">
    </div>
</form>



    <!-- <button id="addPropertyBtn"> -->
    <?
    // php if (!isset($_SESSION['userID'])): 
    ?>
    <!-- <a href="login.php" style="text-decoration: none; color: #000;">Add Property</a> -->
    <?php
    // else: 
    ?>
    <!-- Add Property -->
    <?php
    // endif; 
    ?>
    <!-- </button> -->
  </div>
  <div id="addPropertyModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Property</h2>
      <form action="product.php" method="post">
        <input type="hidden" name="add_property" value="1">
        <label for="p_title">Title:</label>
        <input type="text" id="p_title" name="p_title" required><br><br>
        <label for="p_price">Price:</label>
        <input type="number" id="p_price" name="p_price" step="0.01" required><br><br>
        <label for="p_description">Description:</label>
        <textarea id="p_description" name="p_description" required></textarea><br><br>
        <label for="p_city">City:</label>
        <input type="text" id="p_city" name="p_city" required><br><br>
        <label for="p_region">Region:</label>
        <input type="text" id="p_region" name="p_region" required><br><br>
        <label for="p_floor">Floor:</label>
        <input type="text" id="p_floor" name="p_floor"><br><br>
        <label for="p_image_url">Image URL:</label>
        <input type="text" id="p_image_url" name="p_image_url"><br><br>
        <label for="p_type">Type:</label>
        <input type="text" id="p_type" name="p_type"><br><br>
        <input type="submit" value="Add Property">
      </form>
    </div>
  </div>

  <!-- <div class="container_m">
    <?php if ($result->num_rows > 0) : ?> -->
      <?php while ($row = $result->fetch_assoc()) : ?>
        <!-- <div class="card">
          <img src="<?php echo htmlspecialchars($row['p_image_url']); ?>" alt="<?php echo htmlspecialchars($row['p_title']); ?>" onerror="this.src='images/placeholder.jpg';">
          <h2><?php echo htmlspecialchars($row['p_title']); ?></h2>
          <div class="rows-bt">
          <p class="city"><?php echo htmlspecialchars($row['p_city']); ?></p>
          <p class="region"><?php echo htmlspecialchars($row['p_region']); ?></p>
          </div>
          <!-- <p class="floor"><?php echo htmlspecialchars($row['p_floor']); ?> floor(s)</p> -->
          <!-- <p><?php echo htmlspecialchars($row['p_description']); ?></p> -->
          <!-- <p class="price">$<?php echo htmlspecialchars(number_format($row['p_price'], 2)); ?></p> -->
          <!-- <button class="see_more_btn"><a style="color:white" href="index4.php?p_ID=<?php echo htmlspecialchars($row['p_ID']); ?>" class="see_more_btn">See More</a></button> -->
        <!-- <div class="pearent"> -->
           <div class="container_m">
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="card_m">
                <div class="image-container">
                    <img 
                        src="<?php echo htmlspecialchars($row['p_image_url']); ?>" 
                        alt="<?php echo htmlspecialchars($row['p_title']); ?>" 
                        onerror="this.src='images/placeholder.jpg';"
                    >
                    <div class="overlay"></div>
                </div>
                <div class="content">
                    <div class="loc">
                        <p><?php echo htmlspecialchars($row['p_title']); ?></p>
                        <p class="city"><?php echo htmlspecialchars($row['p_city']); ?></p>
                        <p class="region"><?php echo htmlspecialchars($row['p_region']); ?></p>
                    </div>
                    <p><?php echo htmlspecialchars($row['p_description']); ?></p>
                    <p class="price">$<?php echo htmlspecialchars(number_format($row['p_price'], 2)); ?></p>
                    <a class="see_more_btn" href="index4.php?p_ID=<?php echo urlencode($row['p_ID']); ?>">See More</a>
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] === $row['user_id']) : ?>
                        <form action="product.php" method="post" onsubmit="return confirm('Are you sure you want to delete this property?');">
                            <input type="hidden" name="delete_property_id" value="<?php echo htmlspecialchars($row['p_ID']); ?>">
                            <input type="submit" value="Delete">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No properties found.</p>
    <?php endif; ?>
</div>

          <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] === $row['user_id']) : ?>
            <form action="product.php" method="post" onsubmit="return confirm('Are you sure you want to delete this property?');">
              <input type="hidden" name="delete_property_id" value="<?php echo htmlspecialchars($row['p_ID']); ?>">
              <input type="submit" value="Delete">
            </form>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    <?php else : ?>
      <p>No results found</p>

  </div>
<?php endif; ?>
</div>

<?php
$stmt->close();
$db_conn->close();
?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const citySelect = document.getElementById('citySelect');
    const regionSelect = document.getElementById('regionSelect');

    const cityRegions = {
      "Amman": ["Downtown", "Jubeiha", "Abdali", "Shmeisani", "Marj Al-Hamam", "Rabiyeh", "Khalda", "Jabal Al-Hussein"],
      "Irbid": ["University District", "City Center", "Al-Sabaila", "Al-Mazra'a", "Al-Hassan Industrial Estate", "Al-Balad", "Al-Hora"],
      "Al Zarqa": ["Al-Hashemi", "Al-Muwaqqar", "City Center", "Al-Rifa'i", "Al-Sabah", "Al-Yarmouk"],
      "Al Karak": ["City Center", "Al-Masharef", "Al-Munira", "Al-Najma", "Al-Husn"],
      "Maan": ["City Center", "Al-Hijra", "Al-Mu'tah", "Al-Qaser", "Al-Jafr"],
      "Al Tafilah": ["City Center", "Al-Qasr", "Al-Sharah", "Al-Hasa", "Al-Mufaqar"],
      "Aqaba": ["City Center", "Al-Nuzha", "Al-Shatt", "Ayla", "Al-Maqa'abah"],
      "Al Balqaa": ["City Center", "Salt", "Dair Alla", "Russeifa", "Al-Muwaqqar"],
      "Ajloun": ["City Center", "Al-Sarhan", "Al-Husseini", "Al-Qasab", "Al-Shari'"],
      "Al Mafraq": ["City Center", "Al-Mafraq", "Ruins of Al-Athar", "Al-Jarash"],
      "Jarash": ["City Center", "Al-Jaba", "Al-Mukhayyam", "Al-Bayader", "Al-Sabha"],
      "Madaba": ["City Center", "Al-Jouneh", "Al-Muhajirin", "Al-Baqa'a", "Al-Khader"]
    };

    function updateRegions() {
      const city = citySelect.value;
      const regions = cityRegions[city] || [];

      regionSelect.innerHTML = '<option value="">Select Region</option>';

      regions.forEach(function(region) {
        const option = document.createElement('option');
        option.value = region;
        option.textContent = region;
        regionSelect.appendChild(option);
      });
    }

    // Initialize regions on page load
    updateRegions();
    // Add event listener for city selection change
    citySelect.addEventListener('change', updateRegions);

    // Modal functionality
    const modal = document.getElementById("addPropertyModal");
    const btn = document.getElementById("addPropertyBtn");
    const span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      if (btn.querySelector('a')) {
        window.location.href = 'login.php';
      } else {
        modal.style.display = "block";
      }
    }

    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    }
  });
</script>

</body>

</html>
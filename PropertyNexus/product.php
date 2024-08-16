<?php
include './include/top.php';
include './include/nav.php';
?>

<?php
@session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "propertynexus";

// Connect to the database
$db_conn = new mysqli($servername, $username, $password, $dbname);

if ($db_conn->connect_error) {
  die("Connection failed: " . $db_conn->connect_error);
}

// Search and filter properties
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$p_city = isset($_GET['city']) ? $_GET['city'] : '';
$p_region = isset($_GET['region']) ? $_GET['region'] : '';
// $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
$p_type = isset($_GET['type']) ? $_GET['type'] : '';

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

if ($p_type) {
  $sql .= " AND p_type = ?";
  $params[0] .= 's';
  $params[] = $p_type;
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
  <link rel="stylesheet" href="style/product_new_style.css">
  <style>
    /* Filter bar styling */
.filter {
    padding: 10px ;
    border: 2px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    margin-top: 80px; /* Ensure it starts below the navbar */
}

.filter form {
    display: flex;
    /* flex-wrap: wrap; */
    flex-direction: row;
   /* Increased spacing between form elements */
}

/* Custom styles for input fields */
.filter input[type="text"],
.filter input[type="number"] {
    flex: 1;
    min-width: 200px;
    padding: 9px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.filter input[type="text"]::placeholder,
.filter input[type="number"]::placeholder {
    color: #aaa;
}

.filter input[type="text"]:focus,
.filter input[type="number"]:focus {
    border-color: #811bfd;
    box-shadow: 0 0 4px rgba(129, 37, 255, 0.3);
    outline: none;
}

/* Custom styles for select dropdowns */
.filter select {
    flex: 1;
    min-width: 200px;
    padding: 9px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    appearance: none; /* Remove default dropdown arrow */
    position: relative; /* Position relative to place custom arrow */
}

/* Custom dropdown arrow */
.filter select::after {
    content: '\25BC'; /* Unicode character for dropdown arrow */
    font-size: 16px;
    color: #555;
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none; /* Prevents the arrow from blocking clicks */
}

/* Custom styles for focus on select */
.filter select:focus {
    border-color: #dddddd;
    box-shadow: 0 0 4px rgba(129, 37, 255, 0.3);
    outline: none;
}

/* Style for submit button */
.filter input[type="submit"] {
    padding: 12px ;
    border: none;
    border-radius: 8px;
    background-color: #525151;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.filter input[type="submit"]:hover {
    background-color: #959595;
}

/* Container for the entire set of cards */
.container_m {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Create 3 equal-width columns */
    gap: 20px; /* Space between cards */
    padding: 20px;
    justify-content: center;
}

/* Style for each card */
.card_m {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    display: flex;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
}

.card_m:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Image container to hold the image */
.image-container {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-container .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.image-container:hover .overlay {
    opacity: 1;
}

/* Content area within the card */
.content {
    padding: 15px;
}

.loc {
    margin-bottom: 10px;
}

.loc p {
    margin: 0;
}

.city, .region {
    font-size: 0.9em;
    color: #555;
}

.price {
    font-weight: bold;
    color: #e74c3c;
    margin: 10px 0;
}

.see_more_btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #d4d4d4;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.see_more_btn:hover {
    background-color: #5d15b5;
}

.no-properties {
    text-align: center;
    font-size: 1.2em;
    color: #777;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 20px auto;
}

/* Responsive styles */
@media (max-width: 1200px) {
    .container_m {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on medium screens */
    }
}

@media (max-width: 768px) {
    .container_m {
        grid-template-columns: 1fr; /* 1 column on small screens */
    }
    
    .filter form {
        flex-direction: column;
        align-items: stretch;
    }

    .filter input[type="text"],
    .filter input[type="number"],
    .filter select {
        min-width: 100%;
        margin-bottom: 10px;
    }

    .filter input[type="submit"] {
        width: 100%;
        padding: 15px;
        font-size: 16px;
    }
}
.title {
    color: #111827;
    font-size: 1.125rem;
    line-height: 1.75rem;
    font-weight: 600;
  }
  
  .desc {
    margin-top: 0.5rem;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.25rem;
  }
  
  .action {
    display: inline-flex;
    margin-top: 1rem;
    color: #ffffff;
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 500;
    align-items: center;
    gap: 0.25rem;
    background-color: #2563EB;
    padding:  8px;
    border-radius: 4px;
  }
  
  .action span {
    transition: .3s ease;
  }
  
  .action:hover span {
    transform: translateX(4px);
  }
  .content{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    align-self: center;
  }
@media (max-width: 480px) {
    .card_m {
        font-size: 0.9em; /* Smaller font size for very small screens */
    }
}
    /* General Container */
.container_m {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 columns of equal width */
  gap: 20px; /* Space between grid items */
  padding: 20px;
}

/* Card Style */
.card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: transform 0.3s ease;
}

.card:hover {
  transform: translateY(-10px);
}

/* Image Container */
.image-container {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Overlay Style */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card:hover .overlay {
  opacity: 1;
}

/* Content Style */
.content {
  padding: 15px;
  align-items: start;

}

/* Title Style */
.title {
  font-size: 1.2em;
  font-weight: bold;
  color: #333;
  text-decoration: none;
  display: block;
  align-items: start;

  margin-bottom: 10px;
}



.desc {
  font-size: 0.9em;
  align-items: start;

  color: #666;
  margin-bottom: 15px;
}

.action {
  display: inline-block;
  font-size: 0.9em;
  color: #ffffff;
  text-decoration: none;
  padding: 10px;
  border: 1px solid #007bff;
  border-radius: 4px;
  
  transition: background-color 0.3s ease, color 0.3s ease;
}

.action:hover {
  background-color: #2563EB;
  color: #ffffff;
}

.action span {
  font-size: 1.2em;
  margin-left: 5px;
  vertical-align: middle;
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
  .container_m {
    grid-template-columns: repeat(3, 1fr); /* 3 columns for medium screens */
  }
}

@media (max-width: 900px) {
  .container_m {
    grid-template-columns: repeat(2, 1fr); /* 2 columns for smaller screens */
  }
}

@media (max-width: 600px) {
  .container_m {
    grid-template-columns: 1fr; /* 1 column for mobile screens */
  }
}

  </style>
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
        <!-- Regions will be populated dynamically -->
      </select>

      <!-- <input type="number" name="min_price" placeholder="Min Price" min="0" value="<?php echo htmlspecialchars($min_price); ?>"> -->
      <input type="number" name="max_price" placeholder="Max Price" min="0" value="<?php echo htmlspecialchars($max_price); ?>">

      <select name="type">
        <option value="">Select Type</option>
        <option value="buy" <?php if ($p_type == 'buy') echo 'selected'; ?>>Buy</option>
        <option value="rent" <?php if ($p_type == 'rent') echo 'selected'; ?>>Rent</option>
      </select>

      <input type="submit" value="Search">
    </form>
  </div>

  <div class="container_m">
  <?php if ($result->num_rows > 0) : ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
      <div class="card">
        <div class="image-container">
          <img
            src="<?php echo htmlspecialchars($row['p_image_url']); ?>"
            alt="<?php echo htmlspecialchars($row['p_title']); ?>"
            onerror="this.src='images/placeholder.jpg';">
          <div class="overlay"></div>
        </div>
        <div class="content">
          <a href="#">
            <span class="title">
              <?php echo htmlspecialchars($row['p_title']); ?>
            </span>
          </a>
          <p class="desc">
            <?php echo htmlspecialchars($row['p_description']); ?>
          </p>
          <a class="action" href="index4.php?p_ID=<?php echo urlencode($row['p_ID']); ?>">
            see more
            <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
    

      <?php endwhile; ?>
    <?php else : ?>
      <p class="no-properties">No properties found.</p>
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
    });
  </script>

</body>

</html>

<?php
include 'include/footer.php';
include 'include/bottom.php';
?>
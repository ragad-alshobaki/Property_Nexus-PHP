  <!-- Slick Slider CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p_city, p_region, p_image_url FROM properties LIMIT 10";
$result = $conn->query($sql);

$slides = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $slides[] = $row;
    }
}
$conn->close();
?>
<section id="product-slider" class="sec2">
  <h2>Best offers</h2>
  <div class="slider">
    <?php foreach ($slides as $slide): ?>
      <div class="slide">
        <img src="<?php echo htmlspecialchars($slide['p_image_url']); ?>" alt="<?php echo htmlspecialchars($slide['p_city']); ?>">
        <div class="slide-info">
          <h3><?php echo htmlspecialchars($slide['p_city']); ?></h3>
          <h3><?php echo htmlspecialchars($slide['p_region']); ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <button class="slick-prev">&#10094;</button>
  <button class="slick-next">&#10095;</button>
</section>
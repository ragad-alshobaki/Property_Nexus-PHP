<!-- Slick Slider CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PropertyNexus";

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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/image-slider.css">
  <style>
  /* #sub h2::after{
    content: '';
    position: absolute;
    left: 50%;
    bottom: -15px;
    transform: translateX(-50%);
    width: 170px;
    height: 4px;
    background-color: #8f3fff;
    border-radius: 2px;
  } */
  </style>
  </head>
<body>
  

<section id="product-slider">
  <!-- <div id="sub">
    <h2>Browse property</h2>
  </div> -->
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
  <!-- <button class="slick-prev">&#10094;</button>
  <button class="slick-next">&#10095;</button> -->
</section>
</body>
</html>
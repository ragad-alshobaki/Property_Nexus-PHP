<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "propertynexus";

// Connect to the database
$db_conn = new mysqli($servername, $username, $password, $dbname);

if ($db_conn->connect_error) {
  die("Connection failed: " . $db_conn->connect_error);
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
        }
        .header {
            text-align: start;
        }
        .header h1 {
            margin: 0;
            font-size: 1.3em;
            color: black;
        }
        .header p {
            color: #777;
            font-size: 1.1em;
        }
        .rating {
            font-size: 24px;
            color: #FFD700;
            margin: 0;
            text-align: start;
        }
        .review {
            background-color: #FAFAFA;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px auto;
            max-width: 600px;
            text-align: start;
        }
        .review h3 {
            margin: 0;
            font-size: 1.1em;
            color: #333;
        }
        .review .date {
            color: #999;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .review .stars {
            color: #FFD700;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .review p {
            color: #555;
            text-align: start;
            line-height: 1.4;
            font-size: 15px;
        }
        .navigation {
            text-align: center;
            margin-top: 20px;
        }
        .navigation button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.3em;
            cursor: pointer;
            margin: 0 15px;
            border-radius: 100px;
        }
        .navigation button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }


        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
        }
        .header {
            text-align: start;
        }
        .header h1 {
            margin: 0;
            font-size: 1.3em;
            color: black;
        }
        .header p {
            color: #777;
            font-size: 1.1em;
        }
        .card-container {
            display: flex;
            overflow-x: auto;
            padding: 10px;
            gap: 15px; /* Space between cards */
        }
        .card {
            background-color: #FAFAFA;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            flex: 0 0 auto; /* Prevent cards from stretching */
            width: 18rem;
            min-width: 18rem; /* Ensures the card's width for scrolling */
        }
        .card-title {
            margin: 0;
            font-size: 1.1em;
            color: #333;
        }
        .card-subtitle {
            color: #999;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .stars {
            color: #FFD700;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .card-text {
            color: #555;
            line-height: 1.4;
            font-size: 15px;
        }
    </style>
</head>
<body>

<section id="Service" class="sec2">
<div id="testimonials">
<h2>Testomonials</h2>
</div>

<div class="card-container">

<?php
$sql = "SELECT users.userFname, testimonials.t_rating, testimonials.t_userReview, testimonials.created_at 
        FROM testimonials 
        JOIN users ON testimonials.userID = users.userID";

$result = $db_conn->query($sql);


$rCheck = mysqli_num_rows($result);
if ($rCheck > 0) {
    while ($rec = mysqli_fetch_assoc($result)) {
    echo "

        <div class='card' style='width: 18rem;text-align:left;'>
          <div class='card-body'>
                <h5 class='card-title'>{$rec['userFname']}</h5>
                <h6 class='card-subtitle mb-2 text-muted'>{$rec['created_at']}</h6>"; ?>
                <div class="stars">
                    <?php 
                        $rating = intval($rec['t_rating']);
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $rating) {
                                echo '<span class="star" style="color:#FFD369">&#9733;</span>'; // Filled star
                            } else {
                                echo '<span class="star" style="color:#FFD369">&#9734;</span>'; // Empty star
                            }
                        }   ?>
                </div>
                <?php
                    echo"
                        <p class='card-text'>{$rec['t_userReview']}</p>
          </div>
        </div>"; 
    }
}   ?>

</div>
</section>
</body>
</html>
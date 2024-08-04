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
          margin: 0;
            padding: 25px;
        }
        .header {
            text-align: start;
            /* margin-bottom: 20px; */
            
        }
        .header h1 {
            margin: 0;
            font-size: 1.3em;
            color:black;
            text-align: start;
        }
        .header p {
            color: #777;
            font-size: 1.1em;
            
        }
        .rating {
            font-size: 24px;
            color: #FFD700;
            margin: 0px 0;
            text-align: start;
        }
        .reviews {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin: 20px;
            padding-left: 80px;
          
        }
        .review {
            background-color: #FAFAFA;
          
            border-radius: 6px;
            flex: 1 1 calc(45% - 20px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            /* width: 50px;
            height: 190px; */
             padding: 30px;
             
             
        }
        .review:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
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
margin: 20px;

        }
    </style>
</head>
<body>
<section class="sec2">
    <div class="container">
        <div class="header">
            <h1>Best Property online service</h1>
            <!-- <p>Our customers say we are the best Property online delivery service </p> -->
            <div class="rating">4.8 ★★★★☆ (1160)</div>
        </div>
        <div class="reviews">
            
            <?php
                
                $reviews = [
                    ["name" => "Salameh yasin", "date" => "July 20 for Property nexus", "rating" => 5, "comment" => "Your apartments look very beautiful."],
                    ["name" => "Amro al-wageei", "date" => "July 18 for Property nexus", "rating" => 5, "comment" => "Highly responsive, trustworthy and on time."],
                    ["name" => "Hadeel alshahwan", "date" => "July 19 for Property nexus", "rating" => 5, "comment" => "I saved myself time when I entered the site."],
                    ["name" => "Moamen al-shoha", "date" => "July 15 for Property nexus", "rating" => 5, "comment" => "Good communication and the House look exactly like the photo!"]
                ];

                foreach ($reviews as $review) {
                    echo '<div class="review">';
                    echo '<h3>' . htmlspecialchars($review["name"]) . '</h3>';
                    echo '<div class="date">' . htmlspecialchars($review["date"]) . '</div>';
                    echo '<div class="stars">' . str_repeat('★', $review["rating"]) . str_repeat('☆', 5 - $review["rating"]) . '</div>';
                    echo '<p>' . htmlspecialchars($review["comment"]) . '</p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    </section>
</body>
</html>
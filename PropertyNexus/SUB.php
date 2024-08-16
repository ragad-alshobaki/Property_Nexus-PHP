<?php 
include './include/top.php';
include './include/nav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Nexus Profit Strategies</title>
    <!-- <link rel="stylesheet" href="style/SUB.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <style>
        /* Reset some default styles */
/* body, h1, p {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f4f4f4;
    color: #333;
} */

h1 {
    text-align: center;
    color: #444;
    margin-bottom: 60px;
}

.bro {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    margin: 70px;
    margin-bottom: 100px;
}

.card-container {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping of cards to new lines */
    gap: 20px; /* Space between cards */
    max-width: 100%; /* Ensure it fits within its parent container */
    margin: 0 auto;
    justify-content: center;
     /* Center cards horizontally */
     padding: 10px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 250px; /* Set fixed width for cards */
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

/* Icon styling within cards */
.card i {
    font-size: 3em;
    color: #811bfd;
    margin-bottom: 10px;
}

.card h3 {
    margin: 10px 0;
    font-size: 1.5em;
    color: #333;
}

.card p {
    font-size: 1em;
    color: #666;
}

.card .price {
    margin-top: 20px;
    font-size: 1.2em;
    font-weight: bold;
    color: #811bfd;
}

/* Card specific styles */
.card.basic {
    border-color: #811bfd;
}

.card.standard {
    border-color: #811bfd;
}

.card.featured {
    border-color: #811bfd;
}

.card.affiliate {
    border-color: #811bfd;
}

.card.training {
    border-color: #811bfd;
}

/* Hover effects */
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .card-container {
        flex-direction: column;
        align-items: center;
    }
}

    </style>
</head>
<body>
  
    <h1>property nexus premium</h1>
  
    <div class="bro">
    <div class="card-container">
       
        <div class="card basic">

            <i class="fas fa-dollar-sign"></i>
            <h3>Paid Subscriptions</h3>
            <p>Offer monthly or yearly subscription plans to users in exchange for additional features.</p>
            <div class="price">VIP</div>
        </div>
        <div class="card standard">
            <i class="fas fa-ad"></i>
            <h3>Advertisements</h3>
            <p>Display ads on the site through advertising programs such as Google AdSense.</p>
            <div class="price">VIP</div>
        </div>
  
        <div class="card featured">
            <i class="fas fa-star"></i>
            <h3>Featured Services</h3>
            <p>Providing premium services such as custom market analysis and property appraisal reports.</p>
            <div class="price">VIP</div>
        </div>
        <div class="card affiliate">
            <i class="fas fa-link"></i>
            <h3>Affiliate Marketing</h3>
            <p>Partnering with companies that provide real estate-related services and earn commissions.</p>
            <div class="price">VIP</div>
        </div>
        <!-- <div class="card training">
            <i class="fas fa-chalkboard-teacher"></i>
            <h3>Training & Consulting</h3>
            <p>Provide online courses or consultancy services in the field of real estate.</p>
            <div class="price">VIP</div>
        </div> -->
        <!-- <div class="card event">
            <i class="fas fa-calendar-alt"></i>
            <h3>Event Promotion</h3>
            <p>Organizing or promoting events and seminars related to real estate.</p>
            <div class="price">$39 only</div>
        </div> -->
    </div>
</div>
</body>
</html>
<?php include 'include/footer.php'; ?>

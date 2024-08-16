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

$property_id = isset($_GET['p_ID']) ? intval($_GET['p_ID']) : 0;

if ($property_id <= 0) {
    die("Invalid property ID.");
}

$stmt = $db_conn->prepare("SELECT * FROM properties WHERE p_ID = ?");
$stmt->bind_param('i', $property_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Property not found.");
}

$property = $result->fetch_assoc();

$stmt->close();
$db_conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($property['p_title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f9f9f9; */
            line-height: 1.6;
        }

        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 999;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
            

            
        }

        h1 {
            font-size: 2rem;
            margin: 0;
            color: #007BFF;
            text-align: center;
            margin: 10rem;
        }

        main {
            margin: 10rem;

            margin: 6rem auto;
            max-width: 1200px;
           background-color: #fff;
             border-radius: 12px; 
             /* border: 1px solid black; */
            
            /* box-shadow: 0 5px 6px rgba(0, 0, 0, 0.1); */
        }

        .measurement-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 1.5rem;
        }
        .main-img  {
            border-radius: 12px;
        }
        .main-img img {
            width: 100%;
  height: 100%;
  object-fit: cover;
        }

        .measurement-details {
            
            border-radius: 12px;
            padding: 1.5rem;
            text-align: left;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        }

        .measurement-details h2 {
            font-size: 1.75rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .measurement-details table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            /* border-radius: 8px; */
            overflow: hidden;
            padding: 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            
           
        }

        .measurement-details th, .measurement-details td {
            padding: 1rem;
            text-align: left;
        }

        .measurement-details th {
            /* background-color: #5d11ba; */
            color: #333;
            font-weight: 600;
        }

        .measurement-details tr:nth-child {
            background-color: #f9f9f9;
        }

        .icon {
            border-radius: 8px;
            border: none;
            background-color: #5d11ba;
            color: #fff;
            font-size: 16px;
            width: 50px;
            height: 50px;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        .icon a :hover{
            background-color: #5d11ba;
        }
    
    </style>
</head>
<body>
  
    <main>
        <div class="measurement-container">
            <div class="main-img">
                <img src="<?php echo htmlspecialchars($property['p_image_url']); ?>" alt="<?php echo htmlspecialchars($property['p_title']); ?>">
            </div>
            <div class="measurement-details">
                <h2><?php echo htmlspecialchars($property['p_title']); ?></h2>
                <p><?php echo htmlspecialchars($property['p_description']); ?></p>
                <br>
                <br>
                <table>
                    <tr>
                        <th>Price</th>
                        <td>$<?php echo htmlspecialchars(number_format($property['p_price'], 2)); ?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><?php echo htmlspecialchars($property['p_city']); ?></td>
                    </tr>
                    <tr>
                        <th>Region</th>
                        <td><?php echo htmlspecialchars($property['p_region']); ?></td>
                    </tr>
                    <tr>
                        <th>Floor</th>
                        <td><?php echo htmlspecialchars($property['p_floor']); ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo htmlspecialchars($property['p_type']); ?></td>
                    </tr>
                    <!-- <button class="icon"><i class="fa-solid fa-phone"></i></button> -->
                </table>
           
            </div>
           
        </div>
       
         
            <!-- <button class="icon"><i class="fa-solid fa-location-dot"></i></button> -->
            <!-- <button class="icon"><i class="fa-solid fa-paperclip"></i></button>  -->
            <!-- <button class="icon"><i class="fa-solid fa-comment"></i></button> -->
        </div>
    </main>
</body>
</html>
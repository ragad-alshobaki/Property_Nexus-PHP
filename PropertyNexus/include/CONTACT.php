<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Property Nexus</title>
    <link rel="stylesheet" href="contact.css"> -->
<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;

        color: #333;
        line-height: 1.6;
    }

    /* Contact Section */
    .contact {
        /* background: #f4f4f4; */
        padding: 70px;
        text-align: center;
        margin: 70px;
    }

    .contact h2 {
        color: #811bfd;
        margin-bottom: 30px;
    }

    .contact p {
        margin-bottom: 20px;
        color: #666;
        text-align: center;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .contact-item i {
        color: #811bfd;
        margin-right: 10px;
    }

    .contact-item p {
        margin: 0;
    }

    /* Cards Container */
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }

    .card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
        width: 200px;
        text-align: center;
    }

    .card h3 {
        margin-top: 0;
        color: #333;
    }

    .card p {
        color: #666;
        text-align: center;
    }

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

    /* Responsive Design */
    @media (max-width: 768px) {
        .contact-info {
            flex-direction: column;
        }

        .contact-item {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 480px) {
        .cards-container {
            flex-direction: column;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 300px;
        }
    }
</style>
</head>

<body>


    <section id="contact" class="sec2">
        <section class="contact">
            <div id="sub">

                <h2 id="sub">Contact Us</h2>
            </div>
            <p>If you have any inquiries, feel free to reach out to us through the following means:</p>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p><strong>Address:</strong> jordab,Amman,Aqaba</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <p><strong>Phone:</strong> +962 775624826</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <p><strong>Email:</strong> orange@gmail.com</p>
                </div>
            </div>
            <p>We are here to assist you!</p>
        </section>
        <!-- <div class="cards-container">
            <div class="card">
                <h3>Ragad</h3>
                <p>Disnger$Delovper</p>
            </div>
            <div class="card">
                <h3>Asal Alhawari</h3>
                <p>Disnger$Delovper</p>
            </div>
            <div class="card">
                <h3>Ala</h3>
                <p>Disnger$Delovper</p>
            </div>
            <div class="card">
                <h3>Yasmeen</h3>
                <p>Disnger$Delovper</p>
            </div>
            <div class="card">
                <h3>Mothana</h3>
                <p>Disnger$Delovper</p>
            </div> -->
        <!-- </div> -->
    </section>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
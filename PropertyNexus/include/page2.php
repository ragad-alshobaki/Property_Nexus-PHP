
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<style>
  /* page2.css */

  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
  }

  .parent_items {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 100px;

  }

  /* .item {

    width: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 12px gray;

    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    text-align: center;
    gap: 15px
  }

  .item img {
    width: 40%;
    border-radius: 8px;
  }

  .item h2 {
    margin-top: 20px;
    color: black;
  }

  .item p {
    font-size: 15px;
    color: #666;
    margin-top: 10px;
  }

  .crad-btn {
    width: 160px;
    height: 50px;
    border-radius: 5px;
    font-size: 15px;
    color: white;
    border: 1px solid rgb(0, 0, 0);

  }

  .crad-btn a {
    color: black;
    text-decoration: none;
  } */

  .back {
    width: 50px;
    height: 45px;
    margin-top: 5px;
    margin-left: 30px;
  }

  .back a {
    color: #000;
  }

  a .crad-btn {
    color: #000;
  }

  /* From Uiverse.io by SouravBandyopadhyay */
  .card-title {
    color: #262626;
    font-size: 1.5em;
    line-height: normal;
    font-weight: 700;
    margin-bottom: 0.5em;
  }

  .small-desc {
    font-size: 1em;
    font-weight: 400;
    line-height: 1.5em;
    color: #452c2c;
  }

  .small-desc {
    font-size: 1em;
  }

  .go-corner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: 2em;
    height: 2em;
    overflow: hidden;
    top: 0;
    right: 0;
    background-color: #526D82;
    border-radius: 0 4px 0 32px;
  }

  .go-arrow {
    margin-top: -4px;
    margin-right: -4px;
    color: white;
    font-family: courier, sans;
  }

  .card-2 {
    width: 350px;
    position: relative;
    background-color: white;
    border-radius: 10px;
    padding: 10px;
    text-decoration: none;
    z-index: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid grey;
    font-family: Arial, Helvetica, sans-serif;
display: flex;
align-items: center;
flex-direction: column;
justify-content: space-around;
  }

  .card-2:before {
    content: '';
    position: absolute;
    z-index: -1;
    top: -16px;
    right: -16px;
    background-color: #526D82;
    height: 52px;
    width: 52px;
    border-radius: 32px;
    transform: scale(1);
    transform-origin: 50% 50%;
    transition: transform 0.35s ease-out;
  }

  .card-2:hover:before {
    transform: scale(28);
  }

  .card-2:hover .small-desc {
    transition: all 0.5s ease-out;
    color: rgba(255, 255, 255, 0.8);
  }

  .card-2:hover .card-title {
    transition: all 0.5s ease-out;
    color: #ffffff;
  }

  .see-more {
    padding: 15px;
    font-size: 20px;
    color: rgb(0, 0, 0);
    border: 1px solid rgb(0, 0, 0);
    font-size: 16px;
  width: 150px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    color: #000000;
    text-align: center;
  }

  .see-more a {
    color: black;
    text-decoration: none;
  }

  /* .card-cont {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  } */
</style>

<body>
  <button class="back"><a href="../index.php"> <i class="fa-solid fa-arrow-left"></i></a> </button>
  <div class="parent_items">
    <div class="card-2">
        <div>
          <p class="card-title">Buy a home</p>
          <p class="small-desc">
            Find your place with an immersive photo experience and the most listings, including things you won’t find anywhere else.
          </p>
        </div>
        <div>
          <button class="see-more"><a href="product.php">see more</a></button>
        </div>
      </div>
    
    <div class="card-2">
     

        <div>
          <p class="card-title">Rent a home</p>
          <p class="small-desc">
            We’re creating a seamless online experience – from shopping on the largest rental network, to applying, to paying rent.</p>
        </div>
        <div>
          <button class="see-more"><a href="product.php">see more</a></button>
        </div>
  
     
    </div>
    <!-- <div class="card-2">
      
        <div>
          <p class="card-title"> Sell a home</p>
          <p class="small-desc">
            No matter what path you take to sell your home, we can help you navigate a successful sale.

          </p>
        </div>
        <div>
          <button class="see-more"><a href="../product.php">see more</a></button>
        </div>
     

     
    </div> -->
  
  
  </div>
</body>

</html>
<?php 
if(isset($_GET['page'])) {
    include  $_GET['page']; 
} else {
    include 'include/header.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/about.css">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    

    <title>Document</title>
</head>
<body>
<section class="about" id="about">


  <h1 class="heading"> <span>About</span> Us</h1>
  <div class="row">
    <div class="container">
      <div class="video-container">
        <video src="images/petshop_vid2.mp4" style="width: 100%; max-width: 800px; height: auto;" loop autoplay></video>
      </div>

      <div class="content">
        <h3 style="font-family: 'Arial', sans-serif;">Why Choose Us?</h3>
        <p style="font-family: 'Arial', sans-serif;">At Pet Match, we take great pride in being more than just a pet adoption center. We pride ourselves on being a reliable destination that provides a seamless experience for both adopting pets and supplying all the necessary items they need to thrive. When you choose us, you are selecting a company that is committed to promoting responsible pet ownership and ensuring the well-being of every animal that comes to our facility. Our staff takes great pride in selecting pets from reputable sources, ensuring their health and happiness before they find their forever homes. Furthermore, our wide range of high-quality food, toys, accessories, and other supplies ensures that you can easily and confidently locate all your necessities in one place. We value the special relationship between pets and their owners, and our top priority is to nurture that connection by providing exceptional customer service and continuous support. Welcome to Pet Match, where we combine convenience and expertise with a touch of love and care.</p>
        </div>
</div>
</div>

<div class ="middle">
      <div  class ="list">
    <h1 class ="offer"><br>At Pet Match, we offer:</h1>
    <br>
    <ul class ="service">
      <li style="font-size: 18px; margin-bottom: 10px;"><h4>- High-quality pet food and treats</h4></li><br>
      <li style="font-size: 18px; margin-bottom: 10px;"><h4>- A wide selection of pet toys and accessories</h4></li><br>
      <li style="font-size: 18px; margin-bottom: 10px;"><h4>- Safe and comfortable pet bedding</h4></li><br>
      <li style="font-size: 18px; margin-bottom: 10px;"><h4>- Grooming and hygiene products</h4></li><br>
      <li style="font-size: 18px; margin-bottom: 10px;"><h4>- Training and behavioral resources</h4></li><br>
    </ul>
  </div>
  
  <div class ="img">
    <img src="images/value_img.jpg" alt="Pet Match Store" style="max-width: 300px; height: auto; margin-top: 20px;">
  </div>
</div>




  
  <br>
    <h2 class="staff-heading">Meet Our Team</h2>
    <div class="staff-row">
        <div id="staff-section" class="staff-member">
            <img src="images/staff_img.jpg" alt="Staff 1">
            <p>Zahrah Aljanabi</p>
        </div>
        <div class="staff-member">
            <img src="images/staff4_img.jpg" alt="Staff 2">
            <p>Jood Naeem</p>
        </div>
        <div class="staff-member">
            <img src="images/staff2_img.jpg" alt="Staff 3">
            <p>Hams Almansori</p>
        </div>
        <div class="staff-member">
            <img src="images/staff3_img.jpg" alt="Staff 4">
            <p>Fatimah Almusharaf</p>
        </div>
        <div class="staff-member">
            <img src="images/staff1_img.jpg" alt="Staff 5">
            <p>Sultanah Alsudairy</p>
        </div>
    </div>
</section> 
    
</body>
</html>
<?php include 'include/footer.php'; ?>
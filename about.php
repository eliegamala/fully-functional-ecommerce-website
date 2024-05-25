<?php

include  'INCLUDES/connect.php';

//starting a new session
// Starting a new session if none exists
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

//check if the user id is set in the session
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>about</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/aboutStyles.css">


</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

   <div class="heading">
      <h2>about us</h2>
      <p><a href="index.php"> home</a> <span> / about</span></p>
    </div>


    <!--about section starts-->
    <section class="about">
        <div class="about-item">
            <h2>Why Shop With Us</h2>
            <p>We offer a wide selection of high-quality anime merchandise at competitive prices. Customer satisfaction is our top priority.</p>
            <a href="shop.php" class="hero-btn"> shop now</a>

          </div>

        <div class="about-item">
            <h2>Our Journey</h2>
            <p>Founded in 20XX, Anime Kingdom started as a small online store and has since grown into one of the leading retailers of anime products worldwide.</p>
        </div>

        <div class="about-item">
            <h2>Our Values</h2>
            <p>At Anime Kingdom, we believe in authenticity, quality, and customer service. We strive to provide the best shopping experience for anime fans.</p>
        </div>

        <div class="about-item">
            <h2>Our Environment</h2>
            <p>We are committed to sustainability and reducing our environmental footprint. Our packaging materials are eco-friendly, and we aim to minimize waste in our operations.</p>
        </div>

        <div class="about-item">
            <h2>Company News</h2>
            <p>Stay updated with the latest news, product releases, and promotions from Anime Kingdom.</p>
        </div>

        <div class="about-item">
            <h2>Charity</h2>
            <p>Supporting our community is important to us. A portion of our proceeds goes towards charitable organizations dedicated to anime education and cultural preservation.</p>
        </div>
    </section>
    
   <!--about section starts-->

  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>

    <!--footer section ends-->

  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
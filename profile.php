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
  header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profile</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/form-styles.css">


</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->



<!-- profile section starts-->

    
<section class="user-details">

<div class="user">
   <?php
      
   ?>
   <img src="images/user-icon.png" alt="">
   <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
   <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
   <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
   <a href="update_profile.php" class="hero-btn">update info</a>
   <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
   <a href="update_address.php" class="hero-btn">update address</a>
</div>

</section>

<!-- profile section end-->



  <!--footer section-->
   <?php
     include 'INCLUDES/footer2.php';
    ?>

    <!--footer section ends-->


  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
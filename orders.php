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
  <title>orders</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/checkoutStyles.css">
   <link rel="stylesheet" href="css/aboutStyles.css">



</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

<div class="heading">
      <h2>Orders</h2>
      <p><a href="index.html"> home</a> <span> / orders</p>
    </div>

<!--orders section startss-->

<section class="orders">
<div class="box-container">

<?php
   if($user_id == ''){
      echo '<p class="empty">please login to see your orders</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
<div class="box">
   <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
   <p>name : <span><?= $fetch_orders['name']; ?></span></p>
   <p>email : <span><?= $fetch_orders['email']; ?></span></p>
   <p>number : <span><?= $fetch_orders['number']; ?></span></p>
   <p>address : <span><?= $fetch_orders['address']; ?></span></p>
   <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
   <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
   <p>total price : <span>R<?= $fetch_orders['total_price']; ?></span></p>
   <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
</div>
<?php
   }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   }
?>

</div>
</section>
<!--orders section ends-->

  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>

    <!--footer section ends-->

  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
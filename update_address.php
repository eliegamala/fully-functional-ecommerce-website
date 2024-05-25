<?php

include  'INCLUDES/connect.php';

//starting a new session
session_start();

//check if the user id is set in the session
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
  header('location:index.php');

}


if(isset($_POST['submit'])){

  $address = $_POST['address1'] .', '.$_POST['city'].', '.$_POST['state'].', '.$_POST['country'] .', '. $_POST['zipcode'];

  $address = filter_var($address, FILTER_SANITIZE_STRING);

  $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE ID = ?");

  $update_address->execute([$address,$user_id]);

  $message[] = 'address updated';



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>update address</title>

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

<!--update address-->

  <section class="form-container">
    <form action="" method="post">

        <h3>Your Address</h3>
        <input type="text" name="address1" maxlength="100" required placeholder="Address line 1" class="box">
        <input type="text" name="city" maxlength="50" required placeholder="city name" class="box">
        <input type="text" name="state" maxlength="50" required placeholder="state name" class="box">

        <input type="text" name="country" maxlength="50" required placeholder="country name" class="box">
        <input type="text" name="zipcode" maxlength="50" required placeholder="Zip/ postcode" class="box">

        <input type="submit" value="save address" name="submit" class="hero-btn">

    </form>
  </section>

<!--update address-->

  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>

    <!--footer section ends-->


  <!--javascript-->
  <script src="javascript/javascript.js" async defer></script>
  
  
</body>
</html>
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

  if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);

    $email = $_POST['email']; // Corrected assignment
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    $number = $_POST['number'];
    $number = filter_var($number,FILTER_SANITIZE_STRING);
    
    $msg= $_POST['msg'];
    $msg = filter_var($msg,FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message =?");
    $select_message->execute([$name,$email,$number,$msg]);

    if($select_message->rowCount()>0){
      $message[] = 'message sent already';
   
    }else{
    
      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'message sent successfully';
      
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/aboutStyles.css">
   <link rel="stylesheet" href="css/form-styles.css">

</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

    <div class="heading">
      <h2>Contact us</h2>
      <p><a href="index.php"> home</a> <span> / contact</span></p>
    </div>

<!--contact us-->
<section class="contact">
      <div class="row">

      <div>
        <img src="images/animewave.gif" alt="">
      </div>

        <form action="" method="post">
          <h3>tell us something!</h3>

          <input type="text" name="name" required placeholder="enter your name" maxlength="50" class="box"/>
          <input  type="number" name="number"   required placeholder="enter your number"  max="9999999999" min="0"  class="box"  onkeypress="if(this.value.length == 10) return false;"  />

          <input type="email"  name="email" required placeholder="enter your email" maxlength="50"  class="box"/>

          <textarea name="msg" placeholder="enter your message" required class="box" cols="30"  rows="10"   maxlength="500"></textarea>
          <input type="submit" value="send message" class="hero-btn" name="send"
          />
        </form>
      </div>
    </section>


  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>

    <!--footer section ends-->

  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
<?php

include  'INCLUDES/connect.php';

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


if (isset($_POST['submit'])) {

 
  $email = $_POST['email']; 
  $email = filter_var($email, FILTER_SANITIZE_EMAIL); 


  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);


  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
  $select_user->execute([$email, $pass]);

  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if ($select_user->rowCount() > 0) {
    $_SESSION['user_id'] = $row['ID'];
    header('Location: index.php'); 
    } else {
      $message[] = 'Incorrect email or password';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/form-styles.css" />


</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

<!--login section starts-->

<section class="form-container">
  <form action="" method="post">
    <h3>login now</h3>
    <input type="email" required maxlength="50" name="email" placeholder="Enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
    <input type="password" required maxlength="20" name="pass" placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
    <input type="submit" value="login now" class="hero-btn" name="submit">
    <p>don't have an account? <a href="register.php">register now</a></p>
  </form>
</section>

<!--login section ends-->

  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
<?php

include '../INCLUDES/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

// Delete review if requested
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_review = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
   $delete_review->execute([$delete_id]);
   header('location:manage_reviews.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Reviews</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../INCLUDES/admin_header.php' ?>

<!-- manage reviews section starts  -->

<section class="manage-reviews">

   <h1 class="heading">Manage Reviews</h1>

   <div class="box-container">

   <?php
      // Fetch all reviews grouped by products
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            $product_id = $fetch_products['ID'];
   ?>
   <div class="product-reviews">
      <h2>Product: <?= $fetch_products['name']; ?></h2>
      
      <?php
         $select_reviews = $conn->prepare("SELECT reviews.*, users.name AS user_name FROM `reviews` JOIN `users` ON reviews.user_id = users.id WHERE product_id = ? ORDER BY reviews.created_at DESC");
         $select_reviews->execute([$product_id]);

         if($select_reviews->rowCount() > 0){
            while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <p><strong>User:</strong> <?= $fetch_reviews['user_name']; ?></p>
         <p><strong>Rating:</strong> <?= $fetch_reviews['rating']; ?>/5</p>
         <p><strong>Comment:</strong> <?= $fetch_reviews['comment']; ?></p>
         <p><strong>Date:</strong> <?= $fetch_reviews['created_at']; ?></p>
         <a href="manage_reviews.php?delete=<?= $fetch_reviews['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No reviews for this product</p>';
         }
      ?>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No products found</p>';
      }
   ?>

   </div>

</section>

<!-- manage reviews section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>

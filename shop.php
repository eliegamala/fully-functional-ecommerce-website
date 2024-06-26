<?php

include  'INCLUDES/connect.php';

//starting a new session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
//check if the user id is set in the session
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
}
include  'INCLUDES/add_cart.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>shop</title>

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
      <h2>Shop</h2>
      <p><a href="index.php"> home</a> <span> / shop</span></p>
    </div>

    <!--shop section-->

    <section class="products">

<div class="box-container">
    <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
        <form action="" method="post" class="cat-box">
          <input type="hidden" name="pid" value="<?= $fetch_products['ID']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_products['image'] ?>">
          <a href="quick_view.php?pid=<?= $fetch_products['ID']; ?>" class="fas fa-eye"></a>
          
          <!--image upload-->
          <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="product" class="image">

          <!--product infomation-->
          <div class="product-info">
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="category-title"><?= $fetch_products['category']; ?></a>
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="price"><span>R</span><?= $fetch_products['price']; ?></div>
           </div>

          <!--buttons-->
          <div class="product-btns d-flex">
          <button type="submit" name="add_to_cart">add to cart</button>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
           </div>

        </form>

   <?php
        }
          }else{

            echo '    <div class="empty">no products added yet</div>
            ';

         }
    ?>



</div>
<br>
</section>


 <!--shop section-->



  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>

    <!--footer section ends-->


  <!--javascript-->
  <script src="js/javascript.js" async defer></script>
  
  
</body>
</html>
<?php

include 'INCLUDES/connect.php';

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
  exit();
}

// Update quantity in the cart

if(isset($_POST['update_qty'])){
  $cart_id = $_POST['cart_id'];
  $qty = $_POST['qty'];
  $qty = filter_var($qty, FILTER_SANITIZE_STRING);
  $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
  $update_qty->execute([$qty, $cart_id]);
  $message[] = 'cart quantity updated';
}

// Delete a single item from the cart

if(isset($_POST['delete'])){
  $cart_id = $_POST['cart_id'];
  $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
  $delete_cart_item->execute([$cart_id]);
  $message[] = 'cart item deleted!';
}

// Delete a all items from the cart

if(isset($_POST['delete_all'])){
  $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
  $delete_cart_item->execute([$user_id]);
  // header('location:cart.php');
  $message[] = 'deleted all from cart!';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cart</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/checkoutStyles.css">
   <link rel="stylesheet" href="css/aboutStyles.css">
   <link rel="stylesheet" href="css/form-styles.css">
   <link rel="stylesheet" href="css/shopStyles.css">

</head>
<body>

<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

 <div class="heading">
   <h2>shopping cart</h2>
   <p><a href="index.php"> home</a> <span> / cart</span></p>
 </div>

<section class="products">
  <!-- Cart Items -->
  <div class="container-cart">
    <table>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      
      <?php
      $grand_total = 0; // Initialize grand_total to 0

      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);

      if($select_cart->rowCount() > 0){
        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
          <td>
            <form action="" method="post" class="cat-box">
              <input type="hidden" name="cart_id" value="<?= $fetch_cart['ID']; ?>">

              <div class="cart-info">
                <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                <div>
                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="price"><span>R</span><?= $fetch_cart['price']; ?></div>
                  <button type="submit" class="hero-btn" name="delete" onclick="return confirm('delete this item?');">remove</button>

                </div>
              </div>
         
          </td>
          <td><input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
          <button type="submit" class="fas fa-edit" name="update_qty"></button>
          </form>
        </td>

          <td><div class="sub-total"><span>R<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div></td>
        </tr>

        <?php
             $grand_total += $sub_total;
           }
          } else {
           echo '<tr><td colspan="3" class="empty">your cart is empty </td></tr>';
           }
      ?>
    </table>

    <div class="total-price">
      <table>
        <tr>
          <td>cart total : <span>R<?= $grand_total; ?></span></td>
        </tr>
      </table>
      <a href="checkout.php" class="hero-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>

    </div>

    <div class="more-btn">
    <form action="" method="post">
      <button type="submit" class="hero-btn" name="delete_all"> delete all</button>
    </form>
    </div>

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

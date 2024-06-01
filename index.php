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

include  'INCLUDES/add_cart.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>

  <!--icon links-->
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--css links-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/form-styles.css">


   

    <!--javascript slider-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css">

</head>
<body>


<!--header section starts-->
<?php
  include 'INCLUDES/user_header.php';
?>
<!--header section ends-->

<!--hero section starts-->
<section class="hero">
          <div class="glide" id="glide_1">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
              <li class="glide__slide">
                <div class="center">
                  <div class="left">
                    <span class="">Anime</span>
                    <h1 class="">Level Up Your <br>Anime Collection</h1>
                    <p>Top Picks in Anime Figures, Clothing, and More</p>
                    <a href="shop.php" class="hero-btn">SHOP NOW</a>
                  </div>
                  <div class="right">
                      <img class="img1" src="./images/hero-1.png" alt="">
                  </div>
                </div>
              </li>
    
            
              <li class="glide__slide">
                <div class="center">
                  <div class="left">
                    <span>New merch</span>
                    <h1>Epic Anime Finds!</h1>
                    <p>Shop the Hottest Anime Products Now</p>
                    <a href="shop.php" class="hero-btn">SHOP NOW</a>
                  </div>
                  <div class="right">
                    <img class="img2" src="./images/hero-3.png" alt="">
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
  </section>
  <!--hero section ends-->

<!--category section starts-->
<div class="section-title">
  <h1>Categories</h1>
  <p>"Unleash Your Otaku Spirit: Dive into Our Diverse Categories!"</p>
</div>

<section class="category-container">
  <div class="cat-center">




    <a href="category.php?category=figurine" class="cat">
      <img src="images/category-1.png" alt="figurine">
      <div>
        <p class="category-title">FIGURINE</p>
      </div>
    </a>

    <a href="category.php?category=clothes" class="cat">
      <img src="images/category-2.png">
      <div>
        <p class="category-title">CLOTHES</p>
      </div>
    </a>

    <a href="category.php?category=merchandise" class="cat">
      <img src="images/category-3.png">
      <div>
        <p class="category-title">MERCHANDISE</p>
      </div>
    </a>

    <a href="category.php?category=manga" class="cat">
      <img src="images/catergory-4.png">
      <div>
        <p class="category-title">MANGA</p>
      </div>
    </a>
  </div>
</section>


<!--category section ends-->

<!--new arrivals start-->

<div class="section-title">
   <h1>New Arrivals</h1>
   <p>""Fresh Finds, New Thrills: Dive into Our Latest Anime Arrivals!"</p>
</div>

<section class="products">

<div class="box-container">
    <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
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
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
           </div>

        </form>

   <?php
        }
          }else{

            echo '    <div class="empty">no products added yet</div> ';
         }
    ?>

</div>

<div class="more-btn">
  <a href="shop.php" class="hero-btn"> view all</a>
</div>
</section>
      
<!--new arrivals ends-->

<!--search results-->
<section class="products">
    <div class="box-container">
        <?php
        if (isset($_POST['search_box'])) {
            $search_query = $_POST['search_box'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR category LIKE ?");
            $select_products->execute(["%$search_query%", "%$search_query%"]);

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="cat-box">
                        <!-- Link to quick view page -->
                        <a href="quick_view.php?pid=<?= $fetch_products['ID']; ?>" class="fas fa-eye"></a>

                        <!-- Image -->
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="product" class="image">

                        <!-- Product information -->
                        <div class="product-info">
                            <!-- Link to category page -->
                            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="category-title"><?= $fetch_products['category']; ?></a>
                            <div class="name"><?= $fetch_products['name']; ?></div>
                            <div class="price"><span>R</span><?= $fetch_products['price']; ?></div>
                        </div>

                        <!-- Buttons -->
                        <div class="product-btns d-flex">
                            <button type="submit" name="add_to_cart">add to cart</button>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="empty">No products found.</div>';
            }
        }
        ?>
    </div>
    <br>
</section>

  <!--footer section-->
   <?php
     include 'INCLUDES/footer.php';
    ?>
    <!--footer section ends-->

  <!--javascript-->
  <script src="js/javascript.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
  <script src="js/slider.js" async defer></script>  
  <script src="js/admin_script.js" async defer></script>  

</body>
</html>
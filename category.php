<?php

include 'INCLUDES/connect.php';

// Starting a new session if none exists
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user id is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
include  'INCLUDES/add_cart.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <!-- Icon links -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS links -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form-styles.css">

    <link rel="stylesheet" href="css/shopStyles.css">
    <link rel="stylesheet" href="css/aboutStyles.css">
    <link rel="stylesheet" href="css/checkoutStyles.css">
</head>
<body>

<!-- Header section starts -->
<?php include 'INCLUDES/user_header.php'; ?>
<!-- Header section ends -->

<!-- Category header -->
<section class="category-heading">
    <?php
    if (isset($_GET['category'])) {
        $category = htmlspecialchars($_GET['category']);
    } else {
        $category = 'Unknown Category';
    }
    ?>
    <div class="heading">
        <h2><?= $category ?></h2>
        <p><a href="index.html">Home</a> <span> / <?= $category ?></span></p>
    </div>
</section>

<!-- Category section starts -->
<section class="products">
    <div class="box-container">
        <?php
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
            $select_products->execute([$category]);
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <form action="" method="post" class="cat-box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['ID']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['image'] ?>">
                        <a href="quick_view.php?pid=<?= $fetch_products['ID']; ?>" class="fas fa-eye"></a>

                        <!-- Image upload -->
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="product" class="image">

                        <!-- Product information -->
                        <div class="product-info">
                            <div class="name"><?= $fetch_products['name']; ?></div>
                            <div class="price"><span>R</span><?= $fetch_products['price']; ?></div>
                        </div>

                        <!-- Buttons -->
                        <div class="product-btns d-flex">
                            <button type="submit" name="add_to_cart">Add to cart</button>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo '<div class="empty">No products added yet</div>';
            }
        } else {
            echo '<div class="empty">Category not specified</div>';
        }
        ?>
    </div>
</section>
<!-- Category section ends -->

<!-- Footer section -->
<?php include 'INCLUDES/footer.php'; ?>
<!-- Footer section ends -->

<!-- JavaScript -->
<script src="js/javascript.js" async defer></script>

</body>
</html>

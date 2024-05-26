<?php
include 'INCLUDES/connect.php';

// starting a new session
session_start();

// check if the user id is set in the session
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

include  'INCLUDES/add_cart.php';

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    if ($user_id !== '') {
        $insert_review = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
        $insert_review->execute([$product_id, $user_id, $rating, $comment]);
          // Redirect to prevent form resubmission
          header("Location: quick_view.php?pid=$product_id");
          exit();
    } else {
        echo '<script>alert("You need to log in to submit a review!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>quick view</title>

  <!-- icon links -->
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- css links -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/shopStyles.css">
  <link rel="stylesheet" href="css/checkoutStyles.css">
  <link rel="stylesheet" href="css/form-styles.css">
  <link rel="stylesheet" href="css/aboutStyles.css">
</head>
<body>

<!-- header section starts -->
<?php include 'INCLUDES/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
  <h2>product details</h2>
  <p><a href="index.php">Home</a> <span> / product</span></p>
</div>

<!-- quick view section starts -->
<section class="quick-view">
<?php
$pid = $_GET['pid'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE ID = ?");
$select_products->execute([$pid]);
if($select_products->rowCount() > 0){
  while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
  <form action="" method="post" class="cat-box">
    <input type="hidden" name="pid" value="<?= $fetch_products['ID']; ?>">
    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
    <input type="hidden" name="image" value="<?= $fetch_products['image'] ?>">

    <!-- image upload -->
    <div class="image-container">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="product" class="image">
    </div>

    <!-- product information -->
    <div class="product-details">
      <div class="product-info">
        <a href="category.php?category=<?= $fetch_products['category']; ?>" class="category-title"><?= $fetch_products['category']; ?></a>
        <div class="name"><?= $fetch_products['name']; ?></div>
        <div class="price"><span>R</span><?= $fetch_products['price']; ?></div>
        <div class="description"><?= $fetch_products['description']; ?></div>
      </div>

      <!-- buttons -->
      <div class="product-btns d-flex">
        <button type="submit" class="cart-btn" name="add_to_cart">Add to Cart</button>
        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
    </div>
  </form>
<?php
  }
} else {
  echo '<div class="empty">No products found</div>';
}
?>

<!-- review section starts -->
<section class="review-section">
  <h3>Reviews</h3>

  <!-- Review form -->
  <form action="" method="post" class="review-form">
    <input type="hidden" name="product_id" value="<?= $pid; ?>">
    <div class="rating">
      <label for="rating">Rating:</label>
      <select name="rating" id="rating" required>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
      </select>
    </div>
    <div class="comment">
      <label for="comment">Comment:</label>
      <textarea name="comment" id="comment" rows="4" required></textarea>
    </div>
    <button type="submit" name="submit_review">Submit Review</button>
  </form>

  <!-- Display reviews -->
  <?php
  $select_reviews = $conn->prepare("SELECT reviews.*, users.name FROM reviews JOIN users ON reviews.user_id = users.ID WHERE product_id = ? ORDER BY created_at DESC");
  $select_reviews->execute([$pid]);
  if($select_reviews->rowCount() > 0){
    while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
  ?>
    <div class="review">
      <div class="review-header">
        <strong><?= $fetch_reviews['name']; ?></strong>
        <span class="rating">Rating: <?= $fetch_reviews['rating']; ?>/5</span>
      </div>
      <div class="review-body">
        <p><?= $fetch_reviews['comment']; ?></p>
        <small><?= $fetch_reviews['created_at']; ?></small>
      </div>
    </div>
  <?php
    }
  } else {
    echo '<div class="no-reviews">No reviews yet.</div>';
  }
  ?>
</section>
<!-- review section ends -->

</section>

<!-- quick view section ends -->

<!-- footer section -->
<?php include 'INCLUDES/footer.php'; ?>
<!-- footer section ends -->

<!-- javascript -->
<script src="js/javascript.js" async defer></script>
</body>
</html>

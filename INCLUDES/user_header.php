<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("connect.php"); // Include the database connection file

if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
<link rel="stylesheet" href="css/styles.css">

<header>
    <div class="navigation">
        <div class="nav-center container d-flex">

            <!--logo-->
            <a href="#home" class="logo "> <img src="logo/logo.svg"></a>

            <!--navigation-->
            <ul class="nav-list d-flex">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="shop.php" class="nav-link">Shop</a>
                </li>

                <li class="nav-item">
                    <a href="orders.php" class="nav-link">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">About</a>
                </li>

                <li class="nav-item">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>

            </ul>

            <!--icons-->
            <div class="icons d-flex">

                <?php
                /*prepare statement selects all the rows from the cart table
                  execute the prepared statement
                  get the total number of rows returned by the executed query
                */
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_items = $count_cart_items->rowCount();

                ?>

                <!-- Search icon -->
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <!-- Search form -->
                <section class="search-form">
                    <form action="search_results.php" method="post">
                        <input type="text" class="search-box" name="search_box" placeholder="Search here..." maxlength="100">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                    </form>
                </section>

                <div id="user-btn" class="bx bx-user"></div>
                <a href="cart.php" class="icon"><i class="bx bx-cart"></i><span>( <?= $total_cart_items ?> )</span></a>
            </div>


            <!--menu-hamburger-->
            <div class="menu-icon">
                <i class="bx bx-menu"></i>
            </div>
        </div>
        <!--move this later-->
        <div class="profile">

            <?php

            $select_profile = $conn->prepare("SELECT * FROM users WHERE ID = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <p class="name"> <?= $fetch_profile['name']; ?></p>
                <div class="profile-btn">
                    <a href="profile.php" class="btn"> profile</a>
                    <a href="INCLUDES/user_logout.php" class="delete-btn" onclick="return confirm('logout from site')"> logout</a>
                    <p class="account"> <a href="../register.php">register</a> or <a href="login.php">login</a> </p>
                </div>
                <?php
            } else {
                ?>
                <p class="name">please login first</p>
                <a href="login.php" class="btn">login</a>

            <?php

            }
            ?>
        </div>
    </div>
</header>

<?php
// search_results.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include  'INCLUDES/connect.php';

if (isset($_POST['search_box'])) {
    $search_query = $_POST['search_box'];

    // Check if the search query matches any products
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR category LIKE ?");
    $select_products->execute(["%$search_query%", "%$search_query%"]);

    if ($select_products->rowCount() > 0) {
        // Fetch the first product to decide the redirection
        $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);

        // Redirect to the quick view page with the ID of the first product
        header("Location: quick_view.php?pid=" . $fetch_product['ID']);
        exit; // Stop further execution
    } else {
        // Redirect to the category page with the search query
        header("Location: category.php?category=$search_query");
        exit; // Stop further execution
    }
} else {
    // Redirect to the homepage if no search query is provided
    header("Location: index.php");
    exit; // Stop further execution
}
?>

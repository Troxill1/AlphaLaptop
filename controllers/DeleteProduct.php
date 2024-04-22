<?php
    include('DatabaseConnection.php');
    
    $id = $_POST['id'];

    $deleteProduct = "DELETE products, cart, favourites FROM products
        LEFT JOIN cart ON products.id = cart.product_id
        LEFT JOIN favourites ON products.id = favourites.product_id 
        WHERE products.id = $id OR cart.product_id = $id OR favourites.product_id = $id";
    $mysqli->query($deleteProduct);

    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");

    $mysqli->close();
?>
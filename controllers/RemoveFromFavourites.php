<?php
    include('DatabaseConnection.php');
    
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];

    $removeFavourite = "DELETE FROM favourites WHERE product_id = $productId AND user_id = $userId";
    $mysqli->query($removeFavourite);

    header("Location: ../Favourites.php");

    $mysqli->close();
?>
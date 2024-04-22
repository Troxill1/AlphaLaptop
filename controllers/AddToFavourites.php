<?php
    include('DatabaseConnection.php');
    
    $userId = $_POST['userId'];
    $productId = $_POST['productId'];

    $isInTable = "SELECT * FROM favourites WHERE product_id = '$productId' AND user_id = '$userId'";
    $result = $mysqli->query($isInTable);

    if ($result->num_rows > 0) {
        $removeFavourite = "DELETE FROM favourites WHERE product_id = '$productId' AND user_id = '$userId'";
        $mysqli->query($removeFavourite);
    } else {
        $addToFavourites = "INSERT INTO favourites (product_id, user_id) VALUES ('$productId', '$userId')";
        $mysqli->query($addToFavourites);
    }

    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");

    $mysqli->close();
?>
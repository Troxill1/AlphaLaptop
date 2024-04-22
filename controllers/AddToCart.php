<?php
    include('DatabaseConnection.php');

    $userId = $_POST['userId'];
    $productId = isset($_POST['productId']) ? $_POST['productId'] : null;

    if ($productId != null) {
        $isInTable = "SELECT * FROM cart WHERE product_id = '$productId' AND user_id = '$userId'";
        $result = $mysqli->query($isInTable);

        if ($result->num_rows == 0) {
            $addToCart = "INSERT INTO cart (product_id, user_id, quantity) VALUES ('$productId', '$userId', 1)";
            $mysqli->query($addToCart);
        }
    } else { // true if the user selected the option to add all favourite products to the cart
        $getProducts = "SELECT * FROM favourites WHERE user_id = '$userId'";
        $products = $mysqli->query($getProducts);

        while ($row = $products->fetch_assoc()) {
            $productId = $row['product_id'];

            $isInTable = "SELECT * FROM cart WHERE product_id = '$productId' AND user_id = '$userId'";
            $result = $mysqli->query($isInTable);
    
            if ($result->num_rows == 0) {
                $addToCart = "INSERT INTO cart (product_id, user_id, quantity) VALUES ('$productId', '$userId', 1)";
                $mysqli->query($addToCart);
            }
        }
    }

    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");

    $mysqli->close();
?>
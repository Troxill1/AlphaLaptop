<?php
    include('DatabaseConnection.php');
    
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    $quantity = $_POST['quantity'];
    $editType = $_POST['editType'];

    if ($editType == 'remove') {
        $quantity -= 1;
    } else {
        $quantity += 1;
    }

    if ($quantity <= 0) {
        $removeFromCart = "DELETE FROM cart WHERE product_id = $productId AND user_id = $userId";
        $mysqli->query($removeFromCart);
    }

    $editQuantity = "UPDATE cart SET quantity = '$quantity'
        WHERE product_id = '$productId' AND user_id = '$userId'";
    $mysqli->query($editQuantity);

    header("Location: ../Cart.php");

    $mysqli->close();
?>
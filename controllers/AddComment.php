<?php
    include('DatabaseConnection.php');

    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $userId = $_POST['user-id'];
    $productId = $_POST['product-id'];
    
    $addComment = "INSERT INTO comments (comment, rating, user_id, product_id)
            VALUES ('$comment', '$rating', '$userId', '$productId')";
    $mysqli->query($addComment);
    
    header("Location: ../Description.php?id=$productId");
    
    $mysqli->close();
?>
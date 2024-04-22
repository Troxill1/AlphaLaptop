<?php
    include('DatabaseConnection.php');
    session_start();
    
    $id = $_SESSION['user_id'];

    $emptyCart = "DELETE FROM cart WHERE user_id = '$id'";
    $mysqli->query($emptyCart);

    $mysqli->close();
?>
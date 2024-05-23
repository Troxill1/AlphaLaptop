<?php
    include('DatabaseConnection.php');
    session_start();
    
    $id = $_POST['orderId'];

    $emptyCart = "DELETE FROM orders WHERE id = '$id'";
    $mysqli->query($emptyCart);
    $mysqli->close();

    header("Location: ../ViewOrders.php");
?>
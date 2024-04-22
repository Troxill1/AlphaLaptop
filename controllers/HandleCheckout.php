<?php
    include('DatabaseConnection.php');
    session_start();

    $userId = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $payment = $_POST['payment'];

    $getCart = "SELECT * FROM cart WHERE user_id = '$userId'";
    $cart = $mysqli->query($getCart);

    $description = '';
    while ($row = $cart->fetch_assoc()) {
        $productId = $row['product_id'];
        $getProduct = "SELECT brand, model FROM products WHERE id = '$productId'";
        $result = $mysqli->query($getProduct);
        $product = $result->fetch_assoc();

        $description .= $product['brand'] . ' ' . $product['model'] . ' Брой: ' . $row['quantity'] . '\n';
    }

    $createOrder = "INSERT INTO orders
        (user_id, user_full_name, city, address, zip_code, description, payment_method)
        VALUES ('$userId', '$fullname', '$city', '$address', '$zip', '$description', '$payment')";
    $mysqli->query($createOrder);

    if ($payment == 'Наложен платеж') {
        include('EmptyCart.php');
        
        header('Location: ../SuccessfulOrder.php');
        exit;
    }

    header('Location: HandlePayment.php');
?>
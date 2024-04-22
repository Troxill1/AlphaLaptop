<?php
    include('DatabaseConnection.php');
    require_once('../stripe-php-master/init.php');

    session_start();
    $userId = $_SESSION['user_id'];

    \Stripe\Stripe::setApiKey('sk_test_51Oyt7XRqt4H7IwatbxYogcUdv1l64pJMjYPBo3yQmavqmXFzyQghNUNtKCuScwKIpdqkS6nYAuYdBiLu2nKsNEVu00OC0AR3YT');

    $fetchCartItems = "SELECT products.brand, products.model, products.price, cart.quantity
        FROM products, cart WHERE cart.user_id = '$userId' AND cart.product_id = products.id";
    $cartItemsResult = $mysqli->query($fetchCartItems);

    if ($cartItemsResult) {
        while ($row = $cartItemsResult->fetch_assoc()) {
            $cartItems[] = $row;
        }
    
        $lineItems = [];
        foreach ($cartItems as $cartItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'bgn',
                    'product_data' => [
                        'name' => $cartItem['brand'] . ' ' . $cartItem['model'],
                    ],
                    'unit_amount' => $cartItem['price'] * 100,
                ],
                'quantity' => $cartItem['quantity'],
            ];
        }
    
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'https://alpha-laptop.eu/SuccessfulOrder.php',
            'cancel_url' => 'https://alpha-laptop.eu/Cart.php',
        ]);
    
        // Redirect user to Stripe Checkout
        header('Location: ' . $session->url);
        exit;
    }
    
    header('Location: ../Cart.php');
?>
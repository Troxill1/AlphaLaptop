<?php
    include('./controllers/DatabaseConnection.php');
    include('DisplayHeaderFooter.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alpha Laptop</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="./styles/Orders.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./controllers/Navigation.js"></script>
</head>
<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1 class="header">Моите поръчки</h1>
        <section>
            <?php
                $userId = $_SESSION['user_id'];

                $getOrders = "SELECT * FROM orders WHERE user_id = '$userId'";
                $orders = $mysqli->query($getOrders);

                if ($orders->num_rows > 0) {
                    while ($order = $orders->fetch_assoc()) {
                        echo
                        '<div class="order">
                            <h3>Поръчка на ' . $order['user_full_name'] . '</h3>
                            <h4>Закупени продукти:</h4>
                            <p>' . $order['description'] . '</p>
                            <h4>Адрес на доставка:</h4>
                            <p>гр/с ' . $order['city'] . ', ' . $order['address'] . ', ZIP код ' . $order['zip_code'] . '</p>
                            <p><b>Начин на плащане:</b> ' . $order['payment_method'] . '</p>
                        </div>';
                    }
                } else {
                    echo '<p class="no-products-message">Не са намерени поръчки</p>';
                }
            ?>
        </section>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
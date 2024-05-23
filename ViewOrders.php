<?php
    include('./controllers/DatabaseConnection.php');
    include('DisplayHeaderFooter.php');
    include('DisplayProducts.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Админ Панел</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./controllers/Navigation.js"></script>
</head>
<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1 class="header">Активни потребителски поръчки</h1>
        <section>
            <?php
                $getOrders = 'SELECT * FROM orders';
                $orders = $mysqli->query($getOrders);

                if ($orders->num_rows > 0) {
                    while ($order = $orders->fetch_assoc()) {
                        $userId = $order['user_id'];
                        $getUser = "SELECT username, email FROM accounts WHERE id = '$userId'";
                        $user = ($mysqli->query($getUser))->fetch_assoc();

                        echo
                        '<div class="order">
                            <h3>Поръчка на ' . $order['user_full_name'] . '</h3>
                            <p>Потребителско име: ' . $user['username'] . ', Имейл: ' . $user['email'] . '</p>
                            <h4>Закупени продукти:</h4>
                            <p>' . $order['description'] . '</p>
                            <h4>Адрес на доставка:</h4>
                            <p>гр/с ' . $order['city'] . ', ' . $order['address'] . ', ZIP код ' . $order['zip_code'] . '</p>

                            <form action="./controllers/RemoveOrder.php" method="POST">
                                <input type="hidden" name="orderId" value=' . $order['id'] . '>
                                <button type="submit">Изпълни поръчка</button>
                            </form>
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
<?php
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
    <link rel="stylesheet" type="text/css" href="./styles/Favourites.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="./controllers/Navigation.js"></script>
</head>
<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1 id="favourites-header">Моите любими</h1>

        <?php
            include('./controllers/DatabaseConnection.php');

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $getProductsIds = "SELECT * FROM favourites WHERE user_id = '$userId' ORDER BY id";
                $productsIds = $mysqli->query($getProductsIds);
    
                if ($productsIds->num_rows > 0) {
                    echo
                    '<div class="flex-container"> <!-- Starts HERE -->
                        <div id="product-list"> <!-- Starts HERE -->';

                    $totalCost = 0;
                    while ($row = $productsIds->fetch_assoc()) {
                        $productId = $row['product_id'];
                        $getProduct = "SELECT * FROM products WHERE id = '$productId'";
                        $product = $mysqli->query($getProduct);

                        if ($product->num_rows == 1) {
                            $product = $product->fetch_assoc();

                            $getCart = "SELECT * FROM cart WHERE product_id = $productId AND user_id = $userId";
                            $cart = $mysqli->query($getCart);

                            $totalCost += $product['price'];

                            echo
                            '<div class="product">
                                <a class="product-link" href="Description.php?id=' . $product['id'] . '">
                                    <img src="./images/' . $product['image'] . '" alt="Снимка на продукта">
                                    <p>' . $product['brand'] . " " . $product['model'] . '</p>
                                </a>
                                <div>
                                    <form action="./controllers/RemoveFromFavourites.php" method="POST">
                                        <input type="hidden" name="productId" value=' . $product['id'] . '>
                                        <input type="hidden" name="userId" value=' . $userId . '>

                                        <button type="submit" class="submit-button">Премахни</button>
                                    </form>
                                    <p></p>';

                                    if ($cart->num_rows < 1) {
                                        echo
                                        '<form action="./controllers/AddToCart.php" method="POST">
                                            <input type="hidden" name="productId" value=' . $product['id'] . '>
                                            <input type="hidden" name="userId" value=' . $userId . '>

                                            <button type="submit" class="submit-button">Добави в количката</button>
                                        </form>';
                                    } else {
                                        echo '<p class="success-message">Добавено в количката</p>';
                                    }
                                    echo
                                    '<p class="price">' . $product['price'] . '<sup>00</sup>лв.' . '</p>
                                </div>
                            </div>';
                        } else {
                            echo '<p class="error-message">Изтрит продукт</p>';
                        }
                    }

                    echo 
                        '</div> <!-- Ends HERE -->
                        <div class="purchase">
                            <p class="price" id="big-price">' . $totalCost . '<sup>00</sup>лв. Общо' . '</p>

                            <form action="./controllers/AddToCart.php" method="POST">
                                <input type="hidden" name="userId" value=' . $userId . '>
                                <button><i class="fas fa-shopping-cart"></i>Добави към количката</button>
                            </form>
                        </div>
                    </div> <!-- Ends HERE -->';

                } else {
                    echo '<p id="no-favourites">Нямате любими продукти</p>';
                }
            } else {
                echo '<p class="error-message">Впишете се, за да добавяте към любими</p>';
            }      
        ?>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
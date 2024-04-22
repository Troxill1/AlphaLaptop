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
    <link rel="stylesheet" type="text/css" href="./styles/Cart.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./controllers/Navigation.js"></script>
    <script>
        function validateForm() {
            var fullname = document.getElementById('fullname').value;
            var address = document.getElementById('address').value;
            var city = document.getElementById('city').value;
            var zip = document.getElementById('zip').value;
            var errorMessage = document.getElementById('error-message');

            const fullnameRegex = /^[А-Яа-я]+ [А-Яа-я]+$/;

            if (fullname.trim() === '' || address.trim() === '' || city.trim() === '' || zip.trim() === '') {
                errorMessage.innerHTML = 'Всички полета са задължителни';
                return false;
            }

            if (!fullnameRegex.test(fullname)) {
                errorMessage.innerHTML = 'Името трябва да е на кирилица';
                return false;
            }

            return true;
        }

        function openCheckout() {
            document.getElementById('checkout-form').style.display = 'flex';
        }   

        function cancelCheckout() {
            document.getElementById('checkout-form').style.display = 'none';
            document.getElementById('checkout-form').reset();
            document.getElementById('error-message').innerHTML = '';
        }
    </script>
</head>
<body id="body">
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1 id="cart-header">Моята количка</h1>

        <?php
            include('./controllers/DatabaseConnection.php');

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $getProductsIds = "SELECT * FROM cart WHERE user_id = '$userId' ORDER BY id";
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

                            $quantity = $row['quantity'];
                            $totalCost += $quantity * $product['price'];

                            echo
                            '<div class="product">
                                <a class="product-link" href="Description.php?id=' . $product['id'] . '">
                                    <img src="./images/' . $product['image'] . '" alt="Снимка на продукта">
                                    <p>' . $product['brand'] . " " . $product['model'] . '</p>
                                </a>
                                <div>
                                    <p>Количество</p>
                                    <p>
                                        <form action="./controllers/EditProductQuantity.php" method="POST">
                                            <input type="hidden" name="productId" value=' . $product['id'] . '>
                                            <input type="hidden" name="userId" value=' . $userId . '>
                                            <input type="hidden" name="quantity" value=' . $quantity . '>
                                            <input type="hidden" name="editType" value="remove">

                                            <button type="submit" class="edit remove">-</button>
                                        </form>
                                        <span>' . $quantity . '</span>
                                        <form action="./controllers/EditProductQuantity.php" method="POST">
                                            <input type="hidden" name="productId" value=' . $product['id'] . '>
                                            <input type="hidden" name="userId" value=' . $userId . '>
                                            <input type="hidden" name="quantity" value=' . $quantity . '>
                                            <input type="hidden" name="editType" value="add">

                                            <button type="submit" class="edit add">+</button>
                                        </form>
                                    </p>
                                    <form action="./controllers/EditProductQuantity.php" method="POST">
                                        <input type="hidden" name="productId" value=' . $product['id'] . '>
                                        <input type="hidden" name="userId" value=' . $userId . '>
                                        <input type="hidden" name="quantity" value=' . 1 . '>
                                        <input type="hidden" name="editType" value="remove">

                                        <button type="submit" class="delete-button">Премахни</button>
                                    </form>
                                    <p class="price">' . $quantity * $product['price'] . '<sup>00</sup>лв.' . '</p>
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
                            <a onclick="openCheckout()"><i class="fas fa-shopping-cart"></i>Премини към плащане</a>
                        </div>
                    </div> <!-- Ends HERE -->

                    <form id="checkout-form" action="./controllers/HandleCheckout.php" method="POST" onsubmit="return validateForm();">
                        <span class="close" onclick="cancelCheckout()">&times;</span>

                        <label for="fullname">Пълно име</label>
                        <input type="text" id="fullname" name="fullname">
                
                        <label for="address">Адрес</label>
                        <input id="address" name="address">
                
                        <label for="city">Град</label>
                        <input type="text" id="city" name="city">
                
                        <label for="zip">Пощенски код</label>
                        <input type="text" id="zip" name="zip">

                        <select name="payment">
                            <option>Наложен платеж</option>
                            <option>Онлайн плащане</option>
                        </select>

                        <p id="error-message"></p>
                
                        <input type="submit" id="submit" value="Продължи">
                    </form>';

                } else {
                    echo '<p id="empty-cart">Нямате продукти в количката</p>';
                }
            } else {
                echo '<p class="error-message">Впишете се, за да добавяте към количката</p>';
            }      
        ?>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
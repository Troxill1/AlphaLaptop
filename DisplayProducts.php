<?php
    include('./controllers/DatabaseConnection.php');

    function displayProducts($category, $type) {
        global $mysqli;
        $sql = "SELECT * FROM products WHERE subcategory = '$category' LIMIT 5";
        $result = $mysqli->query($sql);

        $isLaptop = $category == 'Gaming' || $category == 'Business' || $category == 'Everyday';
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo
                '<div class="product">
                    <a class="product-link" href="Description.php?id=' . $row['id'] . '">
                        <img src="./images/' . $row['image'] . '" alt="Снимка на продукта">';

                        if ($isLaptop) {
                            echo
                            '<h3>Лаптоп ' . $row['brand'] . ' ' . $row['model'] . ' ' . $row['screen_size'] . '"' . '</h3>
                            <p>' . $row['cpu'] . ' ' . $row['gpu'] . ' <br> ' . $row['ram'] . '</p>';
                        } else {
                            echo '
                            <h3>' . $type . ' ' . $row['brand'] . ' ' . $row['model'] . '</h3>
                            <p><br><br><br></p>';
                        }
                    
                    echo
                    '</a>
                    <p class="price">' . $row['price'] . "<sup>00</sup>лв." . '</p>';
                if (isset($_SESSION['user_id'])) {
                    echo
                    '<form action="./controllers/AddToFavourites.php" method="post">
                        <input type="hidden" name="userId" value="' . $_SESSION['user_id'] . '">
                        <input type="hidden" name="productId" value="' . $row['id'] . '">
                        <button type="submit" class="heart icon" name="addToFavorites">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                    <form action="./controllers/AddToCart.php" method="post">
                        <input type="hidden" name="userId" value="' . $_SESSION['user_id'] . '">
                        <input type="hidden" name="productId" value="' . $row['id'] . '">
                        <button type="submit" class="cart icon" name="addToCart">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </form>';
                } else {
                    $errorMessageId = "error-message-product-" . $row['id'];
                    echo
                    '<script src="./controllers/NotLoggedInErrorMessage.js"></script>
                    <a class="heart icon" onclick="displayNotLoggedInFav(\'' . $errorMessageId . '\')"><i class="fas fa-heart"></i></a>
                    <a class="cart icon" onclick="displayNotLoggedInCart(\'' . $errorMessageId . '\')"><i class="fas fa-shopping-cart"></i></a>
                    <p class="error-message" id="' . $errorMessageId . '"></p>';
                }
                echo '</div>';
            }
        } else {
            echo '<p class="no-products-message">Не са намерени продукти</p>';
        }
    }
?>
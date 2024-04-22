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
    <link rel="stylesheet" type="text/css" href="./styles/Description.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="./controllers/Navigation.js"></script>
</head>

<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <?php
            include('./controllers/DatabaseConnection.php');

            if (isset($_GET['id'])) {
                $product_id = $mysqli->real_escape_string($_GET['id']);

                $selectProduct = "SELECT * FROM products WHERE id = $product_id";
                $product = $mysqli->query($selectProduct);

                if ($product && $product->num_rows > 0) {
                    $row = $product->fetch_assoc();
                    
                    echo
                    '<div class="container">
                        <div class="header">
                            <h2>' . $row['brand'] . ' ' . $row['model'] . '</h2>
                            <img src="./images/' . $row['image'] . '">
                        </div>

                        <div class="actions">
                            <h3>' . $row['brand'] . ' ' . $row['model'] . '</h3>
                            <p class="price">' . $row['price'] . 'лв.' . '</p>';

                            if (isset($_SESSION['user_id'])) {
                                echo
                                '<form action="./controllers/AddToCart.php" method="post">
                                    <input type="hidden" name="userId" value="' . $_SESSION['user_id'] . '">
                                    <input type="hidden" name="productId" value="' . $row['id'] . '">
                                    <button type="submit"><i class="fas fa-shopping-cart"></i>Добави към количката</button>
                                </form>
                                <form action="./controllers/AddToFavourites.php" method="post">
                                    <input type="hidden" name="userId" value="' . $_SESSION['user_id'] . '">
                                    <input type="hidden" name="productId" value="' . $row['id'] . '">
                                    <button type="submit"><i class="fas fa-heart"></i>Добави към любими</button>
                                </form>';
                            } else {
                                echo
                                '<script src="./controllers/NotLoggedInErrorMessage.js"></script>
                                <a onclick="displayNotLoggedInCart(\'error-message-description\')"><i class="fas fa-shopping-cart"></i>Добави към количката</a>
                                <a onclick="displayNotLoggedInFav(\'error-message-description\')"><i class="fas fa-heart"></i>Добави към любими</a>
                                <p id="error-message-description"></p>';
                            }

                        echo
                        '</div>
                    </div>';

                    if ($row['category'] == 'laptops') {
                        echo
                        '<div class="specifications">
                            <h2>Спецификации</h2>
                            <table>
                                <tr>
                                    <td>Процесор</td>
                                    <td><p>' . $row['cpu'] . '</p></td>
                                </tr>
                                <tr>
                                    <td>Видео карта</td>
                                    <td><p>' . $row['gpu'] . '</p></td>
                                </tr>
                                <tr>
                                    <td>RAM памет</td>
                                    <td><p>' . $row['ram'] . '</p></td>
                                </tr>
                                <tr>
                                    <td>Памет</td>
                                    <td><p>' . $row['storage'] . 'GB</p></td>
                                </tr>
                                <tr>
                                    <td>Размер екран</td>
                                    <td><p>' . $row['screen_size'] . '"</p></td>
                                </tr>
                            </table>
                        </div>';
                    }

                    echo '<h2 id="comments-header">Коментари</h2>';

                    $selectComments = "SELECT * FROM comments WHERE product_id = '$product_id'";
                    $comments = $mysqli->query($selectComments);

                    if ($comments->num_rows > 0) {
                        while ($row = $comments->fetch_assoc()) {
                            $user_id = $row['user_id'];
                            $selectUsername = "SELECT username FROM accounts WHERE id = '$user_id'";
                            $username = $mysqli->query($selectUsername)->fetch_assoc();

                            echo
                            '<div class="comment">
                                <img src="./images/user.png" alt="снимка">
                                <p>' . $username['username'] . '</p>';
                                    
                                for ($filled = 0; $filled < $row['rating']; $filled++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                for ($empty = 0; $empty < 5 - $row['rating']; $empty++) {
                                    echo '<i class="far fa-star"></i>';
                                }

                                if (isset($_SESSION['user_id']) && ($user_id == $_SESSION['user_id'] || $_SESSION['admin'] == 1)) {
                                    echo
                                    '<form action="./controllers/DeleteComment.php" method="POST">
                                        <input name="comment-id" value="' . $row['id'] .'" type="hidden">
                                        <button type="submit">Изтрий</button>
                                    </form>';
                                }
           
                            echo
                            '</div>
                            <p class="comment-content">' . $row['comment'] . '</p>';
                        }
                    } else {
                        echo '<p class="no-comments">Няма коментари за този продукт. Бъдете първите да изразите впечатленията си!</p>';
                    }

                    if (isset($_SESSION['user_id'])){
                        echo 
                        '<div class="write-comment">
                            <h2>Напиши коментар</h2>
                            <form action="./controllers/AddComment.php" method="POST">
                                <script src="./controllers/FunctionalStars.js"></script>

                                <textarea name="comment"></textarea>

                                <i class="far fa-star" onclick="toggleStar(this, 0)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 1)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 2)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 3)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 4)"></i>

                                <input name="rating" id="rating" type="hidden">
                                <input name="user-id" value="' . $_SESSION['user_id'] .'" type="hidden">
                                <input name="product-id" value="' . $product_id . '" type="hidden">

                                <button type="submit">Публикувай</button>
                            </form>
                        </div>';
                    } else {
                        echo 
                        '<div class="write-comment">
                            <script src="./controllers/FunctionalStars.js"></script>

                            <h2>Напиши коментар</h2>
                            <p>Впишете се, за да пишете коментари.</p>
                            <textarea readonly></textarea>
                            <div>                      
                                <i class="far fa-star" onclick="toggleStar(this, 0)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 1)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 2)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 3)"></i>
                                <i class="far fa-star" onclick="toggleStar(this, 4)"></i>
                                <input id="rating" type="hidden">

                                <button type="reset">Публикувай</button>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p class="error-message">Продуктът не е намерен</p>';
                }              
            } else {
                echo '<p class="error-message">Невалидна заявка</p>';
            }

            $mysqli->close();
        ?>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>

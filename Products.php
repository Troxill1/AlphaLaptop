<?php
    include('DisplayHeaderFooter.php');
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alpha Laptop</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="./styles/Products.css">
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header class="nav">
        <ul>
            <li><a href="./"><img src="./images/logo.png" alt="Logo"></a></li>
            <li><a href="./">Начало</a></li>
            <li>
                <a class="active">Категории&nbsp;<i class="fas fa-caret-down"></i></a>
                <div class="dropdown">
                    <ul>
                        <li>
                            <a>Лаптопи&nbsp;<i class="fas fa-caret-right"></i></a>
                            <div class="subdropdown">
                                <ul>
                                    <li><a href="Products.php?category=Gaming">Гейминг</a></li>
                                    <li><a href="Products.php?category=Business">Бизнес</a></li>
                                    <li><a href="Products.php?category=Everyday">Ежедневни</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a>Аксесоари&nbsp;<i class="fas fa-caret-right"></i></a>
                            <div class="subdropdown">
                                <ul>
                                    <li><a href="Products.php?category=Headphones">Слушалки</a></li>
                                    <li><a href="Products.php?category=Keyboards">Клавиатури</a></li>
                                    <li><a href="Products.php?category=Mice">Мишки</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="Privacy.php">Поверителност</a></li>
            <li><a href="Contacts.php">Контакти</a></li>
            <li><a href="About.php">За Нас</a></li>

            <?php
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['admin'] == 1) {
                        echo
                        '<li>
                            <a>Админ Панел&nbsp;<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown" id="admin-dropdown">
                                <ul>
                                    <li><a href="ViewLaptops.php">Преглед Лаптопи</a></li>
                                    <li><a href="ViewAccessories.php">Преглед Аксесоари</a></li>
                                    <li><a href="ViewAccounts.php">Преглед Акаунти</a></li>
                                    <li><a href="ViewOrders.php">Преглед Поръчки</a></li>
                                </ul>
                            </div>
                        </li>';
                    }
                }

                $category = isset($_GET['category']) ? $_GET['category'] : '';

                echo
                '<li>
                    <form action="Products.php?category=' . $category . '" class="search-box" method="POST">
                        <input name="search" placeholder="Търсене">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>';

                if (isset($_SESSION['user_id'])) {
                    echo
                    '<li class="float-right"><a href="Orders.php"><i class="fas fa-truck"></i></a></li>
                    <li><a href="Favourites.php"><i class="fas fa-heart"></i></a></li>
                    <li><a href="Cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="Profile.php">' . $_SESSION['username'] . '</a></li>
                    <li><a href="./controllers/EndSession.php">Изход</a></li>';
                } else {
                    echo '<li class="float-right"><a href="Login.php">Вход</a></li>';
                }
            ?>
        </ul>
    </header>

    <main>
        <?php
            include('./controllers/DatabaseConnection.php');

            $isSessionSearch = !empty($_SESSION['product-search']);
            $isSearch = !empty($_POST['search']);
            $isCategory = isset($_GET['category']);
            $isPriceFilter = isset($_POST['price-min']) && isset($_POST['price-max']);
            $badRequest = false;

            $sessionSearch = $isSessionSearch ? $_SESSION['product-search'] : '';
            $search = $isSearch ? $_POST['search'] : $sessionSearch;
            $_SESSION['product-search'] = $search;
            $priceMin = $isPriceFilter ? $_POST['price-min'] : '';
            $priceMax = $isPriceFilter ? $_POST['price-max'] : '';

            if ($isSearch && $isCategory && $isPriceFilter) {
                $sql = "SELECT * FROM products WHERE subcategory = '$category'
                        AND CONCAT(brand, ' ', model) LIKE '%$search%'
                        AND price > '$priceMin' AND price < '$priceMax'";
            } elseif ($isSearch && $isCategory) {
                $sql = "SELECT * FROM products WHERE subcategory = '$category'
                        AND CONCAT(brand, ' ', model) LIKE '%$search%'";
            } elseif ($isCategory && $isPriceFilter) {
                $sql = "SELECT * FROM products WHERE subcategory = '$category'
                        AND price > '$priceMin' AND price < '$priceMax'";
            } elseif ($isSearch && $isPriceFilter) { // DOES NOT WORK
                $sql = "SELECT * FROM products WHERE CONCAT(brand, ' ', model) LIKE '%$search%'
                        AND price > '$priceMin' AND price < '$priceMax'";
            } elseif ($isSearch) { // DOES NOT FULLY WORK
                $sql = "SELECT * FROM products WHERE CONCAT(brand, ' ', model) LIKE '%$search%'
                        ORDER BY subcategory";
            } elseif ($isCategory) {
                $sql = "SELECT * FROM products WHERE subcategory = '$category'";
            } else {
                $badRequest = true;
                echo '<p class="error-message">Невалидна заявка</p>';
            }

            if (!$badRequest) {
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    displayProducts($result);
                } else {
                    echo '<p class="error-message">Не са намерени продукти</p>';
                } 
            }

            function displayProducts($result) {
                global $category;

                echo
                '<aside>
                    <h2 id="filters-h2">Филтри <i class="fas fa-caret-down"></i></h2>
                    <form class="wrapper" action="Products.php?category=' . $category . '" method="POST">
                        <h2>Цена</h2>
                        <div class="price-input">
                            <div class="field">
                                <span>Мин</span>
                                <input type="number" class="input-min" value="0">
                            </div>

                            <div class="field">
                                <span>Макс</span>
                                <input type="number" class="input-max" value="10000">
                            </div>
                        </div>

                        <div class="slider">
                            <div class="progress"></div>
                        </div>

                        <div class="range-input">
                            <input type="range" name="price-min" class="range-min" min="0" max="10000" value="0" step="50">
                            <input type="range" name="price-max" class="range-max" min="0" max="10000" value="10000" step="50">
                        </div>

                        <button type="submit">Филтрирай</button>
                    </form>
                </aside>
                <h1>Резултати от търсенето</h1>
                <section>';

                while ($row = $result->fetch_assoc()) {
                    $product = '';
                    $screenSize = '';
                    $artificialSpace = '<p style="margin-bottom: 25px;"><br></p>';

                    if ($row['category'] == 'laptops') {
                        $product = 'Лаптоп';
                        $screenSize = $row['screen_size'] . '"';
                        $artificialSpace = '';
                    } elseif ($row['subcategory'] == 'Headphones') {
                        $product = 'Слушалки';
                    } elseif ($row['subcategory'] == 'Keyboards') {
                        $product = 'Клавиатура';
                    } elseif ($row['subcategory'] == 'Mice') {
                        $product = 'Мишка';
                    }

                    echo
                    '<div class="product">
                        <a class="product-link" href="Description.php?id=' . $row['id'] . '">
                            <img src="./images/' . $row['image'] . '" alt="Снимка на продукта">                        
                            <h3>' . $product . ' ' . $row['brand'] . ' ' . $row['model'] . ' ' . $screenSize . '</h3>
                            <p>' . $row['cpu'] . ' ' . $row['gpu'] . ' <br> ' . $row['ram'] . '</p>
                            ' . $artificialSpace . '
                        </a>
    
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
                        <p class="error-message error-message-login" id="' . $errorMessageId . '"></p>';
                    }

                    echo '</div>';
                }

                echo '</section>';
            }

            $mysqli->close();
        ?>

        <script>
            const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
            let priceGap = 50;

            priceInput.forEach(input => {
                input.addEventListener("input", e => {
                    let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
                    
                    if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                        if (e.target.className === "input-min") {
                            rangeInput[0].value = minPrice;
                            range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                        } else {
                            rangeInput[1].value = maxPrice;
                            range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                        }
                    }
                });
            });

            rangeInput.forEach(input => {
                input.addEventListener("input", e => {
                    let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                    if ((maxVal - minVal) < priceGap) {
                        if (e.target.className === "range-min") {
                            rangeInput[0].value = maxVal - priceGap
                        } else {
                            rangeInput[1].value = minVal + priceGap;
                        }
                    } else {
                        priceInput[0].value = minVal;
                        priceInput[1].value = maxVal;
                        range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                        range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                    }
                });
            });
        </script>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
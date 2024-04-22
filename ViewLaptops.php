<?php
    include('DisplayHeaderFooter.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Админ Панел</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="./styles/ViewLaptops.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="./controllers/Navigation.js"></script>
</head>

<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
        <main>
            <div class="form">
                <form action="./controllers/AddProduct.php" method="POST">
                    <fieldset>
                        <div class="section section-alone">
                            <h1>Добави лаптоп</h1>
                        </div>

                        <div class="section">
                            <input type="hidden" name="category" value="laptops">
                            <select name="subcategory" required>
                                <option>Gaming</option>
                                <option>Business</option>
                                <option>Everyday</option>
                            </select>
                            <input name="brand" placeholder="Марка" required>
                            <input name="model" placeholder="Модел" required>
                            <input type="file" accept=".png, .jpg, .jpeg" name="image" id="image-upload" required>                
                        </div>

                        <div class="section">
                            <input name="cpu" placeholder="Процесор" required>
                            <input name="gpu" placeholder="Видео карта" required>
                            <input name="ram" placeholder="RAM памет" required>
                        </div>

                        <div class="section">
                            <input name="storage" placeholder="Памет" required>
                            <input name="screen-size" placeholder="Размер на екрана" required>
                            <input name="price" placeholder="Цена" required>
                        </div>

                        <div class="section section-alone">
                            <button type="submit">Добави</button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="container">
                <?php
                    include('./controllers/DatabaseConnection.php');

                    $products = 'SELECT * FROM products WHERE category = "laptops"';
                    $result = $mysqli->query($products);

                    echo '<h2>Списък от лаптопи</h2>';
                    if ($result->num_rows > 0) { ?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Категория</th>
                                <th>Марка</th>
                                <th>Модел</th>
                                <th>Видео карта</th>
                                <th>Процесор</th>
                                <th>RAM памет</th>
                                <th>Памет</th>
                                <th>Екран</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                            <?php
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['subcategory']; ?></td>
                                    <td><?php echo $row['brand']; ?></td>
                                    <td><?php echo $row['model']; ?></td>
                                    <td><?php echo $row['gpu']; ?></td>
                                    <td><?php echo $row['cpu']; ?></td>
                                    <td><?php echo $row['ram']; ?></td>
                                    <td><?php echo $row['storage']; ?>GB</td>
                                    <td><?php echo $row['screen_size']; ?>"</td>
                                    <td><?php echo $row['price']; ?>лв.</td>
                                    <td>
                                        <button class="crud-btn edit" data-id="<?php echo $row['id']; ?>">Промени</button>

                                        <form method="post" action="./controllers/DeleteProduct.php" onsubmit="return confirm('Сигурен ли сте, че искате да изтриете този продукт?');" class="delete-form">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="crud-btn delete">Изтрий</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="edit-form" data-id="<?php echo $row['id']; ?>">
                                    <form method="post" action="./controllers/EditProduct.php">
                                        <td><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                                        <td><input type="text" name="subcategory" readonly value="<?php echo $row['subcategory']; ?>"></td>
                                        <td><input type="text" name="brand" value="<?php echo $row['brand']; ?>"></td>
                                        <td><input type="text" name="model" value="<?php echo $row['model']; ?>"></td>
                                        <td><input type="text" name="gpu" value="<?php echo $row['gpu']; ?>"></td>
                                        <td><input type="text" name="cpu" value="<?php echo $row['cpu']; ?>"></td>
                                        <td><input type="text" name="ram" value="<?php echo $row['ram']; ?>"></td>
                                        <td><input type="text" name="storage" value="<?php echo $row['storage']; ?>"></td>
                                        <td><input type="text" name="screen-size" value="<?php echo $row['screen_size']; ?>"></td>
                                        <td><input type="text" name="price" value="<?php echo $row['price']; ?>"></td>
                                        <td>
                                            <button type="reset" class="crud-btn cancel">Отмени</button>
                                            <button type="submit" class="crud-btn save">Запази</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php } ?>
                        </table> 
                    <?php
                    } else {
                        echo "Не са намерени продукти";
                    }
                    ?>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const editButtons = document.querySelectorAll('.edit');

                        editButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const productId = this.getAttribute('data-id');
                                const editForm = document.querySelector('.edit-form[data-id="' + productId + '"]');
                                if (editForm) {
                                    editForm.style.display = editForm.style.display === 'none' ? 'table-row' : 'none';
                                }
                            });
                        });
                    });
                </script>
            </div>
        </main>
    <?php } ?>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
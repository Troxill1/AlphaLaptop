<?php
    include('DatabaseConnection.php');

    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $cpu = $_POST['cpu'];
    $gpu = $_POST['gpu'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $screenSize = $_POST['screen-size'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (category, subcategory, brand, model, price, gpu, cpu, ram, storage, screen_size, image)
            VALUES ('$category', '$subcategory', '$brand', '$model', '$price', '$gpu', '$cpu', '$ram', '$storage', '$screenSize', '$image')";
    $mysqli->query($sql);

    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");

    $mysqli->close();
?>
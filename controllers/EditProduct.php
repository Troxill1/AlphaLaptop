<?php
    include('DatabaseConnection.php');
    
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $cpu = $_POST['cpu'];
    $gpu = $_POST['gpu'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $screenSize = $_POST['screen-size'];
    $price = $_POST['price'];

    $editProduct = "UPDATE products SET brand = '$brand', model = '$model', price = '$price', gpu = '$gpu',
        cpu = '$cpu', ram = '$ram', storage = '$storage', screen_size = '$screenSize' WHERE id = '$id'";
    $mysqli->query($editProduct);

    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");

    $mysqli->close();
?>
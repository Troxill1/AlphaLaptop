<?php
    include("./controllers/EmptyCart.php");
    include('DisplayHeaderFooter.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alpha Laptop</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        main {
            text-align: center;
            margin: 100px 0 400px;
            font-size: 25px;
            color: #04AA6D;
        }

        main p {
            font-size: 22px;
            color: #000;
        }
    </style>
    
    <script src="./controllers/Navigation.js"></script>
</head>

<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1>Успешна заявка</h1>
        <p>Поръчката Ви е на път</p>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>

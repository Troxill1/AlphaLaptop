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
    <meta name="description" content="We provide the latest laptops in every category. From portable notebooks to powerful gaming machines.">
    <meta name="author" content="Todor Gerdzhikov">
    <meta name="keywords" content="laptop, portable computer, notebook, gaming">
    <meta name="robots" content="index, follow">

    <title>Alpha Laptop</title>

    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./controllers/Navigation.js"></script>
</head>
<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <div class="carousel">
            <div class="slide">
                <img src="./images/asus_rog_strix_g16.png" alt="Изображение 1">
            </div>
            <div class="slide">
                <img src="./images/apple_macbook_pro.png" alt="Изображение 2">
            </div>
            <div class="slide">
                <img src="./images/lenovo_ideapad_slim_5.png" alt="Изображение 3">
            </div>
            <div class="slide">
                <img src="./images/razer_blackshark_v2_pro.png" alt="Изображение 4">
            </div>
            <div class="slide">
                <img src="./images/logitech_g413_tkl_se.png" alt="Изображение 5">
            </div>
        </div>

        <script>
            const carousel = document.querySelector('.carousel');
            const slides = document.querySelectorAll('.slide');
            let currentIndex = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                slide.style.transform = `translateX(-${index * 100}%)`;
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slides.length;
                showSlide(currentIndex);
            }

            setInterval(nextSlide, 3000);
        </script>

        <h1 class="section-header">Гейминг Лаптопи</h1>
        <section>
            <?php displayProducts('Gaming', 'Лаптоп'); ?>
        </section>

        <h1 class="section-header">Бизнес Лаптопи</h1>
        <section>
            <?php displayProducts('Business', 'Лаптоп'); ?>
        </section>

        <h1 class="section-header">Ежедневни Лаптопи</h1>
        <section>
            <?php displayProducts('Everyday', 'Лаптоп'); ?>
        </section>

        <h1 class="section-header">Слушалки</h1>
        <section>
            <?php displayProducts('Headphones', 'Слушалки'); ?>
        </section>

        <h1 class="section-header">Клавиатури</h1>
        <section>
            <?php displayProducts('Keyboards', 'Клавиатура'); ?>
        </section>

        <h1 class="section-header">Мишки</h1>
        <section>
            <?php displayProducts('Mice', 'Мишка'); ?>
        </section>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
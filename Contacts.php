<?php
    include('DisplayHeaderFooter.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alpha Laptop - Контакти</title>

    <link rel="stylesheet" type="text/css" href="./styles/Contacts.css">
    <link rel="stylesheet" type="text/css" href="./styles/HeaderFooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./controllers/Navigation.js"></script>
    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var message = document.getElementById('message').value;
            var errorMessage = document.getElementById('error-message');

            if (name.trim() === '') {
                errorMessage.innerHTML = 'Името е задължително поле';
                return false;
            }

            if (message.trim() === '') {
                errorMessage.innerHTML = 'Съобщението е задължително поле';
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <header class="nav">
        <?php displayHeader(); ?>
    </header>

    <main>
        <h1>Контакти</h1>

        <section class="contact-info">
            <h2>Свържете се с нас</h2>
            <ul>
                <li><strong>Имейл:</strong> alpha.laptop.info@gmail.com</li>
                <li><strong>Телефон:</strong> +359 896 834 536</li>
                <li><strong>Адрес:</strong> Пловдив, България</li>
            </ul>
        </section>
        <section class="map">
            <h2>Локация</h2>
            <div id="googleMap" style="width: 100%; height: 400px;"></div>
            <script>
                function initMap() {
                    var location = {lat: 42.1354, lng: 24.7453};
                    var map = new google.maps.Map(document.getElementById('googleMap'), {
                        zoom: 10,
                        center: location
                    });
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxpym10dbimOuz99bIMt9gxXy_4-jLXQQ&callback=initMap" async defer></script>
        </section>
        <section class="contact-form">
            <h2>Изпратете ни съобщение</h2>

            <?php
                if (isset($_SESSION['user_id'])) {
                    echo'
                    <form action="./controllers/SendMessage.php" method="POST" onsubmit="return validateForm();">
                        <p id="error-message"></p>

                        <label for="name">Име</label>
                        <input type="text" id="name" name="name">

                        <label for="message">Съобщение</label>
                        <textarea id="message" name="message" rows="4"></textarea>
                        
                        <button type="submit">Изпрати</button>
                    </form>';
                } else {
                    echo '
                    <p id="error-message">Впишете се, за да пращате съобщения</p>

                    <label for="name">Име</label>
                    <input type="text" readonly>

                    <label for="message">Съобщение</label>
                    <textarea rows="4" readonly></textarea>
                    
                    <button>Изпрати</button>';
                }
            ?>
        </section>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>

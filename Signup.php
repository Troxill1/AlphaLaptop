<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Laptop</title>
    <link rel="stylesheet" href="./styles/Login.css">

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('cpassword').value;
            var policyCheckBox = document.getElementById('policy');
            var errorMessage = document.getElementById('error-message');

            const letterRegex = /^[A-Za-z\d]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

            if (email.trim() === '' || username.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
                errorMessage.innerHTML = 'Всички полета са задължителни';
                return false;
            }

            if (!emailRegex.test(email)) {
                errorMessage.innerHTML = 'Невалиден имейл адрес';
                return false;
            }

            if (!letterRegex.test(username)) {
                errorMessage.innerHTML = 'Името трябва да е само с латински букви';
                return false;
            }

            if (!passwordRegex.test(password) || !passwordRegex.test(confirmPassword)) {
                errorMessage.innerHTML = 'Паролата трябва да има поне 1 малка и 1 главна буква, 1 цифра и минимум 8 символа дължина';
                return false;
            }

            if (password != confirmPassword) {
                errorMessage.innerHTML = 'Паролите не съвпадат';
                return false;
            }

            if (!policyCheckBox.checked) {
                errorMessage.innerHTML = 'Трябва да се съгласите с Политиката за поверителност';
                return false;
            }

            return true;
        }

        function showPolicy() {
            document.getElementById('policy-popup').style.display = 'block';
        }   

        function hidePolicy() {
            document.getElementById('policy-popup').style.display = 'none';
        }
    </script>
</head>
<body background="./images/background.jpg">
    <div class="form">
        <form action="./controllers/CreateAccount.php" method="POST" onsubmit="return validateForm();">
            <fieldset style="width: 300px;">
                <h1>Регистрация</h1>

                <label for="email">Имейл</label>
                <input id="email" name="email">

                <label for="username">Потребителско име</label>
                <input type="text" id="username" name="username">

                <label for="password">Парола</label>
                <input type="password" id="password" name="password">

                <label for="cpassword">Потвърди паролата</label>
                <input type="password" id="cpassword" name="cpassword">

                <div id="flex-div">
                    <input type="checkbox" id="policy">
                    <div>
                        <label for="policy">Съгласен съм с </label>
                        <a onclick="showPolicy()">Политиката за поверителност</a>
                    </div>
                </div>
                
                <p id="error-message"></p>

                <button type="submit">Създай акаунт</button>
                
                <p>Вече имаш акаунт? <a href="Login.php">Впиши се</a></p>
            </fieldset>
        </form>
    </div>
    <div id="policy-popup">
        <span class="close" onclick="hidePolicy()">&times;</span>

        <h1>Политика за поверителност</h1>
        <p>
            Тази Политика за поверителност обяснява как Alpha Laptop събира, използва и защитава информацията, която предоставяте при използването на нашия уебсайт.
            Препоръчваме ви да прегледате тази Политика за поверителност преди да използвате нашатите услуги.
        </p>

        <h2>Събиране и Използване на Информация</h2>
        <p>
            Можем да събираме различни видове информация, включително лични данни като име, имейл адрес, адрес за доставка, данни за плащане и други, за да подобрим нашите услуги.
        </p>

        <h2>Използване на Данните</h2>
        <p>
            Alpha Laptop използва събраната информация за цели като:
            <ul>
                <li>Предоставяне и поддържане на услугите.</li>
                <li>Подобряване и персонализиране на услугите.</li>
                <li>Свързване с вас относно нашите продукти, промоции и услуги.</li>
            </ul>
        </p>

        <h2>Защита на Данните</h2>
        <p>
            Приемаме подходящи мерки за защита на вашите данни, но имайте предвид, че нито един метод на предаване през интернет или електронно съхранение не е напълно сигурен.
            Въпреки че се стремим да защитим вашата лична информация, не можем да гарантираме нейната абсолютна сигурност.
        </p>

        <h2>Промени в тази Политика за поверителност</h2>
        <p>
            Alpha Laptop може периодично да актуализира тази Политика за поверителност. Всякакви промени ще бъдат публикувани на тази страница.
            Съветваме ви да преглеждате тази Политика за поверителност периодично за всякакви актуализации или промени.
        </p>

        <h2>Свържете се с Нас</h2>
        <p>
            Ако имате въпроси или притеснения относно нашата Политика за поверителност, моля, свържете се с нас:
            <br>Имейл: alpha.laptop.info@gmail.com
            <br>Телефон: +359 896 834 536
            <br>Адрес: Пловдив, България
        </p>
    </div>
</body>
</html>
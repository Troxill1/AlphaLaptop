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
            var password = document.getElementById('password').value;
            var errorMessage = document.getElementById('error-message');

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

            if (email.trim() === '' || password.trim() === '') {
                errorMessage.innerHTML = 'Всички полета са задължителни';
                return false;
            }

            if (!emailRegex.test(email)) {
                errorMessage.innerHTML = 'Невалиден имейл адрес';
                return false;
            }

            if (!passwordRegex.test(password)) {
                errorMessage.innerHTML = 'Невалидна парола';
                return false;
            }

            return true;
        }
    </script>
</head>
<body background="./images/background.jpg">
    <div class="form">
        <form action="./controllers/LoginCheck.php" method="post" onsubmit="return validateForm();">
            <fieldset style="width: 300px;">
                <h1>Вписване</h1>

                <label for="email">Имейл</label>
                <input id="email" name="email">

                <label for="password">Парола</label>
                <input type="password" id="password" name="password">

                <p id="error-message"></p>

                <button type="submit">Продължи</button>

                <p>Нямаш акаунт? <a href="Signup.php">Регистрирай се</a></p>
                <a href="./">Продължи като гост</a>
            </fieldset>
        </form>
    </div>
</body>
</html>
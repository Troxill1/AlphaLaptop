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
    <link rel="stylesheet" type="text/css" href="./styles/Profile.css">
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

            $user_id = $_SESSION['user_id'];
            $getUserInfo = "SELECT * FROM accounts WHERE id = '$user_id'";
            $userInfo = $mysqli->query($getUserInfo)->fetch_assoc();
        ?>

        <form class="container" action="./controllers/EditProfile.php" method="POST">
            <h1>Моят профил</h1>   

            <label for="username">Потребителско име</label>
            <input id="username" name="username" value="<?php echo $userInfo['username']; ?>" readonly>
            <i class="fas fa-edit" onclick="editField('username')" id="edit-button-1"></i>

            <label for="email">Имейл</label>
            <input type="email" id="email" name="email" value="<?php echo $userInfo['email']; ?>" readonly>
            <i class="fas fa-edit" onclick="editField('email')" id="edit-button-2"></i>

            <label for="current-password">Парола</label>
            <input type="password" id="current-password" name="current-password" readonly>
            <i class="fas fa-edit" onclick="editField('current-password')" id="edit-button-3"></i>
            
            <label for="new-password" id="new-password-label">Нова парола</label>
            <input type="password" id="new-password" name="new-password">

            <div>
                <button type="reset" onclick="resetField()" id="reset-button">Отмени</button>
                <button type="submit" onclick="resetField();" id="submit-button">Запази</button>
            </div>
        </form>

        <script>
            function editField(inputFieldId) {
                let inputField = document.getElementById(inputFieldId);              
                inputField.removeAttribute("readonly");
            }

            function resetField() {
                for (let i = 0; i < 3; i++) {
                    let inputField = document.querySelectorAll('.container input')[i];
                    inputField.readOnly = true;
                }
            }
        </script>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
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
    <link rel="stylesheet" type="text/css" href="./styles/ViewAccounts.css">
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
            <?php
                include('./controllers/DatabaseConnection.php');

                $users = 'SELECT id, email, username FROM accounts WHERE admin = 0';
                $fetched_users = $mysqli->query($users);

                ?> <h2>Потребителски акаунти</h2> <?php
                if ($fetched_users->num_rows > 0) { ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Потребителско име</th>
                            <th>Имейл</th>
                        </tr>
                    <?php
                    while ($row = $fetched_users->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                    <?php } ?>
                    </table> <?php
                } else {
                    echo "Не са намерени регистрирани потребители";
                }
            ?>
        </main>
    <?php } ?>

    <footer>
        <?php displayFooter(); ?>
    </footer>
</body>
</html>
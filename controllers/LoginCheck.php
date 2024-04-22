<?php
    include('DatabaseConnection.php');
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkCredentialsQuery = "SELECT id, username, password, picture, admin FROM accounts WHERE email = ?";

    $checkCredentials = $mysqli->prepare($checkCredentialsQuery);
    $checkCredentials->bind_param('s', $email);
    $checkCredentials->execute();
    $checkCredentials->bind_result($user_id, $username, $hashedPassword, $picture, $admin);

    if ($checkCredentials->fetch() && password_verify($password, $hashedPassword)) {
        session_start();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['profile_picture'] = $picture;
        $_SESSION['admin'] = $admin;
        
        $checkCredentials->close();
        header("Location: ../");
    } else {
        header("Location: ../Login.php");
    }

    $mysqli->close();
?>
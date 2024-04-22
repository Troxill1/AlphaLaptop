<?php
    include('DatabaseConnection.php');
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $admin = false;

    $sql = "INSERT INTO accounts (email, username, password, admin)
        VALUES ('$email', '$username', '$hashedPassword', '$admin')";
    $mysqli->query($sql);

    header("Location: ../Login.php");

    $mysqli->close();
?>
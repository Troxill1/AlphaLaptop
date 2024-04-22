<?php
    include('DatabaseConnection.php');
    
    session_start();
    
    $id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $getPassword = "SELECT password FROM accounts WHERE id = '$id'";
    $password = $mysqli->query($getPassword)->fetch_assoc();
    $password = $password['password'];

    $editProfile = "UPDATE accounts SET username = '$username', email = '$email' WHERE id = '$id'";
    $mysqli->query($editProfile);
    $_SESSION['username'] = $username;

    if (password_verify($currentPassword, $password)) {
        $editPassword = "UPDATE accounts SET password = '$newPassword' WHERE id = '$id'";
        $mysqli->query($editPassword);
    }

    $mysqli->close();

    Header("Location: ../Profile.php");
?>
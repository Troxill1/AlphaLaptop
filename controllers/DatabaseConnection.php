<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'alpha_laptop';

    $mysqli = new mysqli($server, $user, $password, $database);

    if ($mysqli->connect_error) {
        header('Location: ../DatabaseError.php');
    }
?>
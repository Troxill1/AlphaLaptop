<?php
    // does not work in Wampserver (localhost)

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_SESSION['email'];
        $message = $_POST['message'];
        
        $to = "alpha.laptop.info@gmail.com";
        $subject = "Съобщение от потребител на Alpha Laptop";
        $body = "Име: $name\nИмейл: $email\n\n$message";
        $headers = "From: $email\r\n";
        $headers .= "Content-type: text/plain; charset=utf-8\r\n";
        
        mail($to, $subject, $body, $headers);
    }
    
    header("Location: ../Contacts.php");
?>
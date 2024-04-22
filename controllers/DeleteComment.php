<?php
    include('DatabaseConnection.php');
    
    $id = $_POST['comment-id'];
    
    $deleteComment = "DELETE FROM comments WHERE id = '$id'";
    $mysqli->query($deleteComment);
    
    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");
    
    $mysqli->close();
?>
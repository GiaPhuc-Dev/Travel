<?php

require_once('../core/config.php');

if(!isset($_GET['id'])){
    header('article.php');
}else{
    $query = $conn->prepare('DELETE FROM article WHERE article_id = :id');
    $query->bindParam(':id', $_GET['id']);
    $query->execute();
    header('location: ./article.php');
}
?>
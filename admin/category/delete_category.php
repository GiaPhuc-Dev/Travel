<?php

require_once('../core/config.php');

if(!isset($_GET['id'])){
    header('category.php');
}else{
    
    $query = $conn->prepare('DELETE FROM category WHERE category_id = :id');
    $query->bindParam(':id', $_GET['id']);
    $query->execute();
  
    header('location: ./category.php');
}
?>
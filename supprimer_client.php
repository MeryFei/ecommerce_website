<?php
    require_once 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('DELETE FROM utilisateur WHERE id=?');
    $supprime = $sqlState->execute([$id]);
    header('location: clients.php');
?>
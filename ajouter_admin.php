<?php
require_once 'include/database.php';

// Définis ici le login et le mot de passe de ton nouvel admin
$login = 'admin';
$password = 'admin';

// Hachage du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insertion dans la base
$sql = $pdo->prepare("INSERT INTO admin (login, password) VALUES (?, ?)");
$sql->execute([$login, $hashedPassword]);

echo "Admin ajouté avec succès.";
?>
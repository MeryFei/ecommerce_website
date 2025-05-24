<?php
session_start();
$connecte = false;
if (isset($_SESSION['admin'])) {
    $connecte = true;
}
if (!isset($_SESSION['admin'])) {
    header('location: login_admin.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Espace Admin</title>
    <style>
        .admin-welcome {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .admin-welcome h1 {
            font-size: 3rem;
            color: #333;
            margin-bottom: 10px;
        }

        .admin-welcome p {
            font-size: 1.3rem;
            color: #555;
        }
    </style>
</head>
<body class="page-index">
<?php include 'include/nav_admin.php' ?>

<div class="admin-welcome">
    <h1>Bienvenue, <?php echo $_SESSION['admin']['login']; ?> 🌸</h1>
    <p>Vous êtes maintenant dans votre espace d'administration </p>
</div>

</body>
</html>

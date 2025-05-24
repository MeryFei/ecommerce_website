<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Connexion</title>
</head>
<body>
 <?php
    $connecte = false;
    if (isset($_SESSION['utilisateur'])) {
        $connecte = true;
    }

    if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];

        if (!empty($login) && !empty($pwd)) {
            require_once 'include/database.php';

            // Récupérer l'utilisateur par login
            $sqlState = $pdo->prepare('SELECT * FROM utilisateur WHERE login = ?');
            $sqlState->execute([$login]);

            if ($sqlState->rowCount() === 1) {
            $utilisateur = $sqlState->fetch();

            // Vérifier le mot de passe hashé
                if (password_verify($pwd, $utilisateur['password'])) {
                    $_SESSION['utilisateur'] = $utilisateur;
                    header('location: ./front/index.php');
                    exit();
                    } else {
                    echo '<div class="alert alert-danger">Mot de passe incorrect.</div>';
                    }
                    } else {
                        echo '<div class="alert alert-danger">Login introuvable.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Login et mot de passe sont obligatoires.</div>';
        }
    }

?>

<?php include 'include/nav.php' ?>

<div class="container py-2">
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-custom">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>

    <h4>Connexion</h4>
    <form method="post">
        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login">

        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">

        <input type="submit" value="Se connecter" class="btn btn-custom-color my-2" name="connexion">
    </form>
</div>

</body>
</html>
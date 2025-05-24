<?php
    session_start(); // Obligatoire avant toute manipulation de $_SESSION
    $connecte = false;
    if (isset($_SESSION['utilisateur'])) {
        $connecte = true;
    }
if (isset($_POST['ajouter'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];
    $pn = $_POST['pn'];

    if (!empty($login) && !empty($pwd) && !empty($email) && !empty($pn)) {
        require_once 'include/database.php';
        $date = date('Y-m-d');

        // Hashage du mot de passe
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

        $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUES(null,?,?,?,?,?)');
        $sqlState->execute([$login, $hashedPassword, $email, $pn, $date]);

        // Définir un message flash
        $_SESSION['success_message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";

        header('Location: connexion.php');
        exit(); 
    } else {
        echo '<div class="alert alert-danger">Veuillez renseigner tous les champs requis !</div>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Inscription</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Register</h4>
    <form method="post" autocomplete="off">
        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login" required>
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
        <label class="form-label">Email</label>
        <input type='email'class='form-control' name="email" required>
        <label class="form-label">Phone number</label>
        <input type='tel'class='form-control' name="pn" required>
        <input type="submit" value="S'inscrire" class="btn btn-custom-color my-2" name="ajouter">
    </form>
</div>

</body>
</html>

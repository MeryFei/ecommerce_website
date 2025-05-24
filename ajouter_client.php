<?php
    session_start();
    $connecte = false;
    if (isset($_SESSION['admin'])) {
        $connecte = true;
    }
    if (isset($_POST['ajouter'])) {
        $login = $_POST['login'];
        $pwd = $_POST['password'];
        $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $pn = $_POST['pn'];


        if (!empty($login) && !empty($pwd) && !empty($email) && !empty($pn)) {
            require_once 'include/database.php';
            $date = date('Y-m-d');
            $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUES(null,?,?,?,?,?)');
            $sqlState->execute([$login, $pwdHashed, $email, $pn, $date]);
            // Redirection
            header('location: clients.php');
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Veuillez renseigner tous les champs requis!
            </div>
            <?php
        }

    }
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Ajouter client</title>
</head>
<body>
<?php include 'include/nav_admin.php' ?>
<div class="container py-2">
    <h4>Ajouter client</h4>
    
    <form method="post" autocomplete="off">
        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login" required>
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
        <label class="form-label">Email</label>
        <input type='email'class='form-control' name="email" required>
        <label class="form-label">Phone number</label>
        <input type='tel'class='form-control' name="pn" required>
        <input type="submit" value="Ajouter client" class="btn btn-add my-2" name="ajouter">
    </form>
</div>

</body>
</html>
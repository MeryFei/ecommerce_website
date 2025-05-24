<?php
    session_start();
    $connecte = false;
    if (isset($_SESSION['admin'])) {
        $connecte = true;
    }
    require_once 'include/database.php';
    $sqlState = $pdo->prepare('SELECT * FROM utilisateur WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $client = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];
    $pn = $_POST['pn'];

    if (!empty($login) && !empty($email) && !empty($pn)) {
        if (!empty($pwd)) {
            // Si un nouveau mot de passe est saisi
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = $pdo->prepare("UPDATE utilisateur SET login=?, password=?, email=?, phone=? WHERE id=?");
            $sql->execute([$login, $hashedPwd, $email, $pn, $id]);
        } else {
            // Si le champ mot de passe est vide, on ne le modifie pas
            $sql = $pdo->prepare("UPDATE utilisateur SET login=?, email=?, phone=? WHERE id=?");
            $sql->execute([$login, $email, $pn, $id]);
        }

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
    <title>Z🥀hra - Modifier client</title>
</head>
<body>
<?php include 'include/nav_admin.php' ?>
<div class="container py-2">
    <h4>Modifier client</h4>
    
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $client['id'] ?>">
        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login" value="<?php echo $client['login'] ?>">

        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Laisser vide pour ne pas modifier">

        <label class="form-label">Email</label>
        <input type='email'class='form-control' name="email" value="<?php echo $client['email'] ?>">

        <label class="form-label">Phone number</label>
        <input type='tel'class='form-control' name="pn" value="<?php echo $client['phone'] ?>">

        <input type="submit" value="Modifier client" class="btn btn-mod my-2" name="modifier">
    </form>
</div>

</body>
</html>
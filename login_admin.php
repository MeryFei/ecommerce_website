
<?php
session_start();
$connecte = false;
if (isset($_SESSION['admin'])) {
    $connecte = true;
}
require_once 'include/database.php';
if (isset($_POST['login'])) {
                $aid = $_POST['aid'];
                $pass = $_POST['pass'];

                if (!empty($aid) && !empty($pass)) {
                    require_once 'include/database.php';

                    $sqlState = $pdo->prepare('SELECT * FROM admin WHERE login=?');
                    $sqlState->execute([$aid]);
                    $admin = $sqlState->fetch(PDO::FETCH_ASSOC);

                    if ($admin && password_verify($pass, $admin['password'])) {
                        $_SESSION['admin'] = $admin;
                        header('location: ./admin.php');
                    } else {
                        echo "<div class='alert alert-danger'>Login ou mot de passe incorrect.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Login et mot de passe sont obligatoires.</div>";
                }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Z🥀hra - Espace Admin</title>
    <link rel="stylesheet" href="adminstyles.css">
    <!---we had linked our css file----->
     <?php include 'head_admin.php' ?>

</head>
<body>
    <div class="full-page">
        <!---navbar-->
        <div class="navbar">
            <div>
                <a href='index.php'>Fl🌸wer</a>
            </div>
            <nav>
                <ul id='MenuItems'>
                    <li><a href='#'>Espace Admin</a></li>
                </ul>
            </nav>
        </div>
        <!---connexion-->
        <div id='login-form'class='login-page' style="display: 'block'">
            <div class="form-box">
                <div class='button-box'>
                    <div id='btn'></div>
                    <button type='button' class='toggle-btn'>Log In</button>
                </div>
                <!---login-->
                <form method="post" id='login' class='input-group-login'>
                    <input type='text'class='input-field'placeholder='Admin Id' name='aid' required >
		             <input type='password'class='input-field'placeholder='Enter Password' name='pass' required>
                        <br></br>
		            <button type='submit'class='submit-btn' name='login' value='login'>Log in</button>
		         </form>
            </div>
        </div>
    </div>
</body>
</html>
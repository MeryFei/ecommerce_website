<!doctype html>
<html lang="fr">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Modifier profil</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-4">
    <h3 class="mb-4">Modifier mon profil</h3>

    <?php
    require_once 'include/database.php';

    // Sécurité : Utilisation de l'ID de session
    $id = $_SESSION['utilisateur']['id'];

    // Récupération des données actuelles
    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        echo '<div class="alert alert-danger">Utilisateur introuvable.</div>';
        exit();
    }

    // Traitement du formulaire
    if (isset($_POST['modifier'])) {
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $pn = trim($_POST['pn']);
        $pwd = $_POST['password'];

        if (!empty($login) && !empty($email) && !empty($pn)) {
            // Si un nouveau mot de passe est saisi, on le met à jour (hashé)
            if (!empty($pwd)) {
                $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE utilisateur SET login=?, password=?, email=?, phone=? WHERE id=?");
                $stmt->execute([$login, $hashedPassword, $email, $pn, $id]);
            } else {
                // Sinon on ne touche pas au mot de passe
                $stmt = $pdo->prepare("UPDATE utilisateur SET login=?, email=?, phone=? WHERE id=?");
                $stmt->execute([$login, $email, $pn, $id]);
            }

            // Mettre à jour la session si le login change
            $_SESSION['utilisateur']['login'] = $login;

            echo '<div class="alert alert-success">Profil mis à jour avec succès.</div>';
            echo '<script>setTimeout(() => window.location.href="profil.php", 1500);</script>';
        } else {
            echo '<div class="alert alert-danger">Veuillez remplir tous les champs (sauf mot de passe).</div>';
        }
    }
    ?>

    <form method="post" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login" value="<?= htmlspecialchars($client['login']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="tel" class="form-control" name="pn" value="<?= htmlspecialchars($client['phone']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <button type="submit" name="modifier" class="btn btn-mod">Modifier le profil</button>
    </form>
</div>
</body>
</html>

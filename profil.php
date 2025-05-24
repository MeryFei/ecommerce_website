<!doctype html>
<html lang="fr">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Profil</title>
    <style>
        .card-profil {
            max-width: 600px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-profil th {
            width: 40%;
        }
    </style>
</head>
<body>
<?php include 'include/nav.php' ?>

<?php
require_once 'include/database.php';
$idUtilisateur = $_SESSION['utilisateur']['id'];

// Récupérer les infos utilisateur
$sql = "SELECT id, login, email, phone, date_creation FROM utilisateur WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idUtilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    echo "<div class='container mt-4 alert alert-danger'>Utilisateur non trouvé.</div>";
    exit();
}
?>

<div class="container py-5">
    <div class="card card-profil p-4 bg-light">
        <h3 class="text-center mb-4 text-custom">Profil de <?= htmlspecialchars($utilisateur['login']) ?></h3>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?= htmlspecialchars($utilisateur['id']) ?></td>
            </tr>
            <tr>
                <th>Login</th>
                <td><?= htmlspecialchars($utilisateur['login']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($utilisateur['email']) ?></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><?= htmlspecialchars($utilisateur['phone']) ?></td>
            </tr>
            <tr>
                <th>Date de création</th>
                <td><?= htmlspecialchars($utilisateur['date_creation']) ?></td>
            </tr>
        </table>
        <div class="text-center mt-3">
            <a href="modifier_profil.php" class="btn btn-mod">Modifier le profil</a>
        </div>
    </div>
</div>

</body>
</html>


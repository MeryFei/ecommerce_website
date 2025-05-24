<?php
session_start();

require_once '../include/database.php';

// Vérifie la connexion utilisateur
$connecte = isset($_SESSION['utilisateur']);

// Récupérer les catégories
$categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);

// Récupération des critères de recherche
$search = $_GET['q'] ?? '';
$categoryId = $_GET['categorie'] ?? '';
$prixMin = $_GET['prix_min'] ?? '';
$prixMax = $_GET['prix_max'] ?? '';
$promo = $_GET['promo'] ?? '';
$tri = $_GET['tri'] ?? '';

// Construction de la requête SQL dynamique
$sql = "SELECT * FROM produit WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND (libelle LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($categoryId)) {
    $sql .= " AND id_categorie = ?";
    $params[] = $categoryId;
}

if (!empty($prixMin) && is_numeric($prixMin)) {
    $sql .= " AND prix >= ?";
    $params[] = $prixMin;
}

if (!empty($prixMax) && is_numeric($prixMax)) {
    $sql .= " AND prix <= ?";
    $params[] = $prixMax;
}

if ($promo === '1') {
    $sql .= " AND discount > 0";
}

// Tri selon le choix
if ($tri === 'asc') {
    $sql .= " ORDER BY prix ASC";
} elseif ($tri === 'desc') {
    $sql .= " ORDER BY prix DESC";
} else {
    $sql .= " ORDER BY date_creation DESC"; // tri par défaut
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produits = $stmt->fetchAll(PDO::FETCH_OBJ);


// index.php?q=rose&categorie=2&prix_min=30&prix_max=100&promo=1&tri=desc   : exemple de fonctionnement de cette logique de recherche avancee

?>

<!doctype html>
<html lang="fr">
<head>
    <?php include '../include/head_front.php' ?>
    <title>Z🥀hra Shop</title>
</head>
<body>
<?php include '../include/nav_front.php' ?>

<div class="container py-4">
    <form method="get" action="index.php" class="mb-4 p-3 border rounded shadow-sm bg-light">
    <div class="row g-3 align-items-center">
        <div class="col-md-4">
            <label for="search" class="form-label visually-hidden">Rechercher</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input type="text" id="search" name="q" class="form-control" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($search) ?>">
            </div>
        </div>

        <div class="col-md-3">
            <label for="categorie" class="form-label visually-hidden">Catégorie</label>
            <select id="categorie" name="categorie" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie->id ?>" <?= ($categoryId == $categorie->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categorie->libelle) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <label for="prix_min" class="form-label visually-hidden">Prix min</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                <input type="number" id="prix_min" name="prix_min" class="form-control" placeholder="Prix min" min="0" value="<?= htmlspecialchars($prixMin) ?>">
            </div>
        </div>

        <div class="col-md-2">
            <label for="prix_max" class="form-label visually-hidden">Prix max</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-dollar   -sign"></i></span>
                <input type="number" id="prix_max" name="prix_max" class="form-control" placeholder="Prix max" min="0" value="<?= htmlspecialchars($prixMax) ?>">
            </div>
        </div>

        <div class="col-md-1 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="promo" id="promo" value="1" <?= ($promo === '1') ? 'checked' : '' ?>>
                <label for="promo" class="form-check-label" title="Produits en promotion">
                    <i class="fa fa-tag text-danger"></i>
                </label>
            </div>
        </div>
    </div>

    <div class="row mt-3 align-items-center">
        <div class="col-md-3">
            <label for="tri" class="form-label">Trier par</label>
            <select id="tri" name="tri" class="form-select">
                <option value="">Date (plus récent)</option>
                <option value="asc" <?= ($tri === 'asc') ? 'selected' : '' ?>>Prix croissant</option>
                <option value="desc" <?= ($tri === 'desc') ? 'selected' : '' ?>>Prix décroissant</option>
            </select>
        </div>
        <div class="col-md-2 mt-2 mt-md-0">
            <button type="submit" class="btn btn-custom-color    w-100">
                <i class="fa fa-filter"></i> Filtrer
            </button>
        </div>
    </div>
    </form>


    <div class="row">
        <div class="col-md-3">
            <ul class="list-group list-group-flush position-sticky sticky-top">
                <h4 class="mt-4"><i class="fa fa-light fa-list"></i> Catégories</h4>
                <li class="list-group-item <?= empty($categoryId) ? 'active  bg-custom' : '' ?>">
                    <a class="btn btn-default w-100" href="./">
                        <i class="fa fa-solid fa-border-all"></i> Tous les produits
                    </a>
                </li>
                <?php foreach ($categories as $categorie): ?>
                    <li class="list-group-item <?= $categoryId == $categorie->id ? 'active  bg-custom' : '' ?>">
                        <a class="btn btn-default w-100" href="index.php?categorie=<?= $categorie->id ?>">
                            <i class="fa <?= $categorie->icone ?>"></i> <?= $categorie->libelle ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col mt-4">
            <div class="row">
                <?php require_once '../include/front/product/afficher_product.php'; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>

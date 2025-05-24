<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Liste des catégories</title>
</head>
<body>
<?php include 'include/nav_admin.php' ?>
<div class="container py-2">
    <h2>Liste des catégories</h2>
    <a href="ajouter_categorie.php" class="btn btn-add">Ajouter catégorie</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Libelle</th>
                <th>Description</th>
                <th>Icone</th>
                <th>Date</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $categorie){
            ?>
            <tr>
                <td><?php echo $categorie['id'] ?></td>
                <td><?php echo $categorie['libelle'] ?></td>
                <td><?php echo $categorie['description'] ?></td>
                <td>
                    <i class="fas <?php echo $categorie['icone'] ?>"></i>
                </td>
                <td><?php echo $categorie['date_creation'] ?></td>
                <td>
                    <div class="d-flex gap-2">
                    <a href="modifier_categorie.php?id=<?php echo $categorie['id'] ?>" class="btn  btn-mod">Modifier</a>
                    <a href="supprimer_categorie.php?id=<?php echo $categorie['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer la catégorie <?php echo $categorie['libelle'] ?>');" class="btn  btn-delet">Supprimer</a>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
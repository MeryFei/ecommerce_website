<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Liste des clients</title>
</head>
<body>
<?php include 'include/nav_admin.php' ?>
<div class="container py-2">
    <h2>Liste des clients</h2>
    <a href="ajouter_client.php" class="btn btn-add">Ajouter client</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Login</th>
                <th>Password</th>
                <th>email</th>
                <th>Phone_number</th>
                <th>date_creation</th>

            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $utilisateurs = $pdo->query('SELECT * FROM utilisateur')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($utilisateurs as $utilisateur){
            ?>
            <tr>
                <td><?php echo $utilisateur['id'] ?></td>
                <td><?php echo $utilisateur['login'] ?></td>
                <td>••••••••</td>
                <td><?php echo $utilisateur['email'] ?></td>
                <td><?php echo $utilisateur['phone'] ?></td>
                <td><?php echo $utilisateur['date_creation'] ?></td>
                <td>
                    <div class="d-flex gap-2">
                    <a href="modifier_client.php?id=<?php echo $utilisateur['id'] ?>" class="btn  btn-mod">Modifier</a>
                    <a href="supprimer_client.php?id=<?php echo $utilisateur['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer le client <?php echo $utilisateur['login'] ?>');" class="btn  btn-delet">Supprimer</a>
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
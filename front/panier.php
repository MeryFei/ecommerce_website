<?php
ob_start();
session_start();
require_once '../include/database.php';
?>
<!doctype html>
<html lang="en">
<head>
    <?php include '../include/head_front.php' ?>
    <title>Z🥀hra - Panier</title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <?php
    //vider panier
    if (isset($_POST['vider'])) {
        $_SESSION['panier'][$idUtilisateur] = [];
        header('location: panier.php');
    }

    $idUtilisateur = $_SESSION['utilisateur']['id'] ?? 0;
    $panier = $_SESSION['panier'][$idUtilisateur] ?? [];
    //panier non vide
    if (!empty($panier)) {
        $idProduits = array_keys($panier);
        $idProduits = implode(',', $idProduits);

        $produits = $pdo->query("SELECT * FROM produit WHERE id IN ($idProduits)")->fetchAll(PDO::FETCH_ASSOC);
    }   //valider la commande
    if (isset($_POST['valider'])) {
        $modePaiement = $_POST['mode_paiement'] ?? 'livraison'; // Valeur par défaut
        $sql = 'INSERT INTO ligne_commande(id_produit,id_commande,prix,quantite,total) VALUES';
        $total = 0;
        $prixProduits = [];
        foreach ($produits as $produit) {
            $idProduit = $produit['id'];
            $qty = $panier[$idProduit];
            $discount = $produit['discount'];
            $prix = calculerRemise($produit['prix'], $discount);

            $total += $qty * $prix;
            $prixProduits[$idProduit] = [
                'id' => $idProduit,
                'prix' => $prix,
                'total' => $qty * $prix,
                'qty' => $qty
            ];
        }
        //ajouter commande
        $sqlStateCommande = $pdo->prepare('INSERT INTO commande(id_client,total,mode_paiement) VALUES(?,?,?)');
        $sqlStateCommande->execute([$idUtilisateur, $total, $modePaiement]);
        $idCommande = $pdo->lastInsertId();
        $args = [];
        foreach ($prixProduits as $produit) {
            $id = $produit['id'];
            $sql .= "(:id$id,'$idCommande',:prix$id,:qty$id,:total$id),";
        }
        $sql = substr($sql, 0, -1);
        $sqlState = $pdo->prepare($sql);
        foreach ($prixProduits as $produit) {
            $id = $produit['id'];
            $sqlState->bindParam(':id' . $id, $produit['id']);
            $sqlState->bindParam(':prix' . $id, $produit['prix']);
            $sqlState->bindParam(':qty' . $id, $produit['qty']);
            $sqlState->bindParam(':total' . $id, $produit['total']);
        }
        $inserted = $sqlState->execute();
        if ($inserted) {

            $_SESSION['panier'][$idUtilisateur] = [];
            header('location: panier.php?success=true&total=' . $total);
        } else {
            ?>
            <div class="alert alert-error" role="alert">
                Erreur (contactez l'administrateur).
            </div>
            <?php
        }
    }
    if (isset($_GET['success'])) {
        ?>
        <h1>Merci ! </h1>
        <div class="alert alert-custom" role="alert">
            Votre commande avec le montant <strong>(<?php echo $_GET['total'] ?? 0 ?>)</strong> <i class="fa fa-solid fa-dollar"></i> est bien ajoutée.
        </div>
        <hr>
        <?php
    }
    if (!isset($_GET['success'])) {

        ?>
        <h4>Panier (<?php echo $productCount; ?>)</h4>
        <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <?php
            if (empty($panier)) {   //panier vide
                if (!isset($_GET['success'])) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Votre panier est vide !
                        Commençez vos achats <a class="btn btn-custom-color btn-sm" href="./index.php">Acheter des
                            produits</a>
                    </div>
                    <?php
                }
            } else {

                ?>
                <table class="table">   <!-- afficage du produits commander -->
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Remise</th>
                        <th scope="col"><i class="fa fa-percent"></i> prix remise</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <?php
                    $total = 0;
                    foreach ($produits as $produit) {
                        $idProduit = $produit['id'];
                        $totalProduit = calculerRemise($produit['prix'], $produit['discount']) * $panier[$idProduit];
                        $total += $totalProduit;
                        ?>
                        <tr>
                            <td><?php echo $produit['id'] ?></td>
                            <td><img width="80px" src="../upload/produit/<?php echo $produit['image'] ?>" alt=""></td>
                            <td><?php echo $produit['libelle'] ?></td>
                            <td><?php include '../include/front/counter.php' ?></td>
                            <td><strike><?php echo $produit['prix'] ?> <i class="fa fa-solid fa-dollar"></i></strike></td>
                            <td> - <?= $produit['discount'] ?> %</td>
                            <td><?php echo calculerRemise($produit['prix'], $produit['discount']) ?> <i class="fa fa-solid fa-dollar"></i></td>
                            <td> <?php echo $totalProduit ?> <i class="fa fa-solid fa-dollar"></i></td>
                        </tr>

                        <?php
                    }
                    ?>
                    <tfoot>
                    <tr>
                        <td colspan="7" align="right"><strong>Total</strong></td>
                        <td><?php echo $total ?> <i class="fa fa-solid fa-dollar"></i></td>
                    </tr>
                    <tr>
                        <tr>
                            <td colspan="8">
                            <form method="post" class="text-center">
                                <!-- Option de paiement -->
                                <div class="mb-3">
                                    <label class="form-label d-block"><strong>Mode de paiement :</strong></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mode_paiement" id="livraison" value="livraison" checked required>
                                        <label class="form-check-label" for="livraison">Paiement à la livraison</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mode_paiement" id="carte" value="carte" required>
                                        <label class="form-check-label" for="carte">Carte bancaire</label>
                                    </div>
                                </div>

                                <!-- Boutons -->
                                <div class="mb-2">
                                    <input type="submit" class="btn btn-add me-2" name="valider" value="Valider la commande">
                                    <input onclick="return confirm('Voulez vous vraiment vider le panier ?')" type="submit"
                                        class="btn btn-delet" name="vider" value="Vider le panier">
                            </form>
                            </td>
                        </tr>

                    </tr>
                    </tfoot>
                </table>
                <?php
            }
            ob_end_flush();
            ?>
        </div>
        <?php if (!empty($panier)) { ?> <!-- button pour continuer les achats  -->
        <div class="text-center mt-4">
            <a href="index.php"
                class="btn btn-custom-color"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Retour à la boutique pour ajouter d'autres articles">
                <i class="fa fa-arrow-left"></i> Continuer vos achats
            </a>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    // Initialisation des tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

</body>
</html>
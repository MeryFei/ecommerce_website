<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $connecte = false;
    if (isset($_SESSION['admin'])) {
        $connecte = true;
    }
}
?>
<style>
    .custom-navbar {
    background-color:white ; 
    }

    .custom-navbar .navbar-brand,
    .custom-navbar .nav-link,
    .custom-navbar .btn {
        color:#6b4f1d; 
    }

    .custom-navbar .nav-link:hover,
    .custom-navbar .btn:hover {
        color:#a37b22; 
    }

    .navbar-toggler {
        border-color:#6b4f1d;
    }

    .navbar-toggler-icon {
        filter: invert(40%) sepia(65%) saturate(500%) hue-rotate(30deg);
    }

    body {
    padding-top: 70px;
    background-image: url('images/yelo.jpg');    
    background-size: cover;
    background-position: center;    
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-color:rgba(251, 232, 246, 0.8);
    }

    body.page-index {
            background-image: url('images/spc.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
    }

    .btn-add {
    background-color: rgb(96, 181, 85); /* vert pastel clair */
    color: #fff; /* texte blanc */
    border-color: #9acb94;
    }

    .btn-add:hover {
    background-color: #91c87f;
    border-color: #86bf72;
    color: #fff;
    }

    .bg-add {
    background-color: rgb(96, 181, 85) !important; /* vert pastel clair */
    color: white !important;
    }

    .btn-mod {
    background-color: rgb(234, 152, 31); /* vert pastel clair */
    color: #fff; /* texte blanc */
    border-color:rgb(203, 191, 148);
    }

    .btn-mod:hover {
    background-color:rgb(240, 189, 117);
    border-color:rgb(246, 221, 172);
    color: #fff;
    }

    .bg-mod {
    background-color: rgb(181, 152, 85)!important; /* vert pastel clair */
    color: white !important;
    }
    
    .btn-delet {
    background-color: rgb(238, 75, 91); /* vert pastel clair */
    color: #fff; /* texte blanc */
    border-color: rgb(251, 132, 132);
    }

    .btn-delet:hover {
    background-color: rgb(255, 122, 135);
    border-color:rgb(234, 178, 178);
    color: #fff;
    }

     .bg-delet {
    background-color: rgb(238, 75, 91) !important; /* vert pastel clair */
    color: white !important;
    }

    /* color personnalisé */
    .text-custom {
        color:rgb(3, 0, 0); 
    }

    .btn-custom-color{
        color:rgb(245, 245, 245);
        border: 1px solid rgb(237, 22, 111);
        background-color:rgb(237, 22, 111) ;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-custom-color:hover {
        background-color: rgb(218, 194, 88);
        color: white;
    }

    .alert-custom {
    background-color:rgb(244, 240, 160); /* couleur jaune/orange */
    color: rgb(38, 3, 33);               /* texte foncé */
    border: 1px solid rgb(240, 75, 135)
    }
</style>
<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Z🥀hra </a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        $currentPage = $_SERVER['PHP_SELF'];
        ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/ecommerce/admin.php') echo 'active' ?>"
                       aria-current="page" href="admin.php"><i class="fa-solid fa-home"></i> Accueil</a>
                </li>
                <?php
                if ($connecte) {
                ?>
                    <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/ecommerce/clients.php') echo 'active' ?>"
                       aria-current="page" href="clients.php"><i class="fa-solid fa-user-gear"></i>
                        Gestion des clients</a> 
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/categories.php') echo 'active' ?>"
                           aria-current="page" href="categories.php"><i
                                    class="fa-brands fa-dropbox"></i> Liste des catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/produits.php') echo 'active' ?>"
                           aria-current="page" href="produits.php"><i class="fa-solid fa-tag"></i>
                            Liste des produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/commandes.php') echo 'active' ?>"
                           aria-current="page" href="commandes.php"><i
                                    class="fa-solid fa-barcode"></i> Commandes</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/connexion.php') echo 'active' ?>"
                           href="connexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Connexion</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
            if($connecte) {
         ?>
            <a class="btn float-end" aria-current="page" href="deconnexion_admin.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
        <?php
             }
        ?>
    </div>
</nav>
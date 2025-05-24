<?php
$connecte = false;
if (isset($_SESSION['utilisateur'])) {
    $connecte = true;
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
    background-image: url('../images/gradi.jpg');    
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-color:rgba(251, 232, 246, 0.8);
    }

    .btn-vert-pastel {
    background-color: rgb(96, 181, 85); /* vert pastel clair */
    color: #fff; /* texte blanc */
    border-color: #9acb94;
    }

    .btn-vert-pastel:hover {
    background-color: #91c87f;
    border-color: #86bf72;
    color: #fff;
    }

    .bg-vert-pastel {
    background-color: rgb(96, 181, 85) !important; /* vert pastel clair */
    color: white !important;
    }

    .btn-bleu-pastel {
    background-color: rgb(62, 206, 204); /* vert pastel clair */
    color: #fff; /* texte blanc */
    border-color:rgb(148, 197, 203);
    }

    .btn-bleu-pastel:hover {
    background-color:rgb(127, 195, 200);
    border-color:rgb(114, 191, 190);
    color: #fff;
    }

     .bg-bleu-pastel {
    background-color: rgb(85, 181, 163) !important; /* vert pastel clair */
    color: white !important;
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
    
     /* colors personnalisé */
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
        background-color: rgb(162, 196, 28);
        color: white;
    }

    .bg-custom {
    background-color:rgb(237, 22, 111)!important; 
    color: white !important; 
    }

    .bg-custom a, .bg-custom a:visited, .bg-custom a:focus, .bg-custom a:hover {
        color: white !important;
        text-decoration: none;
    }

    .alert-custom {
    background-color:rgb(244, 240, 160); 
    color: rgb(38, 3, 33);          
    border: 1px solid rgb(240, 75, 135);
    }

    .text-bg-custom {
    color: #000; 
    background-color: #f8c8dc; /
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem; 
    display: inline-block; 
    }
    .text-bg-custom2 {
    color: #000; 
    background-color:rgb(200, 248, 216); /s
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem; 
    display: inline-block; 
    }
    .text-bg-custom3 {
    color: #fff; 
    background-color:rgb(253, 84, 0); /
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem; 
    display: inline-block; 
    }
    .text-bg-custom4 {
    color: #fff; 
    background-color:rgb(233, 36, 85); /
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem; 
    display: inline-block; 
    }

    .btn-custom-pink {
    background-color: #f8c8dc;
    color: #000;
    border: 1px solid #f4a6c0;
    transition: 0.3s ease;
    }


</style>

<nav class="navbar navbar-expand-lg  custom-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Z🥀hra </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if($connecte) {
                    ?>
                    <a class="nav-link active" aria-current="page" href="index.php">Bienvenu(e) <?php echo $_SESSION['utilisateur']['login']; ?> 💐</a>
                    <?php } else {
                    ?>
                    <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/ecommerce/index.php') echo 'active' ?>"
                       aria-current="page" href="../index.php"><i class="fa-solid fa-home"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/connexion.php') echo 'active' ?>"
                           href="../connexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Connexion</a>
                    </li>
                    <?php
                }
                ?>
                    
                </li>
            </ul>
        </div>
        <?php

        $productCount = 0;
        if (isset($_SESSION['utilisateur'])) {
            $idUtilisateur = $_SESSION['utilisateur']['id'];
            $productCount = count($_SESSION['panier'][$idUtilisateur] ?? []);
        }
        function calculerRemise($prix, $discount)
        {
            return $prix - (($prix * $discount) / 100);
        }

        ?>
        <?php
                if ($connecte) {
         ?>
        <a class="btn float-end" href="../profil.php"><i
                    class="fa-solid fa-user"></i> Profil</a>
         <?php   }  
         ?>

        <a class="btn float-end" href="panier.php"><i class="fa-solid fa-cart-shopping"></i> Panier
            (<?php echo $productCount; ?>)</a>
    </div>
</nav>

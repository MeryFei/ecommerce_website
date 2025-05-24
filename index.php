<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Z🥀hra - Accueil </title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Quicksand&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('images/log.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Quicksand', sans-serif;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px);
            padding: 20px;
        }

        .intro-text {
            background-color: rgba(255, 255, 255, 0.85);
            color: #3a3a3a;
            padding: 40px;
            border-radius: 12px;
            max-width: 700px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .logo {
            width: 120px;
            margin-bottom: 15px;
        }

        .intro-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            margin-bottom: 20px;
            color: #c94f7c;
        }

        .intro-text p {
            font-size: 1.2rem;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: bold;
            color: white;
            background-color: #c94f7c;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            background-color: #a93c65;
            color:white;
        }
        .logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    gap: 10px;
}

.logo-icon {
    width: 40px;
    height: 40px;
}

.logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 500;
    color: #c94f7c;
    text-transform: lowercase;
    letter-spacing: 1px;
}

        
    </style>
</head>
<body class="page-index">
    <?php include 'include/nav.php' ?>

    <div class="centered-container">
        <div class="intro-text">
            <!-- Logo -->
           <div class="logo-container">
            <span class="logo-text">Z</span>
            <!-- <span class="logo-text">🌸</span>-->
             <img src="images/zahra.png" alt="Flower Icon" class="logo-icon">
             <span class="logo-text">hra</span>
            </div>

            <!-- Title -->
            
            <p>
                Bienvenue chez <strong>Zahra</strong> — votre boutique florale dédiée à la beauté naturelle et à l’élégance.  
                Nous créons des compositions uniques pour vos moments précieux : mariages, anniversaires, événements ou simples attentions.
                Laissez-vous envoûter par la poésie des fleurs.
            </p>
            <a href="./front/index.php" class="cta-button">Voir nos bouquets</a>
        </div>
    </div>
</body>
</html>


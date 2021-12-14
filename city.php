<?php

    require 'assets/class/data.php';

    $data = new Data();

    if (isset($_GET['cp_search'])){
        $stations = $data->getStationsByZipCode($_GET['cp_search']);
    }

?>
<html>
<head>
    <title>
        Prix par ville
    </title>
    <meta charset="utf8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/city.css">
</head>
<body>
    <div class="container">
        <nav>
            <img src="assets/img/LogoMakr-9aPtIx.png" height="80px" width="325px">
            <div class="nav-link">
                <a href="index.php" class="hover-underline-animation">Accueil</a>
                <a href="city.php" class="hover-underline-animation">Prix par ville</a>
                <a href="/near/" class="hover-underline-animation">Stations à côté de vous</a>
            </div>
        </nav>
        <div class="content">
            <div class="content-box search-box">
                <form method="get" action="city.php">
                    <input type="number" name="cp_search" placeholder="Code postal :">
                    <button type="submit">Rechercher</button>
                </form>
            </div>
            <?php if (isset($_GET['cp_search'])){ ?>
            <div class="content-box">
                <?php foreach ($stations as $station){ ?>
                    <h2>Station de <?php print($station['ville']); ?> situé sur <?php print($station['adresse']); ?> : </h2>
                <?php if(array_key_exists('prix', $station)){
                        foreach ($station['prix'] as $station_prix) {
                            print '<h3>' . $station_prix['@nom'] . ' : ' . $station_prix['@valeur'] . '€' . '</h3>';
                        }
                    }else{
                        print '<h3>Aucun carburant n\'est disponible à cette station</h3>';
                    }
                }
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php

    require 'assets/class/data.php';

    $data = new Data();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Accueil
        </title>
        <meta charset="utf8">
        <meta name="viewport" content="initial-scale=1.0, width=device-width">
        <link rel="stylesheet" href="assets/css/index.css">
    </head>
    <body>
        <div class="container">
            <nav>
                <img src="assets/img/LogoMakr-9aPtIx.png" height="80px" width="325px">
                <div class="nav-link">
                    <a href="/" class="hover-underline-animation">Accueil</a>
                    <a href="city.php" class="hover-underline-animation">Prix par ville</a>
                    <a href="/near/" class="hover-underline-animation">Stations à côté de vous</a>
                </div>
            </nav>
            <div class="content">
                <div class="content-box actualisation">
                    <h1>Dernière actualisation</h1>
                    <h3><?php print($data->dataGetLastUpdated()[0]) . ' à ' . $data->dataGetLastUpdated()[1]; ?></h3>
                </div>
                <div class="content-box price">
                    <h1>Carburant le moins chère en france en ce moment</h1>
                    <h3>Gazole : <?php print($data->dataPricelessFuel()[0]['prix'] . ' centimes d\'€ au ' . $data->dataPricelessFuel()[0]['adresse'] . ', ' . $data->dataPricelessFuel()[0]['ville']) . ' (' . $data->dataPricelessFuel()[0]['cp'] . ')';  ?></h3>
                    <h3>SP95 : <?php print($data->dataPricelessFuel()[1]['prix'] . ' centimes d\'€ au ' . $data->dataPricelessFuel()[1]['adresse'] . ', ' . $data->dataPricelessFuel()[1]['ville']) . ' (' . $data->dataPricelessFuel()[1]['cp'] . ')'; ?></h3>
                    <h3>SP98 : <?php print($data->dataPricelessFuel()[2]['prix'] . ' centimes d\'€ au ' . $data->dataPricelessFuel()[2]['adresse'] . ', ' . $data->dataPricelessFuel()[2]['ville']) . ' (' . $data->dataPricelessFuel()[2]['cp'] . ')'; ?></h3>
                    <h3>E85 : <?php print($data->dataPricelessFuel()[3]['prix'] . ' centimes d\'€ au ' . $data->dataPricelessFuel()[3]['adresse'] . ', ' . $data->dataPricelessFuel()[3]['ville']) . ' (' . $data->dataPricelessFuel()[3]['cp'] . ')'; ?></h3>
                </div>
                <div class="content-box price">
                    <h1>Carburant le plus chère en france en ce moment</h1>
                    <h3>Gazole : <?php print($data->dataExpensiveFuel()[0]['prix'] . ' centimes d\'€ au ' . $data->dataExpensiveFuel()[0]['adresse'] . ', ' . $data->dataExpensiveFuel()[0]['ville']) . ' (' . $data->dataExpensiveFuel()[0]['cp'] . ')';  ?></h3>
                    <h3>SP95 : <?php print($data->dataExpensiveFuel()[1]['prix'] . ' centimes d\'€ au ' . $data->dataExpensiveFuel()[1]['adresse'] . ', ' . $data->dataExpensiveFuel()[1]['ville']) . ' (' . $data->dataExpensiveFuel()[1]['cp'] . ')'; ?></h3>
                    <h3>SP98 : <?php print($data->dataExpensiveFuel()[2]['prix'] . ' centimes d\'€ au ' . $data->dataExpensiveFuel()[2]['adresse'] . ', ' . $data->dataExpensiveFuel()[2]['ville']) . ' (' . $data->dataExpensiveFuel()[2]['cp'] . ')'; ?></h3>
                    <h3>E85 : <?php print($data->dataExpensiveFuel()[3]['prix'] . ' centimes d\'€ au ' . $data->dataExpensiveFuel()[3]['adresse'] . ', ' . $data->dataExpensiveFuel()[3]['ville']) . ' (' . $data->dataExpensiveFuel()[3]['cp'] . ')'; ?></h3>
                </div>
            </div>
        </div>
    </body>
</html>
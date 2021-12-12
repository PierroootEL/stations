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
                    <a href="/price/" class="hover-underline-animation">Prix par ville</a>
                    <a href="/near/" class="hover-underline-animation">Stations à côté de vous</a>
                </div>
            </nav>
            <div class="content">
                <div class="content-box actualisation">
                    <h1>Dernière actualisation</h1>
                    <h3>Les données ont été actualisées il y a 3h</h3>
                </div>
                <div class="content-box price">
                    <h1>Carburant le plus chère en france en ce moment</h1>

                </div>
            </div>
        </div>
    </body>
</html>
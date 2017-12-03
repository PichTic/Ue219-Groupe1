<?php

session_start();
require_once 'lib/includes.php';
auth_only();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ue219 Groupe1</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body>
    <?php
    // inclusion de la nav
    include 'vues/nav.php';
    ?>
    <div id="main" class="container">
        <div id="title" class="text-center border border-secondary border-left-0 border-right-0 border-top-0">
            <h1>Mes annonces</h1>
            <h2 class="text-muted h3">Agence Immobilière UCHI</h2>
            <?php
            flash();
            flash('danger', 'error_delete');
            flash('danger', 'error_edit');
            flash('danger', 'error_annonce');
            ?>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php
                    include 'vues/clientAds.php';
                ?>
            </div>
            <div class="col-md-4">
                <h2 class="text-center h4">Agence Uchi</h2>
                <h3 class="mb-2 text-muted text-center h6">Notre Agence Immobilière</h3>
                <p class="card-text">Bienvenue sur notre page ! Vous pouvez librement consulter nos annonces, ou déposer la vôtre. Pour cela, vous devrez avoir un compte.</p>
            </div>
        </div>
    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>

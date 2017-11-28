<?php
session_start();
require_once 'lib/includes.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>
<body>
    <?php
    include 'vues/nav.php';
    ?>
    <div class="container">
        <div class="text-center">
            <h1>Uchi</h1>
            <small class="text-muted">Agence Immobilière</small>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 alert alert-primary">
            <?php
            // j'initialise la connexion à la base de données
            $connect = connect($db);

            // je teste une simple requête
            $sql = 'select * from clients';
            $clients = $connect->query($sql);
            // j'afficher le résultat en mode débug avec un var_dump()
            var_dump($clients->fetch());

            // je me déconnecte de la base de données
            deconnect($connect);
            ?>
            </div>
        </div>

    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>

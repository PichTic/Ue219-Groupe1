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
    <div id="main" class="container">
        <div id="title" class="text-center border border-secondary border-left-0 border-right-0 border-top-0">
            <h1>Page de test</h1>
            <h2 class="text-muted h3">Test d'accès à la base de données</h2>
        </div>
        <div class="row">
            <p>Si la base de données est bien configurée dans le fichier <code>lib/config.php</code> et que le fichier SQL a bien été importé, vous devriez voir ci-dessous les infos du premier compte utilisateur.</p>
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 alert alert-primary">
            <?php
            // j'initialise la connexion à la base de données
            $connect = connect($db);

            // je teste une simple requête
            $sql = 'select * from clients';
            $clients = $connect->query($sql);
            // j'afficher le résultat en mode débug avec un var_dump()
            vd($clients->fetch());

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

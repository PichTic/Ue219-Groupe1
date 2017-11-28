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
            <?php
            flash();
            ?>
        </div>
        <div class="row">
            <div class="col-md-8">

                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

            </div>
            <div class="col-md-4">
                <?php
                include 'vues/login.php';
                ?>
            </div>
        </div>
    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>

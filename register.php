<?php

session_start();
require_once 'lib/includes.php';

//Si un utilisateur déjà connecté veux accéder à cette page
//il sera redirigé vers index.php
guest_only();
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
            <h1>Créer un compte</h1>
            <h2 class="text-muted h3">Agence Immobilière UCHI</h2>
        </div>

        <?php
            // affiche le message de flash stocké dans $_SESSION['error_register'] s'il y en a
            flash('danger', 'error_register');
        ?>

        <form class="form-signin" method="POST" action="">

            <label for="login" class="sr-only">Identifiant</label>
            <input name="login" type="text" id="login" class="form-control" placeholder="Identifiant" autofocus>

            <label for="password" class="sr-only">Mot de passe</label>
            <input name="password" type="password" id="password" class="form-control" placeholder="Mot de passe">

            <label for="password_confirm" class="sr-only">Mot de passe</label>
            <input name="password_confirm" type="password" id="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe">

            <button name="register" class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer</button>
        </form>
    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
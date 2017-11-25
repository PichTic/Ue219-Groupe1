<?php
session_start();
require_once 'lib/db.php';
require_once 'lib/form.php';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
  </head>
  <body>
  <div class="container">
    <div class="text-center">
      <h1>Uchi</h1>
      <small class="text-muted">Agence Immobilière</small>
    </div>
      <?php
        include 'vues/login.php';

      if(array_key_exists('flash', $_SESSION)) {
        echo "<p class='alert alert-success'>{$_SESSION['flash']}</p>";
        unset($_SESSION['flash']);
      }
      ?>
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
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
  </head>
  <body>
  <div class="container">
    <div class="text-center">
      <h1>Uchi</h1>
      <small class="text-muted">Agence Immobilière</small>
    </div>

      <form class="form-signin">
        <h2 class="form-signin-heading">Identifiez-vous</h2>

        <label for="login" class="sr-only">Identifiant</label>
        <input type="text" id="login" class="form-control" placeholder="Identifiant" required autofocus>

        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
      </form>

      <div class="row">
      <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 alert alert-primary">
      <?php
        include 'lib/db.php';

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










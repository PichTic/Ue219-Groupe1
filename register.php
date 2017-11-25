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
    <div>
      <form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading">Enregistrez-vous</h2>

        <label for="login" class="sr-only">Identifiant</label>
        <input name="login" type="text" id="login" class="form-control" placeholder="Identifiant" autofocus>

        <label for="password" class="sr-only">Mot de passe</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="Mot de passe">

        <label for="password_confirm" class="sr-only">Mot de passe</label>
        <input name="password_confirm" type="password" id="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe">

        <button name="register" class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer</button>
      </form>
    </div>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
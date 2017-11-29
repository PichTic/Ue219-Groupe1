<?php
session_start();
require_once 'lib/includes.php';

//Si un utilisateur déjà logué veux accéder à cette page
//il sera redirigé vers index.php
auth_only();
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
      </div>

      <form class="form-signin">
        <h2 class="form-signin-heading">Publiez votre annonce</h2>
        <div class="col-auto">
      <label class="form-signin" for="type">Type de bien</label>
    <select class="custom-select">
  <option selected>Sélectionnez le type de bien</option>
        <option value="1">Appartement</option>
        <option value="2">Maison</option>
        <option value="4">Château</option>
        <option value="5">Local commercial</option>
        <option value="6">Parking/box</option>
    </select>
    </div>
          <br>
 <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputSurface">Surface</label>
      <input type="text" class="form-control" id="inputSurface" placeholder="Surface">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPrice">Prix</label>
      <input type="text" class="form-control" id="inputPrice" placeholder="Prix">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Adresse</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Adresse postale">
  </div>
  <div class="form-row">
    <div class="form-group col-md-7">
      <label for="inputCity">Ville</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-5">
      <label for="inputZip">Code postal</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
  </div>
<button type="submit" class="btn btn-lg btn-primary btn-block">Valider et envoyer l'annonce</button>
</form>




       <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

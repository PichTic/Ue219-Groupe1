<?php
session_start();
require_once 'lib/includes.php';

//Si un utilisateur non logué veux accéder à cette page
//il sera redirigé vers index.php
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
  <div class="container">
    <div class="text-center">
      <h1>Uchi</h1>
      <small class="text-muted">Agence Immobilière</small>
    </div>
      </div>

      <?php
          // affiche le message de flash stocké dans $_SESSION['error_annonce'] s'il y en a
          flash('danger', 'error_annonce');
      ?>

      <form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading">Publiez votre annonce</h2>
         <div class="form-row">
            <div class="form-group col-md-12">
               <label for="type">Type de bien</label>
               <select class="custom-select" name="type">
                 <option selected disabled style="display:none;">Sélectionnez le type de bien</option> //Cette option est cachée au scroll de l'utilisateur
                       <option value="Appartement">Appartement</option>
                       <option value="Maison">Maison</option>
                       <option value="Château">Château</option>
                       <option value="Local commercial">Local commercial</option>
                       <option value="Parking/box">Parking/box</option>
               </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputSurface">Surface</label>
              <input type="number" class="form-control" id="inputSurface" name="surface" placeholder="Surface en m²">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Adresse</label>
            <input type="text" class="form-control" id="inputAddress" name="adress" placeholder="Adresse postale">
          </div>
          <div class="form-row">
            <div class="form-group col-md-7">
              <label for="inputCity">Ville</label>
              <input type="text" class="form-control" id="inputCity" name="city" placeholder="Ville">
            </div>
            <div class="form-group col-md-5">
              <label for="inputZip">Code postal</label>
              <input type="number" class="form-control" id="inputZip" name="zip" maxlength="5">
            </div>
          </div>
          <div class="form-group">
          </div>
          <button name="create" type="submit" class="btn btn-lg btn-primary btn-block">Valider et envoyer l'annonce</button>
      </form>




       <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

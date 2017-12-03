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
        <h1>Publiez votre annonce</h1>
        <h2 class="text-muted h3">Agence Immobilière UCHI</h2>
        <?php
          // affiche le message de flash stocké dans $_SESSION['error_annonce'] s'il y en a
          flash('danger', 'error_annonce');
      ?>
    </div>

    <div class="col-md-12">
      <form method="POST" action="">

        <div class="row">
          <div class="form-group col-md-6">
            <label for="type" class="sr-only">Type de bien</label>
            <select id="type" class="form-control" name="type">
              <option>Sélectionnez le type de bien</option>
              <option value="appartement">Appartement</option>
              <option value="maison">Maison</option>
              <option value="chateau">Château</option>
              <option value="local">Local commercial</option>
              <option value="parking">Parking/box</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="surface" class="sr-only">Surface</label>
            <input class="form-control" type="number" id="surface" name="surface" placeholder="Surface en M2" value="<?php echo (array_key_exists('surface', $tempData)) ? $tempData['surface'] : '' ?>">
          </div>
        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label for="adresse" class="sr-only">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo (array_key_exists('adresse', $tempData)) ? $tempData['adresse'] : '' ?>">
          </div>

          <div class="form-group col-md-3">
            <label for="zipcode" class="sr-only">Code Postal</label>
            <input type="number" class="form-control" id="zipcode" name="zipcode" placeholder="Code Postale" value="<?php echo (array_key_exists('zipcode', $tempData)) ? $tempData['zipcode'] : '' ?>">
          </div>

          <div class="form-group col-md-3">
            <label for="city" class="sr-only">Ville</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Ville" value="<?php echo (array_key_exists('city', $tempData)) ? $tempData['city'] : '' ?>">
          </div>

        </div>
      <button name="create" type="submit" class="btn btn-lg btn-primary btn-block">Publier l'annonce</button>
    </form>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

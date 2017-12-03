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
        <h1>Editez votre annonce</h1>
        <h2 class="text-muted h3">Agence Immobilière UCHI</h2>

        <?php
        flash();
        flash('danger', 'error_edit');
        ?>

    </div>

    <div class="col-md-12">
      <form method="POST" action="">

        <div class="row">
          <div class="form-group col-md-6">
            <label for="type" class="sr-only">Type de bien</label>
            <select id="type" class="form-control" name="type">
              <option>Sélectionnez le type de bien</option>
              <option value="appartement" <?php echo ($data[0]['type'] === 'appartement') ? 'selected' : '' ; ?>>Appartement</option>
              <option value="maison" <?php echo ($data[0]['type'] === 'maison') ? 'selected' : '' ; ?>>Maison</option>
              <option value="chateau" <?php echo ($data[0]['type'] === 'chateau') ? 'selected' : '' ; ?>>Château</option>
              <option value="local" <?php echo ($data[0]['type'] === 'local') ? 'selected' : '' ; ?>>Local commercial</option>
              <option value="parking" <?php echo ($data[0]['type'] === 'parking') ? 'selected' : '' ; ?>>Parking/box</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="surface" class="sr-only">Surface</label>
            <input class="form-control" type="number" id="surface" name="surface" placeholder="Surface en M2" value="<?php echo $data[0]['surface']; ?>">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label for="inputAddress" class="sr-only">Adresse</label>
            <textarea cols="80" rows="5" class="form-control" id="inputAddress" name="adresse" placeholder="Adresse Complete"> <?php echo $data[0]['adresse']; ?> </textarea>
          </div>
        </div>
      <button name="update" type="submit" class="btn btn-lg btn-primary btn-block">Modifier l'annonce</button>
    </form>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
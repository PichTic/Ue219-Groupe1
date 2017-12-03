<?php

session_start();
require_once 'lib/includes.php';

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
        <h1>Rechercher une annonce</h1>
        <h2 class="text-muted h3">Agence Immobilière UCHI</h2>
    </div>

    <div class="row">
        <div class="col-md-8">

            <form method="GET" class="form-inline">
                <div class="form-group">
                    <label for="adresse" class="sr-only">Adresse</label>
                    <input name="adresse" type="text" id="adresse" class="form-control m-1" placeholder="Adresse">
                </div>

                <div class="form-group">
                    <label for="surface" class="sr-only">Surface</label>
                    <input name="surface" type="number" id="surface" class="form-control rounded-right" placeholder="Surface en M2">
                </div>

                <div class="form-group">
                    <label for="type" class="sr-only">Type</label>
                    <select name="type" type="" id="type" class="form-control m-1">
                        <option>Type de bien</option>
                        <option value="appartement">Appartement</option>
                        <option value="maison">Maison</option>
                        <option value="chateau">Château</option>
                        <option value="local">Local Commercial</option>
                        <option value="parking">Parking / Box</option>
                    </select>
                </div>

                <button type="submit" name="rechercher" class="btn btn-primary">Ok</button>
            </form>

            <?php
            flash('danger', 'badSearch');
            ?>

            <?php
            if (isset($data)) : ?>
            <div class="row">
                <?php
                foreach ($data as $annonce) : ?>
                <div class="col-md-6">
                    <div class="card border-dark mb-3">
                        <div class="card-header"><?php echo ucfirst($annonce['type']); ?></div>
                        <div class="card-body text-dark">
                            <h4 class="card-title">Surface : <?php echo $annonce['surface']; ?>M<sup>2</sup></h4>
                            <p class="card-text"><strong>Adresse : </strong><?php echo $annonce['adresse']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                endforeach; ?>
            </div>
            <?php
            endif; ?>
        </div>

        <div class="col-md-4">
            <h2 class="text-center h4">Agence Uchi</h2>
            <h3 class="mb-2 text-muted text-center h6">Notre Agence Immobilière</h3>
            <p class="card-text">Bienvenue sur notre page ! Vous pouvez librement consulter nos annonces, ou déposer la vôtre. Pour cela, vous devrez avoir un compte.</p>
        </div>
    </div>
</div>

<script src="./js/jquery-3.2.1.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>

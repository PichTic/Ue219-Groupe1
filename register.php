<?php
session_start();
require_once 'lib/includes.php';

//Si un utilisateur déjà logué veux accéder à cette page
//il sera redirigé vers index.php
guest_only();
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
if (filter_has_var(INPUT_POST, 'register')) {
    // on filtre nos champs
    $resultats = filter_input_array(INPUT_POST, $filter_register);
    // pour chaque champs

    foreach ($resultats as $name => $value) {
        // on vérifie le champ
        $option = $resultats['password'];
        // si la vérification est conluante
        if (check_field($name, $value, $option)) {
            // on ajoute sa valeur dans l'array de donnée
            $tempData[$name] = $value;
        } else {
            //si la vérification n'est pas bonne
            //on garde en mémoire le nom du champ invalide
            $hasErrors[] = $name;
            // et on récupère le feedback du champ invalide
            $tempData[$name] = errorMsg($name);
        }
    }
    // s'il n'y a pas des d'erreurs
    if (0 === count($hasErrors)) {
        $data = user_by_login($db, $tempData['login']);
        $created = false;

        // s'il n'y as pas de compte existant avec ce login
        if (0 === count($data)) {
            $created = user_create($db, $tempData['login'], $tempData['password']);
        } else {
            $hasErrors[] = 'duplicate';
            $tempData['duplicate'] = '<p>Ce compte existe déjà</p>';
        }

        // le compte a été créé
        if ($created) {
            unset($tempData['password'], $tempData['password_confirm']);
            $_SESSION['client'] = $tempData;
            add_flash("Bonjour {$tempData['login']} ! Votre compte est bien créé");
            header('Location: index.php');
            exit;
        } else {
            $hasErrors[] = 'account';
            $tempData['account'] = "<p>Votre compte n'a pas été crée</p>";
        }
    }
    if (count($hasErrors) > 0) {
        // sinon, on donne le feedback des champs invalides
        display_errors($hasErrors, $tempData);

        // et on détruit la session
        session_destroy();
    }
}
?>

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
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
session_start();
//Si un utilisateur déjà logué veux accéder à cette page
//il sera redirigé vers index.php
if (array_key_exists('client', $_SESSION)) {
  header('Location: index.php');
  exit;
}
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
    <div>

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
  if (count($hasErrors) === 0) {
    //requête SQL
    $sql = "SELECT * FROM `clients` WHERE `identifiant` = :login";
    //connexion à la bd
    $connect = connect($db);
    //préparation de la requête
    $query = $connect->prepare($sql);
    //Ajout des entrées de '$tempData' à la place des ':login' & ':password' + exécute
    $query->execute(['login' => $tempData['login']]);
    //récupération des données
    $data = $query->fetchAll();
    $created = FALSE;
    if (count($data) === 0 ) {
      $addSql = "INSERT INTO `clients` (`identifiant`, `motdepasse`) VALUES (:login, :password)";
      $query = $connect->prepare($addSql);
      $created = $query->execute(['login' => $tempData['login'],
                       'password' => $tempData['password']]);
    } else {
      $hasErrors[] = 'duplicate';
      $tempData['duplicate'] = "<p>Ce compte existe déjà</p>";
    }
    //deconnexion
    deconnect($connect);
    if ($created){
      $_SESSION['client'] = $tempData;
      $_SESSION['flash'] = "Bonjour {$tempData['login']} ! Votre compte est bien créé";
      header('Location: index.php');
      exit;
    }else {
      $hasErrors[] = 'account';
      $tempData['account'] = "<p>Votre compte n'a pas été crée</p>";
    }
  }
  if (count($hasErrors) > 0) {
    // sinon, on donne le feedback des champs invalides
    echo '<div class="alert alert-danger">';
    foreach ($hasErrors as $name) {
      echo $tempData[$name];
    }
    echo '</div>';
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
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
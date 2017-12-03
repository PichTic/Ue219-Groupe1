<?php

if (filter_has_var(INPUT_GET, 'edit_ad')) {
    // on filtre nos champs
    $resultats = filter_input_array(INPUT_GET, $filter_edit);
    // pour chaque champs
    foreach ($resultats as $name => $value) {
        // on vérifie le champ
        // si la vérification est conluante
        if (check_field($name, $value)) {
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

    if (0 === count($hasErrors)) {
        $data = ad_exists($db, $_SESSION['client']['id'], $tempData['ad']);

        //si le tableau $data est vide l'annonce n'existe pas
        if (0 === count($data)) {
            $hasErrors[] = 'editAd';
            $tempData['editAd'] = "<p>Cette annonce n'a pas été trouvée ou vous n'en êtes pas l'auteur</p>";
        }

    }
    if (count($hasErrors) > 0) {
      // sinon, on donne le feedback des champs invalides
      add_flash(get_errors($hasErrors, $tempData), 'error_edit');
      // et on détruit la session
      header('Location: mesAnnonces.php');
      exit;
  }
}

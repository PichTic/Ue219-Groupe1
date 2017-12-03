<?php

if (filter_has_var(INPUT_GET, 'delete_ad')) {
    // on filtre nos champs
    $resultats = filter_input_array(INPUT_GET, $filter_delete);
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

        $deleted = false;

        //si le tableau $data est vide l'annonce n'existe pas
        if (0 === count($data)) {
            $hasErrors[] = 'deleteAd';
            $tempData['deleteAd'] = "<p>Cette annonce n'a pas été trouvée ou vous n'en êtes pas l'auteur</p>";
        } else {
            $deleted = ad_delete($db, $tempData['ad']);
        }

        if ($deleted) {
          add_flash("L'annonce a été supprimée");
          header('Location: mesAnnonces.php');
          exit;
        }

    }
    if (count($hasErrors) > 0) {
      // sinon, on donne le feedback des champs invalides
      add_flash(get_errors($hasErrors, $tempData), 'error_delete');
      // et on détruit la session
      header('Location: mesAnnonces.php');
      exit;
  }
}

<?php

if (filter_has_var(INPUT_POST, 'update')) {
    // on filtre nos champs
    $resultats = filter_input_array(INPUT_POST, $filter_adCreate);

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


    // s'il n'y a pas des d'erreurs
    if (0 === count($hasErrors)) {
        $data = ad_exists($db, $_SESSION['client']['id'], $tempData['ad']);
        $updated = false;

        // s'il n'y as pas d'annonce en doublon
        if (1 === count($data)) {
            $updated = adUpdate($db, $tempData['adresse'], $tempData['type'], $tempData['surface'], $data[0]['id']);
        } else {
            $hasErrors[] = 'update';
            $tempData['update'] = '<p>Cette annonce ne peut pas être mise à jour</p>';
        }

        // le compte a été créé
        if ($updated) {
            add_flash("Votre annonce a bien été mise à jour");
            header('Location: mesAnnonces.php');
            exit;
        } else {
            $hasErrors[] = 'adUpdate';
            $tempData['adUpdate'] = "<p>Votre annonce n'a pas été mise à jour</p>";
        }
    }
    if (count($hasErrors) > 0) {
        // sinon, on donne le feedback des champs invalides
        add_flash(get_errors($hasErrors, $tempData), 'error_edit');
    }
}

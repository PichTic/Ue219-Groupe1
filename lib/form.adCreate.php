<?php

if (filter_has_var(INPUT_POST, 'create')) {
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
        $tempData['adress'] .= ", ".$tempData['zip']." ".$tempData['city'];
        $data = adDuplicate($db, $tempData['adress'], $tempData['type'], $tempData['surface']);
        $created = false;

        // s'il n'y as pas d'annonce en doublon
        if (0 === count($data)) {
            $created = adCreate($db, $tempData['adress'], $tempData['type'], $tempData['surface']);
        } else {
            $hasErrors[] = 'duplicate';
            $tempData['duplicate'] = '<p>Cette annonce existe déjà</p>';
        }

        // le compte a été créé
        if ($created) {
            add_flash("Votre annonce a bien été créée");
            header('Location: index.php');
            exit;
        } else {
            $hasErrors[] = 'adCreate';
            $tempData['adCreate'] = "<p>Votre annonce n'a pas été créée</p>";
        }
    }
    if (count($hasErrors) > 0) {
        // sinon, on donne le feedback des champs invalides
        add_flash(get_errors($hasErrors, $tempData), 'error_annonce');
    }
}

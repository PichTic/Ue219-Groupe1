<?php

if (filter_has_var(INPUT_POST, 'update')) {
    $resultats = filter_input_array(INPUT_POST, $filter_adCreate);
    foreach ($resultats as $name => $value) {
        if (check_field($name, $value)) {
            $tempData[$name] = $value;
        } else {
            $hasErrors[] = $name;
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

        if ($updated) {
            add_flash('Votre annonce a bien été mise à jour');
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

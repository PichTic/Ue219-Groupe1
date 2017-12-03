<?php

if (filter_has_var(INPUT_GET, 'rechercher')) {
    $resultats = filter_input_array(INPUT_GET, $filter_search);
    foreach ($resultats as $name => $value) {
        if (check_field($name, $value)) {
            $tempData[$name] = $value;
        } else {
            $hasErrors[] = $name;
            $tempData[$name] = errorMsg($name);
        }
    }

    /*
     * Si pas d'erreurs lors de la première vérification
     * sémantique des inputs j'effectue ma rechercher en base de données
     */
    if (0 === count($hasErrors)) {
        $data = ads_search($db, $tempData['adresse'], $tempData['type'], $tempData['surface']);

        // y a-t-il des résultats ?
        if (0 === count($data)) {
            $hasErrors[] = 'search';
            $tempData['search'] = '<p>Aucun bien ne correspond à votre recherche</p>.';
        }
    }

    // affichage des erreurs
    if (0 > count($hasErrors)) {
        add_flash(get_errors($hasErrors, $tempData), 'badSearch');
    }
}

<?php

if (filter_has_var(INPUT_GET, 'rechercher')) {
    // on filtre nos champs

    $resultats = filter_input_array(INPUT_GET, $filter_search);

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

    /*
     * Si pas d'erreurs lors de la première vérification
     * sémantique des inputs 'login' et 'password'
     * je peux vérifier que le couple 'login' & 'password'
     * correspond bien à une entrée dans la base de données
     */
    if (0 === count($hasErrors)) {

        $data = ads_search($db, $tempData['adresse'], $tempData['type'], $tempData['surface']);

        if (count($data) === 0) {

            $hasErrors[] = 'search';
            $tempData['search'] = "<p>Aucun bien correspond à votre recherche</p>";

        } else {



        }
    }


    // une fois qu'on a finir de traiter toutes les erreurs possibles, on agit
    if (0 === count($hasErrors)) {


    } else {

        add_flash(get_errors($hasErrors, $tempData), 'badSearch');
    }

}
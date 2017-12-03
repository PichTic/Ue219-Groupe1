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
        $data = user_exists($db, $tempData['login'], $tempData['password']);

        //si le tableau $data est vide (pas de couple 'login' & 'password')
        //le compte n'existe pas j'en informe l'utilisateur
        if (0 === count($data)) {
            $hasErrors[] = 'account';
            $tempData['account'] = "<p>Ce compte n'existe pas</p>";
        } else {
            unset($tempData['password']);
            $tempData['id'] = $data[0]['id'];
        }
    }
    // s'il n'y a pas des d'erreurs
    if (0 === count($hasErrors)) {
        // on stock nos données et params en session
        $_SESSION['client'] = $tempData;
        add_flash("Bienvenue {$tempData['login']} !");
    } else {
        // sinon, on donne le feedback des champs invalides
        add_flash(get_errors($hasErrors, $tempData), 'error_connexion');

        // et on détruit la session
        logout();
    }
}
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
        add_flash(get_errors($hasErrors, $tempData), 'error_register');
        // et on détruit la session
        logout('register.php');
    }
}

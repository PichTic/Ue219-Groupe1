<?php

if (filter_has_var(INPUT_POST, 'profile')) {
    $resultats = filter_input_array(INPUT_POST, $filter_register);

    foreach ($resultats as $name => $value) {
        $option = $resultats['password'];
        if (check_field($name, $value, $option)) {
            $tempData[$name] = $value;
        } else {
            $hasErrors[] = $name;
            $tempData[$name] = errorMsg($name);
        }
    }

    // s'il n'y a pas des d'erreurs
    if (0 === count($hasErrors)) {
        $data = user_duplicate_login($db, $tempData['login'], $_SESSION['client']['id']);

        $updated = false;

        // s'il n'y as pas de compte existant avec ce login
        if (0 === count($data)) {
            $updated = user_update($db, $tempData['login'], $tempData['password'], $_SESSION['client']['id']);
        } else {
            $hasErrors[] = 'duplicate';
            $tempData['duplicate'] = "<p>Cet identifiant n'est plus disponible</p>";
        }

        // le compte a été mis à jour
        if ($updated) {
            unset($tempData['password'], $tempData['password_confirm']);
            $_SESSION['client']['login'] = $tempData['login'];
            add_flash("{$tempData['login']} ! Votre compte est bien mis à jour");
            header('Location: parametres.php');
            exit;
        } else {
            $hasErrors[] = 'account';
            $tempData['account'] = "<p>Votre compte n'a pas été mis à jour</p>";
        }
    }
    if (count($hasErrors) > 0) {
        // sinon, on donne le feedback des champs invalides
        add_flash(get_errors($hasErrors, $tempData), 'error_profile');
        header('Location: parametres.php');
        exit;
    }
}

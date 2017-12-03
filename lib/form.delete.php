<?php

if (filter_has_var(INPUT_GET, 'delete_ad')) {
    $resultats = filter_input_array(INPUT_GET, $filter_delete);
    foreach ($resultats as $name => $value) {
        if (check_field($name, $value)) {
            $tempData[$name] = $value;
        } else {
            $hasErrors[] = $name;
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
        add_flash(get_errors($hasErrors, $tempData), 'error_delete');
        header('Location: mesAnnonces.php');
        exit;
    }
}

<?php

if (filter_has_var(INPUT_GET, 'edit_ad')) {
    $resultats = filter_input_array(INPUT_GET, $filter_edit);
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
        if (0 === count($data)) {
            $hasErrors[] = 'editAd';
            $tempData['editAd'] = "<p>Cette annonce n'a pas été trouvée ou vous n'en êtes pas l'auteur</p>";
        }
    }

    if (count($hasErrors) > 0) {
        add_flash(get_errors($hasErrors, $tempData), 'error_edit');
        header('Location: mesAnnonces.php');
        exit;
    }
}

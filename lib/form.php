<?php
/**
 * Vars
 * $hasErrors = un array de $name des inputs invalides
 * $tempData = un array des données temporaires du form
 */
$hasErrors = [];
$tempData = [];

/**
 * Functions de contrôle du formulaire reprises de la semaine 3 et modifiées pour cette semaine.
 * En particulier, le retour des fonctions 'check_X' qui renvoient un Booléen.
 *
 * - Si les fonctions renvoient 'TRUE', je peux initialiser ma session avec les données de
 * '$tempData',
 * - Si au moins une des fonctions renvoient 'FALSE', je récupère le '$name' de l'input et
 * je renseigne '$hasErrors' afin d'en informer l'utilisateur.
 *
 */

/**
 * Pilote la vérification des champs
 *
 * @param string $name
 * @param bool $value
 * @return bool
 */
function check_field($name, $value)
{
    $output = false;

    switch ($name) {
        case 'nom':
            $output = check_nom($name, $value);
            break;
        case 'prenom':
            $output = check_prenom($name, $value);
            break;
        case 'objet':
            $output = check_objet($name, $value);
            break;
        case 'email':
            $output = check_email($name, $value);
            break;
        case 'login' :
            $output = check_login($name, $value);
            break;
        case 'password' :
            $output = check_password($name, $value);
            break;
    }

    return $output;
}

/**
 * Vérifie le champ email
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_email($name, $value)
{

    if (!is_null($value) && $value != FALSE && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ nom
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_nom($name, $value)
{

    $value = trim($value);

    if (!is_null($value) && $value != FALSE && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ prénom
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_prenom($name, $value)
{

    $value = trim($value);

    if (!is_null($value) && $value != FALSE && strlen($value) > 0) {
        return true;
    }

    return false;

}

/**
 * Vérifie le champ objet
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_objet($name, $value)
{

    if (is_null($value) || $value === FALSE) {
        return false;
    }

    return true;

}

/**
 * Vérifie le champ login
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_login($name, $value)
{

    $value = trim($value);

    if (!is_null($value) && $value != FALSE && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ password
 *
 * @param string $name
 * @param string $value
 * @return bool
 */
function check_password($name, $value)
{

    $value = trim($value);

    if (!is_null($value) && $value != FALSE && strlen($value) >= 8) {
        return true;
    }

    return false;
}

/**
 * Retourne un feedback sur un champ invalide
 *
 * @param string $name
 * @return string
 */
function errorMsg($name)
{

    return "<p>Le champ <em>{$name}</em> est invalide</p>";

}

/**
 * Configuration des filtres à appliquer aux champs du formulaire
 *
 */

$filter_login = [
    'login' => FILTER_SANITIZE_STRING,
    'password' => FILTER_SANITIZE_STRING,
];


?>
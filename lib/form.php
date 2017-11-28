<?php
/**
 * Vars
 * $hasErrors = un array de $name des inputs invalides
 * $tempData = un array des données temporaires du form.
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
 */

/**
 * Pilote la vérification des champs.
 *
 * @param string $name
 * @param bool   $value
 * @param string $option - valeur optionnelle de comparaison
 *
 * @return bool
 */
function check_field($name, $value, $option = '')
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
        case 'login':
            $output = check_login($name, $value);
            break;
        case 'password':
            $output = check_password($name, $value);
            break;
        case 'password_confirm':
            $output = check_password_confirm($name, $value, $option);
            break;
    }

    return $output;
}

/**
 * Vérifie le champ email.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_email($name, $value)
{
    if (! is_null($value) && false != $value && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ nom.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_nom($name, $value)
{
    $value = trim($value);

    if (! is_null($value) && false != $value && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ prénom.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_prenom($name, $value)
{
    $value = trim($value);

    if (! is_null($value) && false != $value && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ objet.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_objet($name, $value)
{
    if (is_null($value) || false === $value) {
        return false;
    }

    return true;
}

/**
 * Vérifie le champ login.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_login($name, $value)
{
    $value = trim($value);

    if (! is_null($value) && false != $value && strlen($value) > 0) {
        return true;
    }

    return false;
}

/**
 * Vérifie le champ password.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_password($name, $value)
{
    $value = trim($value);

    if (! is_null($value) && false != $value && strlen($value) >= 8) {
        return true;
    }

    return false;
}
/**
 * vérifie le champ password_confirm.
 *
 * @param string $name
 * @param string $value
 * @param string $option
 *
 * @return bool
 */
function check_password_confirm($name, $value, $option)
{
    $value = trim($value);
    $option = trim($option);

    if ($value === $option) {
        return true;
    }

    return false;
}

/**
 * Retourne un feedback sur un champ invalide.
 *
 * @param string $name
 *
 * @return string
 */
function errorMsg($name)
{
    return "<p>Le champ <em>{$name}</em> est invalide</p>";
}

/**
 * Affiche les message d'errreur d'un form.
 *
 * @param array $names
 * @param array $messages
 */
function get_errors($hasErrors, $messages)
{
    $output = '';

    foreach ($hasErrors as $name) {
        $output .= $messages[$name];
    }

    return $output;
}

/**
 * Configuration des filtres à appliquer aux champs du formulaire.
 */

 //tableau des filtres pour vue/login.php
$filter_login = [
    'login'    => FILTER_SANITIZE_STRING,
    'password' => FILTER_SANITIZE_STRING,
];

//tableau des filtres pour register.php
$filter_register = [
  'login'            => FILTER_SANITIZE_STRING,
  'password'         => FILTER_SANITIZE_STRING,
  'password_confirm' => FILTER_SANITIZE_STRING,
];

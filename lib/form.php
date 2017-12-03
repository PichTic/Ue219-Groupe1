<?php

/**
 * Variables
 * ---------
 * $hasErrors = un array de $name des inputs invalides
 * $tempData = un array des données temporaires du form, référencé par le nom de l'input :
 *  - s'il y a une erreur : le message d'erreur
 *  - sinon la valeur du champ.
 */
$hasErrors = [];
$tempData = [];

/**
 * Functions de contrôle des champs.
 * ---------------------------------
 * La fonction check_field() permet de lancer la vérification supplémentaire après
 * celle effectuée en premier par filter_input_array(), car elle peut être
 * insuffisante. Les champs sont vérifiés en fonction de leur nom (name de l'input)
 * et de leur valeur.
 *
 * Les autres fonction check_XXX s'occupent de chaque vérification. Chacune renvoie
 * un booléen :
 *  - Si les fonctions renvoient 'TRUE', la vérification est OK et on peut continuer
 * le traitement du formulaire.
 *  - Si au moins une des fonctions renvoie 'FALSE', je récupère le '$name' de l'input
 * en erreur et je renseigne '$hasErrors'.
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
        case 'type':
            $output = check_type($name, $value);
            break;
        case 'surface':
            $output = check_surface($name, $value);
            break;
        case 'price':
            $output = check_surface($name, $value); //On a les mêmes exigences que pour la surface
            break;
        case 'adress':
            $output = check_login($name, $value); //On va seulement demander de rentrer au minimum 3 caractères comme pour le champ login
            break;
        case 'city':
            $output = check_city($name, $value);
            break;
        case 'zip':
            $output = check_zip($name, $value);
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

    if (! is_null($value) && false != $value && strlen($value) >= 3) {
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
 * Vérifie le champ password.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_type($name, $value) {
  $value = trim($value);

  if ((! is_null($value)) && (false != $value) && ($value != 0)) {
      return true;
  }
  else {
    return false;
  }
}


/**
 * Vérifie le champ password.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_surface($name, $value) {
  $value = trim($value);
  $valuelength = strlen((string)$value); //On récupère la longueur de la variable

  if((! is_null($value)) && (false != $value) && ($valuelength >= 2) && (!preg_match('/[A-Z][a-z]/', $value))) {
    return true;
  }
  else {
    return false;
  }
}


/**
 * Vérifie le champ password.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_city($name, $value) {
  $value = trim($value);

  if((preg_match('/[0-9]/', $value)) && (is_null($value)) && (false == $value) && ($valuelength < 3)) { //On cherche si il y a au moins un chiffre dans la variable qui ne valiserait pas le nom de la ville
    return false;
  }
  else {
    return true;
  }
}


/**
 * Vérifie le champ password.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_zip($name, $value) {
  $value = trim($value);
  $valuelength = strlen((string)$value); //On récupère la longueur de la variable

  if((preg_match('/[0-9]/', $value)) && (! is_null($value)) && (false != $value) && ($valuelength == 5)) {
    return true;
  }
  else {
    return false;
  }
}

/**
 * Feedbacks des erreurs
 * ---------------------
 * Si une erreur est détectée via check_field() (au moins un FALSE), il faut
 * généré le feedback de l'erreur.
 *  - La fonction errorMsg() permet de créer un feedback sur la base du nom du
 * champ (name de l'input). On a 2 arrays ($messages et $inputs) qui servent
 * de "dictionnaire" afin de pouvoir avoir un message compréhensible.
 *  - La fonction get_errors() permet de boucler sur la variable $hasErrors
 * afin de concaténer les messages d'erreurs en une seule chaîne de caractères.
 */

/**
 * Retourne un feedback sur un champ invalide.
 *
 * @param string $name
 *
 * @return string
 */
function errorMsg($name)
{
    $messages = [
        'login'            => "l'identifiant doit avoir au moins 3 caractères",
        'password'         => 'le mot de passe doit avoir au moins 8 caractères',
        'password_confirm' => 'les deux mots de passe ne sont pas identiques',
        'type' => 'mauvaise sélection',
        'surface' => 'La surface doit contenir au moins 2 chiffres',
        'price' => 'le prix doit contenir au moins 2 chiffres',
        'adress' => 'l\'adresse doit avoir au moins 3 caractères',
        'city' => 'la ville doit avoir au moins 3 caractères et ne peut pas comporter de chiffre',
        'zip' => 'le code postal doit contenir 5 chiffres',
    ];

    $inputs = [
        'login'            => 'identifiant',
        'password'         => 'mot de passe',
        'password_confirm' => 'confirmation du mot de passe',
        'type' => 'type de bien',
        'surface' => 'surface',
        'price' => 'prix',
        'adress' => 'adresse',
        'city' => 'ville',
        'zip' => 'code postal',
    ];

    return "<p>Le champ <strong>{$inputs[$name]}</strong> est invalide : {$messages[$name]}.</p>";
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
 * Configuration des filtres
 * -------------------------
 * La première vérification des champs de formulaire se fait par les
 * filtres PHP. Ici on définit les filtres spécifiques par formulaires.
 *  - $filter_login contient les filtres pour le form d'identification
 *  - $filter_register contient les filtres pour le form de création de
 * compte.
 *
 * On n'encode pas les caractères spéciaux des identifiants et mot de passe.
 * On y appliquera donc juste un filtre personnalisé 'sanitize_string' qui ôte
 * les espaces aux extrémités d'une string (trim) et les balises HTML (strip_tags).
 */

/**
 * Nettoie une chaîne de caractère.
 *
 * @param [type] $value
 */
function sanitize_string($value)
{
    return trim(strip_tags($value));
}

 //tableau des filtres pour vues/login.php
$filter_login = [
    'login' => [
        'filter'  => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
    'password' => [
        'filter'  => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
];

//tableau des filtres pour register.php
$filter_register = [
  'login' => [
        'filter'  => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
  'password' => [
        'filter'  => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
  'password_confirm' => [
        'filter'  => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
];

//tableau des filtres pour les annonces
$filter_annoucement = [
  'type' => [
      'filter' => FILTER_CALLBACK,
      'options' => 'sanitize_string',
  ],
  'surface' => [
      'filter' => FILTER_SANITIZE_NUMBER_INT,
  ],
  'price' => [
      'filter' => FILTER_SANITIZE_NUMBER_INT,
  ],
  'adress' => [
      'filter' => FILTER_CALLBACK,
      'options' => 'sanitize_string',
  ],
  'city' => [
      'filter' => FILTER_CALLBACK,
      'options' => 'sanitize_string',
  ],
  'zip' => [
      'filter' => FILTER_SANITIZE_NUMBER_INT,
  ],
];

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
        case 'adress':
            $output = check_adresse($name, $value);
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
 * Vérifie le champ type.
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_type($name, $value) {
    $value = trim($value);

    if ((! is_null($value)) && (false != $value)) {
        return true;
    }
      return false;
  }

/**
 *
 *
 * @param string $name
 * @param string $value
 *
 * @return bool
 */
function check_surface($name, $value) {
    $value = intval(trim($value));

    if((! is_null($value)) && (false != $value)) {
      return true;
    }
      return false;
}

function check_adresse($name, $value) {
    $value = trim($value);

    if((! is_null($value)) && (false != $value) && strlen($value) >= 3)  {
      return true;
    }
      return false;
}

function check_city($name, $value) {
    $value = trim($value);

    if((! is_null($value)) && (false != $value) && (strlen($value) >= 3) && (strpbrk($value, '1234567890') === FALSE))  {
      return true;
    }
      return false;
}

function check_zip($name, $value) {
    $value = intval(trim($value));
    $valuelength = strlen((string)$value); //Récupération de la longueur du code postal

    if((! is_null($value)) && (false != $value) && ($valuelength == 5)) {
      return true;
    }
      return false;
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
        'login'            => 'l\'identifiant doit avoir au moins 3 caractères',
        'password'         => 'le mot de passe doit avoir au moins 8 caractères',
        'password_confirm' => 'les deux mots de passe ne sont pas identiques',
        'type' => 'ce type n\'est pas disponible',
        'surface' => 'La surface doit être supérieure à 9m<sup>2</sup>',
        'adress' => 'l\'adresse doit contenir au moins 3 caractères',
        'city' => 'la ville doit contenir au moins 3 caractères et aucun chiffre',
        'zip' => 'le code postal ne peut contenir que 5 chiffres'
    ];

    $inputs = [
        'login'            => 'identifiant',
        'password'         => 'mot de passe',
        'password_confirm' => 'confirmation du mot de passe',
        'type' => 'type de bien',
        'surface' => 'surface',
        'adress' => 'adresse',
        'city' => 'ville',
        'zip' => 'code postal'
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

function filter_type($input) {
    // si la valeur est vide, la réponse est vide, sinon elle prend la valeur
    // FALSE par défaut
    $reponse = (empty($input)) ? NULL : FALSE;
    $options = ['appartement', 'maison', 'chateau', 'local', 'parking'];
    // si la valeur de l'input est dans le tableau, la réponse prend sa valeur
    if (in_array($input, $options)) {
        $reponse = $input;
    }
    return $reponse;
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
$filter_adCreate = [
    'type' => [
        'filter' => FILTER_CALLBACK,
        'options' => 'sanitize_string'
    ],
    'surface' => FILTER_SANITIZE_NUMBER_INT|FILTER_VALIDATE_INT,
    'adress' => [
        'filter' => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
    'city' => [
        'filter' => FILTER_CALLBACK,
        'options' => 'sanitize_string',
    ],
    'zip' => FILTER_SANITIZE_NUMBER_INT|FILTER_VALIDATE_INT,
  ];

//tableau des filtres pour recherche.php
$filter_search = [
    'adresse' => FILTER_SANITIZE_STRING,
    'surface' => FILTER_SANITIZE_NUMBER_INT|FILTER_VALIDATE_INT,
    'type' => [
        'filter' => FILTER_CALLBACK,
        'options' => 'filter_type'
    ]
  ];

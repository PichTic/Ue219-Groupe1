<?php
/**
 * Fichier qui centralise les inclusions de librairies de code
 * et traitement. Cela évite de devoir appeler à chaque fois
 * tous ces fichiers dans une page.
 */

// inclusion des données de configuration de la base de données
require_once 'config.php';

// librairies de fonctions
require_once 'db.php';
require_once 'form.php';
require_once 'utils.php';

// traitement des formulaires
require_once 'form.login.php';
require_once 'form.register.php';
require_once 'form.annoucement.php';
require_once 'form.search.php';

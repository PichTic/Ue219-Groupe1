<?php

/**
 * La page est-elle celle affichée ?
 * Si oui, renvoie la classe CSS active
 * pour le montrer dans la nav.
 *
 * @param string $page Nom de la page sans ".php"
 *
 * @return string
 */
function is_page_active($page)
{
    // récupère le nom de la page depuis $_SERVER
    // et ôte l'extension ".php" du nom.
    $url = basename($_SERVER['REQUEST_URI'], '.php');

    if ($url === $page) {
        echo 'active';
    }

    echo '';
}

/**
 * Check si l'user est connecté ou non.
 *
 * @return bool
 */
function is_auth()
{
    if (array_key_exists('client', $_SESSION)) {
        return true;
    }

    return false;
}

/**
 * Déconnecte un utilisateur et le redirige.
 *
 * @param string $page Page vers laquelle rediriger (default = 'index.php')
 */
function logout($page = 'index.php')
{
    if (array_key_exists('client', $_SESSION)) {
        session_unset();
        session_destroy();
        // on restart la session après déconnexion afin d'avoir
        // un message de feedback après la redirection
        session_start();
        add_flash('Vous êtes déconnecté(e) !');
    }

    header("Location: $page");
    exit;
}

/**
 * Ajoute un message de feedback en session, à l'index $key.
 *
 * @param string $message Message text ou HTML
 * @param string $key     Clé par défaut 'flash'
 *
 * @return bool
 */
function add_flash($message, $key = 'flash')
{
    // on s'assure que la clé de stockage
    // ne va pas écraser les données en session
    // de l'utilisateur connecté
    if ($key !== 'client') {
        $_SESSION[$key] = $message;

        return true;
    }

    return false;
}

/**
 * Affiche un feedback stocké en session.
 * On s'appuie, pour la présentation, sur les alert de
 * Bootstrap : success, danger, info, primary, secondary, warning...
 * cf. http://getbootstrap.com/docs/4.0/components/alerts/.
 *
 * @param string $style Classe CSS à appliquer au message (default : 'success')
 * @param string $key   Clé de stockage du message en session
 *
 * @return string
 */
function flash($style = 'success', $key = 'flash')
{
    $output = '';

    if (array_key_exists($key, $_SESSION)) {
        $output = "<div class='alert alert-{$style}'>{$_SESSION[$key]}</div>";
        unset($_SESSION[$key]);
    }

    echo $output;
}

/**
 * Gardien des pages accessibles uniquement par un user connecté.
 * Si l'user n'est pas connecté on le redirige vers
 * l'index avec un message d'erreur.
 */
function auth_only()
{
    if (! array_key_exists('client', $_SESSION)) {
        add_flash("Vous n'êtes pas autorisé(e) à aller sur cette page !", 'auth_only');
        header('Location: index.php');
        exit;
    }
}

/*
 * Gardien des pages accessibles uniquement par un user non connecté.
 * Si l'user est pas connecté on le redirige vers l'index.
 */
function guest_only()
{
    if (array_key_exists('client', $_SESSION)) {
        header('Location: index.php');
        exit;
    }
}

/**
 * Utilitaire pour le débug
 * var_dump des variables et arrête l'exécution du script en cours.
 * dd car "dump and die".
 *
 * @param mixed ...$args
 */
function dd(...$args)
{
    foreach ($args as $arg) {
        var_dump($arg);
    }

    die();
}

/**
 * Utilitaire pour le débug
 * var_dump des variables et poursuit l'exécution du script en cours.
 * vd car "variable dump".
 *
 * @param mixed ...$args
 */
function vd(...$args)
{
    foreach ($args as $arg) {
        var_dump($arg);
    }
}

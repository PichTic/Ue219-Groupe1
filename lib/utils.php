<?php


/**
 * la page est-elle la page affichée ?
 * Si oui, renvoie la classe CSS pour le montrer
 * dans la nav.
 *
 * @param string $page
 *
 * @return string
 */
function is_page_active($page)
{
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
 * Déconnecte un utilisateu et le redirige.
 *
 * @param string $page
 */
function logout($page = 'index.php')
{
    if (array_key_exists('client', $_SESSION)) {
        session_unset();
        session_destroy();
        session_start();
        add_flash('Vous êtes déconnecté(e) !');
    }

    header("Location: $page");
    exit;
}

/**
 * Ajoute un message de feedback en session, à l'index $key.
 *
 * @param string $message
 * @param string $key
 */
function add_flash($message, $key = 'flash')
{
    if ('client' !== $key) {
        $_SESSION[$key] = $message;

        return true;
    }

    return false;
}

/**
 * Affiche un feedback stocké en session.
 *
 * @param string $style
 * @param string $key
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
 * Si l'user n'est pas connecté on le redirige.
 */
function auth_only()
{
    if (! array_key_exists('client', $_SESSION)) {
        header('Location: index.php');
        exit;
    }
}

/**
 * Si l'user est conneté, on le redirige.
 */
function guest_only()
{
    if (array_key_exists('client', $_SESSION)) {
        header('Location: index.php');
        exit;
    }
}

/**
 * var_dump des variables et arrête l'exécution.
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
 * var_dump des variables et poursuit l'exécution.
 *
 * @param mixed ...$args
 */
function vd(...$args)
{
    foreach ($args as $arg) {
        var_dump($arg);
    }
}

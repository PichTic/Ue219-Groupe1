<?php

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
        $output = "<p class='alert alert-{$style}'>{$_SESSION[$key]}</p>";
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

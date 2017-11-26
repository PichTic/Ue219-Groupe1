<?php

require_once 'config.php';

/**
 * Methode trouvé sur PHP7 Avancé Edition Eyrolles p.436.
 *
 * @param array $db
 *
 * @return PDO
 */
function connect($db)
{
    $dsn = "mysql:dbname={$db['Name']};host={$db['Server']};port={$db['Port']};charset=utf8";

    try {
        $connect = new PDO($dsn, $db['User'], $db['Pass']);
    } catch (PDOException $e) {
        printf("Erreur de connexion : %s\n", $e->getMessage());
    }
    /*
     * http://php.net/manual/en/pdo.setattribute.php
     */
    $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $connect;
}

/**
 * déconnexion.
 *
 * @param PDO $connect
 */
function deconnect($connect)
{
    unset($connect);
}

/**
 * Cherche si un utilisateur avec ce couple login/pwd existe.
 *
 * @param array  $db
 * @param string $login
 * @param string $password
 *
 * @return array
 */
function user_exists($db, $login, $password)
{
    //requête SQL
    $sql = 'SELECT * FROM `clients` WHERE `identifiant` = :login AND `motdepasse` = :password';
    //connexion à la bd
    $connect = connect($db);
    //préparation de la requête
    $query = $connect->prepare($sql);
    //Ajout des entrées de '$tempData' à la place des ':login' & ':password' + exécute
    $query->execute([
        'login'    => $login,
        'password' => $password,
    ]);
    //récupération des données
    $data = $query->fetchAll();
    //deconnexion
    deconnect($connect);

    return $data;
}

/**
 * Chercher un user par son login.
 *
 * @param array  $db
 * @param string $login
 *
 * @return array
 */
function user_by_login($db, $login)
{
    //requête SQL
    $sql = 'SELECT * FROM `clients` WHERE `identifiant` = :login';
    //connexion à la bd
    $connect = connect($db);
    //préparation de la requête
    $query = $connect->prepare($sql);
    //Ajout des entrées de '$tempData' à la place ':login' + exécute
    $query->execute([
        'login' => $login,
    ]);
    //récupération des données
    $data = $query->fetchAll();
    //deconnexion
    deconnect($connect);

    return $data;
}

/**
 * Undocumented function.
 *
 * @param [type] $db
 * @param [type] $login
 * @param [type] $password
 *
 * @return string|bool
 */
function user_create($db, $login, $password)
{
    $sql = 'INSERT INTO `clients` (`identifiant`, `motdepasse`) VALUES (:login, :password)';
    $newId = false;

    $connect = connect($db);
    $query = $connect->prepare($sql);
    $created = $query->execute([
        'login'    => $login,
        'password' => $password,
    ]);

    if ($created) {
        $newId = $connect->lastInsertId();
    }

    deconnect($connect);

    return $newId;
}

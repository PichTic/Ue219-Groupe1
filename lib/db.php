<?php

/**
 * Ouvre la connexion à la base de données.
 *
 * @param array $db Configuration de la base de données
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
 * Fin de connexion à la base de données.
 *
 * @param PDO $connect
 */
function deconnect($connect)
{
    unset($connect);
}

/**
 * Cherche si un utilisateur le couple login/pwd existe.
 *  - Si l'user existe, on retourne ses données sur $data[0]
 *  - si l'user n'existe pas, $data est un array vide.
 *
 * @param array  $db       Array de configuration (laisser $db)
 * @param string $login    Identifiant de l'user
 * @param string $password Mot de passe de l'user
 *
 * @return array
 */
function user_exists($db, $login, $password)
{
    // La requête SQL : chercher un user avec un identifant X ET un mot de passe Y ?
    $sql = 'SELECT * FROM `clients` WHERE `identifiant` = :login AND `motdepasse` = :password';
    //connexion à la bd
    $connect = connect($db);
    // préparation de la requête
    $query = $connect->prepare($sql);
    // substitution des entrées de $login et $mdp à la place des ':login' & ':password'
    // et exécute la requête
    $query->execute([
        'login'    => $login,
        'password' => $password,
    ]);
    // récupération des données
    $data = $query->fetchAll();
    // deconnexion
    deconnect($connect);

    return $data;
}

/**
 * Chercher un user par son login.
 *  - Si l'user existe, on retourne ses données sur $data[0]
 *  - si l'user n'existe pas, $data est un array vide.
 *
 * @param array  $db    Array de configuration (laisser $db)
 * @param string $login Identifiant de l'user
 *
 * @return array
 */
function user_by_login($db, $login)
{
    // La requête SQL : chercher un user avec un identifant X ?
    $sql = 'SELECT * FROM `clients` WHERE `identifiant` = :login';
    // connexion à la bd
    $connect = connect($db);
    // préparation de la requête
    $query = $connect->prepare($sql);
    // substitution de l'entrées de $login  à la place de ':login'
    // et exécute la requête
    $query->execute([
        'login' => $login,
    ]);
    // récupération des données
    $data = $query->fetchAll();
    // deconnexion
    deconnect($connect);

    return $data;
}

/**
 * Créer un nouvel utilisateur en base de données.
 *  - S'il est créé : retourne l'id de la base de données
 *  - S'il n'est pas créé retourne FALSE.
 *
 * @param array  $db       Array de configuration (laisser $db)
 * @param string $login    Identifiant de l'user
 * @param string $password Mot de passe de l'user
 *
 * @return string|bool
 */
function user_create($db, $login, $password)
{
    $sql = 'INSERT INTO `clients` (`identifiant`, `motdepasse`) VALUES (:login, :password)';
    $user_id = false;

    $connect = connect($db);
    $query = $connect->prepare($sql);
    $created = $query->execute([
        'login'    => $login,
        'password' => $password,
    ]);

    // si la création s'est passée, on récupère le nouvel id
    if ($created) {
        $user_id = $connect->lastInsertId();
    }

    deconnect($connect);

    return $user_id;
}

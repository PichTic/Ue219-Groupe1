<?php

include 'config.php';


/**
 * Methode trouvé sur PHP7 Avancé Edition Eyrolles p.436
 *
 * @param array $db
 * @return PDO
 */
function connect($db) {
  $dsn = "mysql:dbname={$db['Name']};host={$db['Server']};port={$db['Port']};charset=utf8";

  try {
    $connect = new PDO($dsn, $db['User'], $db['Pass']);
  }
  catch (PDOException $e) {
    printf("Erreur de connexion : %s\n", $e->getMessage());
  }
  /**
   * http://php.net/manual/en/pdo.setattribute.php
   */
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $connect;
}


/**
 * déconnexion
 *
 * @param PDO $connect
 * @return void
 */
function deconnect($connect) {
  unset($connect);
}

?>

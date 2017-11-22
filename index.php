<?php

include 'lib/db.php';

// j'initialise la connexion à la base de données
$connect = connect($db);

// je teste une simple requête
$sql = 'select * from clients';
$clients = $connect->query($sql);
// j'afficher le résultat en mode débug avec un var_dump()
var_dump($clients->fetch());

// je me déconnecte de la base de données
deconnect($connect);


echo "<p>Coucou Monde</p>";

?>
<?php
    session_start();
    require_once 'lib/includes.php';
    auth_only();

    //tentative de connexion à la bdd
    try{
         // Mettez un nom de base erroné pour voir apparaître le message d'erreur
        $bdd=new PDO('mysql:host=localhost;dbname=projetue219','root','');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    //récupération d'infos de la bdd
    $reponse=$bdd->query('SELECT * FROM clients WHERE identifiant=\''.$_SESSION['client']['login'].'\'');
    $donnees=$reponse->fetch();
    $reponse->CloseCursor();
    $mdpverif=$donnees['motdepasse'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Paramètres du compte</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/custom.css">
    </head>
    <body>
         <?php
            // inclusion de la nav
            include 'vues/nav.php';

                //changement du pseudo dans la bdd
                if (!empty($_POST['login'])) {
                    $login = $_POST['login'];
                    $query=$bdd->prepare('UPDATE clients SET identifiant
                        =:identifiant WHERE id=\''.$donnees['id'].'\'');
                    $query->bindValue(':identifiant',$login,PDO::PARAM_STR);
                    $query->execute()or die (print_r($req->errorInfo()));
                    $query->CloseCursor();
                    $_SESSION['client']['login']=$login;
                }

                //changement du mdp dans la bdd
                if (!empty($_POST['oldmdp']) && !empty($_POST['mdp'])) {
                    if($_POST['oldmdp']===$mdpverif && $_POST['mdp']!=$_POST['oldmdp']) {
                        $query=$bdd->prepare('UPDATE clients SET motdepasse=:motdepasse WHERE id=\''.$donnees['id'].'\'');
                        $query->bindValue(':motdepasse',$_POST['mdp'],PDO::PARAM_STR);
                        $query->execute()or die (print_r($req->errorInfo()));
                        $query->CloseCursor();
                    }else{
                        $erreur ="<p>Ce n'est pas possible. Vous avez rentré un mot de passe erroné</p>";
                    }
                }
            ?>
        <div id="main" class="container">
            <h2>Vos informations Personnelles</h2>
             <p>Votre Login actuel est : <?php echo $_SESSION['client']['login'];?></p>
            <a href="">Voir vos biens</a>
            <form action="parametres.php" method="POST">
                <fieldset>
                    <legend>Modifier vos informations</legend>
                    <label>Votre nouveau Login :</label>
                    <input type="text" name="login" placeholder="Nouveau Login"><br>
                    <legend>Changer de Mot de passe </legend>
                    <label>Tapez votre ancien mot de passe puis le nouveau pour changer de mot de passe.</label><br>
                    <label>Votre ancien Mot de passe :</label>
                    <input type="password" name="oldmdp" placeholder="Ancien Mdp"><br>
                    <label>Votre nouveau Mot de passe :</label>
                    <input type="password" name="mdp" placeholder="Nouveau Mdp"><br>
                    <input type="submit" class="btn btn-lg btn-primary" value="Valider">
                </fieldset>
            </form>
            <?php
                if (!empty($erreur)) {
                    echo $erreur;
                }
            ?>
        </div>
        <script src="./js/jquery-3.2.1.min.js"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>

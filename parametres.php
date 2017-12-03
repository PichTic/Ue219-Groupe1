<?php
    session_start();
    require_once 'lib/includes.php';
    //tentative de connexion à la bdd
    try{   
         // Mettez un nom de base erroné pour voir apparaître le message d'erreur 
        $bdd=new PDO('mysql:host=localhost;dbname=projetue219','root','');
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    //récupération d'infos de la bdd
    if (isset($_POST['login'])) {
        $reponse=$bdd->query('SELECT identifiant, id FROM clients WHERE identifiant=\''.$_SESSION['client']['login'].'\'');
        $donnees=$reponse->fetch();
        $reponse->CloseCursor();
    }
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
        ?>
        <?php 
                //changement du pseudo dans la bdd
                if (isset($_POST['login'])) {
                    $login = $_POST['login'];
                    $query=$bdd->prepare('UPDATE clients SET identifiant 
                        =:identifiant WHERE id=\''.$donnees['id'].'\'');
                    $query->bindValue(':identifiant',$login,PDO::PARAM_STR);
                    $query->execute()or die (print_r($req->errorInfo()));
                    $query->CloseCursor();
                    $_SESSION['client']['login']=$login;
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
                    <!--p>Vous avez : <span></span> biens en vente.</p>
                    <p>Votre Login est : <?php echo $donnees['identifiant'];?></p>
                    <label>Nom :</label>
                    <input type="text"><br>
                    <label>Prenom :</label>
                    <input type="text"><br>
                    <label>Téléphone</label>
                    <input type="text"><br>
                    <label>E-mail</label>
                    <input type="text"><br-->
                    <label>Votre nouveau Mot de passe :</label>
                    <input type="text" name="mdp" placeholder="Nouveau Mdp"><br>
                    <input type="submit" value="Valider">
                </fieldset>
            </form>
        </div>        
    </body>
</html>
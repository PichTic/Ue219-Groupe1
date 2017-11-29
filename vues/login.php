<?php
// si l'user est déjà connecté, inutile d'afficher le form de connexion
if (! is_auth()) :
    // affiche des éventuelles erreurs du formulaire de connexion
    flash('danger', 'error_connexion');
?>
<form class="form-signin" method="POST" action="">
    <h2 class="form-signin-heading h4 text-center">Identifiez-vous</h2>

    <label for="login" class="sr-only">Identifiant</label>
    <input name="login" type="text" id="login" class="form-control" placeholder="Identifiant">

    <label for="password" class="sr-only">Mot de passe</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Mot de passe">

    <button name="connexion" class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
</form>
<?php
endif;
?>
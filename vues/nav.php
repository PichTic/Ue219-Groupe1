<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="./index.php">UCHI</a>
        <!-- Bouton de la nav en responsive  -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <!--  items de navigation (sur la gauche) -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('index'); ?>" href="./index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('test'); ?>" href="./test.php">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('recherche'); ?>" href="./recherche.php">Recherche</a>
                </li>
                    <?php
                    // si l'user est connecté
                    if (is_auth()) :
                    ?>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('annonces-post'); ?>" href="./annonces-post.php">Créer une annonce</a>
                </li>
                <?php
                endif;
                ?>
            </ul>
            <!--  items de navigation spécifiques (sur la droite) -->
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <?php
                // si l'user est connecté
                if (is_auth()) :
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('parametres'); ?>" href="./parametres.php">Mon profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('mesAnnonces'); ?>" href="./mesAnnonces.php">Mes annonces</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="./logout.php">Déconnexion</a>
                </li>
                <?php
                else :
                // si l'user n'est pas connecté
                ?>
                <li class="nav-item">
                    <a class="btn btn-info <?php  is_page_active('register'); ?>" href="./register.php">Créer un compte</a>
                </li>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</nav>

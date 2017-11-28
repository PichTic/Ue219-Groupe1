<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="./index.php">UCHI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('index'); ?>" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('test'); ?>" href="./test.php">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <?php
                if (is_auth()) :
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Déconnexion</a>
                </li>
                <?php
                else :
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php  is_page_active('register'); ?>" href="./register.php">Créer un compte</a>
                </li>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</nav>

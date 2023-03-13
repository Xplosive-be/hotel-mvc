<nav class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="accueil" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img class="logo-menu" src="<?= URL ?>/public/assets/images/logo.png" alt="" srcset="">
        </a>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 fs-5">
            <li></li>
            <li><a href="accueil" class="nav-link px-6 link-dark">Accueil</a></li>
            <li><a href="bedrooms" class="nav-link px-6 link-dark">Chambres</a></li>
            <li><a href="contact" class="nav-link px-6 link-dark">Contact</a></li>
        </ul>

        <?php
        // Affichage bouton admin si le profil est administrateur
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
            echo '
                <div class="col-md-3 text-end text-nowrap">
                 <a href="profil"><button type="button" class="btn btn-warning text-dark">' . $_SESSION["surname"] . ' ' . $_SESSION["name"] .'</button></a>
                 <a href="admin"><button type="button" class="btn btn-primary text-white"><i class="fa-solid fa-screwdriver-wrench"></i> Admin</button></a>
                 <a href="disconnect"><button type="button" class="btn btn-outline-danger me-2"><i class="fa-solid fa-xmark"></i></button></a> 
                </div>';
            // Affichage bouton profil
        } elseif(isset($_SESSION['admin'])){
            echo '
                <div class="col-md-3 text-end">
                    <a href="profil"><button type="button" class="btn btn-warning text-dark">' . $_SESSION["surname"] . ' ' . $_SESSION["name"] .'</button></a>
                    <a href="disconnect"><button type="button" class="btn btn-outline-danger me-2"><i class="fa-solid fa-xmark"></i></button></a> 
                </div>';
        }  else {
            // Nouveaux sur le site Bouton de connection + inscription
            echo '
                <div class="col-md-3 text-end">
                <a href="login"><button type="button" class="btn btn-outline-danger me-2">Connexion</button></a>
                    <a href="apply"><button type="button" class="btn btn-danger">Inscription</button></a>
                </div>';
        }
        ?>
    </header>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="accueil">
            <img class="logo-menu" src="<?= URL ?>/public/assets/images/logo.png" alt="" srcset="">
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
            <li><a href="accueil" class="nav-link px-6 link-dark">Accueil</a></li>
            <li><a href="restaurant" class="nav-link px-6 link-dark">Restaurant</a></li>
            <li><a href="spa" class="nav-link px-6 link-dark">Spa & Bien-être</a></li>
            <li><a href="bedrooms" class="nav-link px-6 link-dark">Chambres</a></li>
            <li><a href="contact" class="nav-link px-6 link-dark">Contact</a></li>
        </ul>

        <div class="col-md-3 text-end">
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
                <button type="button" class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Connexion</button>
                    <a href="apply"><button type="button" class="btn btn-danger">Inscription</button></a>
                </div>';
            }
            ?>
        </div>
    </div>

</nav>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Bienvenu(e)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login" method="post" class="form-signin">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" name="login"placeholder="<?= $HOTEL_EMAIL ?>" required>
                        <label for="floatingInput">Adresse mail</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Mot de passe</label>
                    </div>
                    <button class="w-100 mt-3 btn btn-danger" type="submit" name="btnConnection">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

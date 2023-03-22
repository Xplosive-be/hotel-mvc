<div class="text-center body-signin ">

    <main class="form-signin">
        <form action="" method="post">
            <img class="mb-4" src="<?= URL ?>public/assets/images/logo-mini.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Bienvenu(e)</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="login"placeholder="<?= $HOTEL_EMAIL ?>" required>
                <label for="floatingInput">Adresse mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <button class="w-100 mt-3 btn btn-danger type="submit" name="btnConnection">Se connecter</button>
            <a href="accueil"><button class="w-100 my-3 btn btn-danger" type="button">Retour à l'acceuil</button></a>
            <p class="mt-5 mb-3 text-danger">&copy; Site Web dynamique 2021 - 2022 </p>
        </form>
    </main>
</div>

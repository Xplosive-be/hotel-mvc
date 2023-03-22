<div class="container">
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="<?= URL ?>public/assets/images/logo.png" alt="Logo Hotel Belle nuit" width="100" height="100">
            <h2 class="text-danger fw-bold">Inscription</h2>
            <p class="lead fst-italic">Vous désirez réserver une chambre dans notre hôtel ? Alors inscrivez-vous.</p>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Information</h4>
                <form  name="formulaire" method="post" action="" >
                    <div class="row g-3">
                        <!-- Prénom -->
                        <div class="col-sm-6">
                            <label for="surName" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="surName" name="surname" required>
                        </div>
                        <!-- Nom -->
                        <div class="col-sm-6">
                            <label for="Name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="Name" name="name" required>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <label for="email" class="form-label">Adresse e-mail <span class="text-muted"> (Obligatoire)</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemple@belle-hotel.com">
                        </div>
                        <!-- mot de passe -->
                        <div class="col-12">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <!--  répéter mot de passe -->
                        <div class="col-12">
                            <label for="password" class="form-label">Répéter mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password_two">
                        </div>
                        <!-- Adresse -->
                        <div class="col-12">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address"placeholder="Rue de la paix" required>
                        </div>
                        <!-- Pays -->
                        <div class="col-sm-6">
                            <label for="country" class="form-label">Pays</label>
                            <select class="form-select" id="country" name="country" required>
                                <?php
                                // Donne la possibilité d'avoir la liste des pays
                                foreach($countrys as $country)
                                {
                                    echo '<option value="'.$country['country_id'].'"'.(($country['country_fr']==$COUNTRY)?' selected':'').'>'.$country['country_fr'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Ville -->
                        <div class="col-sm-6">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-danger btn-lg" type="submit" name="btnRegistration">Envoyer</button>
                </form>
            </div>
        </div>
    </main>
</div>

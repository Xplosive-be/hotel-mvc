<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="text-start ">
                <form class="w-75 mx-auto pb-5" method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Modification du profil</h1>
                    <div class="row g-3">
                        <!-- Prénom -->
                        <div class="col-sm-6">
                            <label for="surname" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="surname"
                                   value="<?= $profil['acc_surname'] ?>" name="surname" required>
                        </div>
                        <!-- Nom -->
                        <div class="col-sm-6">
                            <label for="Name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="Name" value="<?= $profil['acc_name'] ?>"
                                   name="name" required>
                        </div>
                        <!-- Email -->
                        <div class="col-12">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" disabled
                                   value="<?= $profil['acc_email'] ?>">
                        </div>
                        <!-- Adresse -->
                        <div class="col-6">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="<?= $profil['acc_address'] ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="codePostal" class="form-label">Code Postal</label>
                            <input type="text" class="form-control"  value="<?= $profil['acc_codepostal'] ?> " id="codePostal" name="codePostal" required>
                        </div>
                        <div class="col-6">
                            <label for="box" class="form-label">Boite</label>
                            <input type="text" class="form-control" id="box" name="box"  value="<?= $profil['acc_addressbox'] ?>" required>
                        </div>
                        <!-- Pays -->
                        <div class="col-6">
                            <label for="country" class="form-label">Pays</label>
                            <select class="form-select" id="country" name="country" required>
                                <?php
                                foreach ($countrys as $country) {
                                    echo '<option value="' . $country['country_id'] . '"' . (($country['country_id'] == $profil['acc_id_country']) ? ' selected' : '') . '>' . $country['country_fr'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Ville -->
                        <div class="col-6">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" value="<?= $profil['acc_city'] ?>"
                                   name="city" required>
                        </div>
                        <div class="col-6">
                            <label for="tel" class="form-label">Numéro de téléphone :</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="<?= $profil['acc_phone'] ?>" placeholder="+32 123456789" pattern="^[+][0-9]{1,4}[0-9]{4,}$" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="mt-3 btn btn-danger mx-2 fw-bolder text-center" type="submit" name="btnEdit">Modifier</button>
                            <a class="mt-3 btn btn-secondary mx-2 fw-bolder text-center" href="dashboard">Retour au tableau de bord</a>
                        </div>
                </form>
        </div>
    </div>
</div>
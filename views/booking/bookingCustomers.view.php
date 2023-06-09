<div class="shadow-lg p-3 mb-5 bg-body rounded">
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 60%"
             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3 d-none d-md-block">
            <span class="badge bg-light text-dark rounded">1</span>
            <span class="badge bg-light text-dark">Choix de votre chambre</span>
        </div>
        <div class="col-md-3 d-none d-md-block">
            <span class="badge bg-light text-dark rounded">2</span>
            <span class="badge bg-light text-dark">Choix des bonus</span>
        </div>
        <div class="col-md-3 d-none d-md-block">
            <span class="badge bg-danger text-white rounded">3</span>
            <span class="badge bg-danger text-white">Vos informations</span>
        </div>
        <div class="col-md-3 d-none d-md-block ">
            <span class="badge bg-light text-dark rounded">4</span>
            <span class="badge bg-light text-dark">Récapitulatif</span>
        </div>
    </div>
</div>
<div class="container-fluid">
    <form action="bookingResume" method="post">
    <div class="row">
        <div class="col-md-9">
            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <h5 class="text-danger fw-bold">Vos informations</h5>
                <hr class="solid">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="gender" class="form-label">Civilité :</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" selected disabled>Sélectionnez votre civilité</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                            <option value="NB">Non-binaire</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="surname" class="form-label">Prénom :</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Prénom" required>
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Adresse e-mail :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6 mt-3">
                        <small class="fw-bold"><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>Veuillez noter que le bon de réservation sera envoyé à cette adresse e-mail, il est donc important de saisir une adresse valide.<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></small>
                    </div>
                </div>
                <hr class="solid mt-3">
                <h5 class="text-danger fw-bold mb-3">Vos adresses</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="address" class="form-label">Rue & Numéro:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <div class="col-md-4">
                        <label for="box" class="form-label">Boîte :</label>
                        <input type="text" class="form-control" id="box" name="box">
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">Ville :</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col-md-4">
                        <label for="postalCode" class="form-label">Code postal :</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Pays :</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="" selected disabled>Choisissez votre pays</option>
                                <?php
                                // Donne la possibilité d'avoir la liste des pays
                                foreach($countrys as $country)
                                {
                                    echo '<option value="'.$country['country_id'].'">'.$country['country_fr'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Numéro de téléphone :</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="+32123456789" pattern="^[+][0-9]{1,4}[0-9]{4,}$" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="mb-5 row">
                        <div class="col-md-6 text-begin">
                            <a href="bookingAvailable" class="btn  btn-dark rounded">Retour</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-danger rounded fw-bold" name="btnCustomer">Continuer la réservation</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <h5 class="text-center mb-4 text-danger fst-italic fw-bolder">Hôtel Belle-Nuit</h5>
                <hr class="solid">
                <div class="text-center">
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-in</h6>
                    <p><?= $_SESSION['booking']['dateBeginTxt'] ?></p>
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-out</h6>
                    <p><?= $_SESSION['booking']['dateEndTxt'] ?></p>
                </div>
                <hr class="solid">
                <div class="text-center">
                    <p><?= $_SESSION['booking']['bedroom_name'] ?></p>
                    <p class="fw-bolder fst-italic">Prix pour <?= $_SESSION['booking']['nights'] ?> nuits :</p>
                    <p class="bold"><?= $_SESSION['booking']['price'] ?> €</p>
                </div>
                <hr class="solid">
                <div class="text-center">
                    <p class="fw-bolder fst-italic">Services :</p>
                    <?php if(empty($_SESSION['booking']['services'])) : ?>
                        <p>Pas de service demandé</p>
                    <?php else: ?>
                        <?php foreach ($_SESSION['booking']['services'] as $service_name => $service) : ?>
                            <p><?= $service['name'] ?> : <?= $service['price'] ?> €</p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#condition">
                        Conditions de réservation
                    </button>
                </div>
            </div>
        </div>
<?php require_once("views/booking/common/__modalCondition.php"); ?>
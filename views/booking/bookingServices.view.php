<div class="shadow-lg p-3 mb-5 bg-body rounded">
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3  d-none d-md-block">
            <span class="badge  bg-light text-dark rounded">1</span>
            <span class="badge  bg-light text-dark">Choix de votre chambre</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge bg-danger text-white rounded">2</span>
            <span class="badge bg-danger text-white">Choix des bonus</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge  bg-light text-dark rounded">3</span>
            <span class="badge bg-light text-dark">Vos informations</span>
        </div>
        <div class="col-md-3  d-none d-md-block ">
            <span class="badge  bg-light text-dark rounded">4</span>
            <span class="badge bg-light text-dark">Récapitulatif</span>
        </div>
    </div>
</div>
<?php // var_dump($_SESSION['booking']);?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <form action="bookingCustomers" method="post">
                    <h3>Profitez bien de votre séjour</h3>
                    <h4 class="mb-5">Suppléments optionnels</h4>
                    <?php foreach ($allServices as $service) :?>
                        <div class="row">
                            <h6 class="mb-3"><?= $service['service_name']?></h6>
                            <div class="col-md-6">
                                <img src="<?= $service['service_picture'] ?>" class="sizeImgServices rounded-5" alt="<?= $service['service_name']?>">
                            </div>
                            <div class="col-md-3 mt-5 text-end">
                                <span class="fw-bold align-middle"> €<?= $service['service_price'] ?></span>
                            </div>
                            <div class="col-md-3 mt-5 text-end">
                                <input class="form-check-input large-checkbox" type="checkbox" name="services[]" value="<?= $service['service_id'] ?>" id="flexCheckDefault">
                            </div>
                            <hr class="mt-3">
                        </div>
                    <?php endforeach; ?>
                    <div class="mb-5 row">
                        <h4 class="mb-3">Informations supplémentaires</h4>
                        <div class="col-md-4">
                            <h5 class="mb-3">Heure d'arrivée estimée</h5>
                            <p class="text-muted mb-1">Check-in à</p>
                            <select id="arrivalTime" name="arrivalTime" class="form-select mb-3" required>
                                <option value="" disabled selected>Sélectionnez une heure</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="mb-5 row">
                        <h4 class="mb-3">Commentaires</h4>
                        <div class="col-md-12">
                            <textarea id="comments" name="comments" placeholder="Saisissez vos commentaires ici" class="inputServices"></textarea>
                        </div>
                    </div>
                <div class="mb-5 row">
                    <div class="col-md-6 text-begin">
                        <a href="bookingAvailable" class="btn  btn-dark rounded">Retour</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-danger rounded fw-bold" type="submit" name="btnServices">Continuer la réservation</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-2" >
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <h5 class="text-center mb-4 text-danger fst-italic fw-bolder">Hôtel Belle-Nuit</h5>
                <hr class="solid">
                <div class="text-center">
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-in</h6>
                    <p><?= $_SESSION['booking']['dateBeginTxt']?></p>
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-out</h6>
                    <p><?= $_SESSION['booking']['dateEndTxt']?></p>
                </div>
                <hr class="solid">
                <div class="text-center ">
                    <p class="fw-bolder fst-italic">Chambre:</p>
                    <p><?= $_SESSION['booking']['bedroom_name'] ?></p>
                    <p class="fw-bolder fst-italic">Prix pour <?= $_SESSION['booking']['nights']?> nuits :</p>
                    <p class="bold"><?= $_SESSION['booking']['price'] ?> €</p>
                </div>
                <hr class="solid">
                <div class="text-center sm">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#condition">
                        Conditions de réservation
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("views/booking/common/__modalCondition.php"); ?>
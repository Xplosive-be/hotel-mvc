<div class="shadow-lg p-3 mb-5 bg-body rounded">
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3  d-none d-md-block">
            <span class="badge bg-danger text-white rounded">1</span>
            <span class="badge bg-danger text-white">Choix de votre chambre</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge bg-light text-dark rounded">2</span>
            <span class="badge bg-light text-dark">Choix des bonus</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge bg-light text-dark rounded">3</span>
            <span class="badge bg-light text-dark">Vos informations</span>
        </div>
        <div class="col-md-3  d-none d-md-block ">
            <span class="badge bbg-light text-dark rounded">4</span>
            <span class="badge bg-light text-dark">Récapitulatif</span>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="shadow-lg p-3 mb-5 bg-body rounded" id="available">
                <h2 class="text-center mb-4 text-danger fst-italic fw-bolder">Consultation des disponibilités et des tarifs</h2>
                <form class="row g-3 align-items-end" method="post" action="bookingAvailable">
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateBegin" min="<?php echo date('Y-m-d'); ?>" class="form-control"
                                   placeholder="Date de départ" value="<?= isset($_SESSION['booking']['dateBegin']) ? $_SESSION['booking']['dateBegin'] : ''; ?>">
                            <label for="dateBegin">Date de départ :</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateEnd" min="<?php echo date('Y-m-d'); ?>" class="form-control"
                                   placeholder="Date d'arrivée :" value="<?= isset($_SESSION['booking']['dateEnd']) ? $_SESSION['booking']['dateEnd'] : ''; ?>">
                            <label for="dateEnd">Date d'arrivée :</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3 align-self-end">
                        <button type="submit" class="btn-xs btn-danger rounded fw-bold ">Afficher les disponibilités</button>
                    </div>
                </form>
            </div>
            <!--            //-->
            <!--            Affichage des chambres disponibles à la réservation-->
            <!--            //-->
            <?php foreach ($bedroomsAvailable as $bedroom) : ?>
                <?php $carousel = 'carousel' . $bedroom['bedroom_id'] ?>
                <main class="container bg-light p-5 border border-danger rounded mb-5 mt-5">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 mb-3 mb-md-0">
                            <h2 class="text-danger fst-italic fw-bolder "><?= $bedroom['bedroom_name'] ?></h2>
                            <p class="lead"><?= $bedroom['bedroom_description'] ?></p>
                        </div>
                        <div id="<?= $carousel ?>" class="carousel slide col-md-6 col-lg-6 col-xl-6"
                             data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                <?php
                                $images = $this->frontManager->getImagesBedroom($bedroom['bedroom_id']);
                                $keys = 0;
                                if (!empty($images)) {
                                    foreach ($images as $key => $bedroomImages) {
                                        $active = ($key == 0) ? 'active' : '';
                                        echo '<div class="carousel-item ' . $active . '">';
                                        echo '<img src="' . $bedroomImages["picture_url"] . '" class="d-block carousel-img" alt=""></div>';
                                        $key++;
                                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carousel . '" data-bs-slide="prev">
                                              <span class="carousel-control-prev-icon svg-fill-red" aria-hidden="true"></span>
                                              <span class="visually-hidden">Previous</span>
                                              </button>
                                              <button class="carousel-control-next" type="button" data-bs-target="#' . $carousel . '" data-bs-slide="next">
                                              <span class="carousel-control-next-icon svg-fill-red" aria-hidden="true"></span>
                                              <span class="visually-hidden">Next</span>
                                              </button>';
                                    }
                                } else {
                                    echo '<div class="carousel-item active">
                                        <img src="' . URL . 'public/assets/images/chambres/default.png" class="d-block carousel-img" alt="Bientôt disponible">
                                        </div>
                                        <div class="carousel-item ">
                                        <img src="' . URL . 'public/assets/images/chambres/default.png" class="d-block carousel-img" alt="Bientôt disponible">
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <?php $prixTotal = $bedroom['bedroom_priceday'] * $totalNight ?>
                        <p>Total pour <span class="fw-bold"><?= $totalNight ?> </span>nuit(s): <span
                                    class="fw-bold"><?= $prixTotal ?> </span>€</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="bookingServices&idBedroom=<?= $bedroom['bedroom_id']?>">
                            <button class="mt-3 btn btn-danger align-self-end">
                                Réserver <?= $bedroom['bedroom_name'] ?></button>
                        </a>
                    </div>
                </main>
            <?php endforeach; ?>
            <!--            /-->
            <!--            Affichages des chambres non disponible-->
            <!--            /-->
            <?php foreach ($bedroomsNotAvailable as $bedroom) : ?>
                <?php $carousel = 'carousel' . $bedroom['bedroom_id'] ?>
                <main class="container bg-light p-5 border border-secondary rounded mb-5 mt-5 bg-opacity">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 mb-3 mb-md-0">
                            <h2 class="text-secondary fst-italic fw-bolder "><?= $bedroom['bedroom_name'] ?></h2>
                            <p class="lead"><?= $bedroom['bedroom_description'] ?></p>
                        </div>
                        <div id="<?= $carousel ?>" class="carousel slide col-md-6 col-lg-6 col-xl-6">
                            <div class="carousel-inner">
                                <?php
                                $images = $this->frontManager->getImagesBedroom($bedroom['bedroom_id']);
                                $keys = 0;
                                if (!empty($images)) {
                                    foreach ($images as $key => $bedroomImages) {
                                        $active = ($key == 0) ? 'active' : '';
                                        echo '<div class="carousel-item ' . $active . '">';
                                        echo '<img src="' . $bedroomImages["picture_url"] . '" class="d-block carousel-img filter-grey" alt=""></div>';
                                        $key++;
                                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carousel . '" disabled>
                                              <span class="carousel-control-prev-icon svg-fill-gray" aria-hidden="true"></span>
                                              <span class="visually-hidden">Previous</span>
                                              </button>
                                              <button class="carousel-control-next" type="button" data-bs-target="#' . $carousel . '" disabled>
                                              <span class="carousel-control-next-icon svg-fill-gray" aria-hidden="true"></span>
                                              <span class="visually-hidden">Next</span>
                                              </button>';}
                                } else {
                                    echo '<div class="carousel-item active">
                                          <img src="' . URL . 'public/assets/images/chambres/default.png" class="d-block carousel-img filter-grey " alt="Bientôt disponible">
                                          </div>
                                          <div class="carousel-item ">
                                          <img src="' . URL . 'public/assets/images/chambres/default.png" class="d-block carousel-img filter-grey " alt="Bientôt disponible">
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                            <button class="mt-3 btn btn-secondary align-self-end" disabled>Non-disponible</button>
                    </div>
                </main>
            <?php endforeach; ?>
        </div>
<!--        //-->
<!--        Div qui sert à résumé les dates de disponibilités à droite -->
<!--        //-->
            <div class="col-md-2" >
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <h5 class="text-center mb-4 text-danger fst-italic fw-bolder">Hôtel <br> Belle-Nuit</h5>
                    <hr class="solid">
                    <div class="text-center sm">
                        <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-in</h6>
                        <p><?= $_SESSION['booking']['dateBeginTxt'] ?></p>
                        <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-out</h6>
                        <p><?= $_SESSION['booking']['dateEndTxt']?></p>
                    </div>
                    <hr class="solid">
                    <div class="text-center sm">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#condition">
                            Conditions de réservation
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="condition" tabindex="-1" aria-labelledby="conditionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="conditionModalLabel">Conditions de réservation</h5>
                </div>
                <div class="modal-body FontsModalReservation">
                    Les montants et pourcentages des conditions ci-dessous, sont à payer par les clients, en cas
                    d’annulation.
                    <br>
                    Conditions générales (réservations individuelles):
                    <br>
                    <ul>
                        <li><small>De 7 à 0 jours avant date d’arrivée: 100%.</small></li>
                        <li><small>Sans frais 7 jours avant la date d'arrivée.</small></li>
                        <li><small>Réservation non-remboursable : perte du montant total.</small></li>
                    </ul>
                    Le bureau de la réception, accessible au <a href="tel:+32496156215">+32 496 15 62 15</a> est ouvert
                    de 8h à 18h.
                    <br>
                    Le check-in s'effectue à partir de 15 h jusque maximum 21h.
                    <br>
                    Si vous souhaitez une arrivée tardive, soit après 22h, il est impératif de contacter la réception
                    afin de prendre un arrangement au <a href="tel:+32496156215">+32 496 15 62 15</a>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
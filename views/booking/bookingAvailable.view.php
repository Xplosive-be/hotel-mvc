<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="shadow-lg p-3 mb-5 bg-body rounded" id="available">
                <h2 class="text-center mb-4 text-danger fst-italic fw-bolder">Consultation des disponibilités et des
                    tarifs</h2>
                <form class="row g-3 align-items-end" method="post" action="BookingAvailable">
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateBegin" min="<?php echo date('Y-m-d'); ?>" class="form-control"
                                   placeholder="Date de départ"
                                   value="<?= isset($_POST['dateBegin']) ? $_POST['dateBegin'] : ''; ?>">
                            <label for="dateBegin">Date de départ :</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateEnd" min="<?php echo date('Y-m-d'); ?>" class="form-control"
                                   placeholder="Date d'arrivée :"
                                   value="<?= isset($_POST['dateEnd']) ? $_POST['dateEnd'] : ''; ?>">
                            <label for="dateEnd">Date d'arrivée :</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3 align-self-end">
                        <button type="submit" class="btn-xs btn-danger rounded fw-bold ">Afficher les disponibilités</button>
                    </div>
                </form>
            </div>
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
                      <span class="carousel-control-prev-icon svg-fill-red" style="background-color: " aria-hidden="true"></span>
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
                        <?php $prixTotal = $bedroom['bedroom_priceday'] * $totalNight  ?>
                        <p>Total pour <span class="fw-bold"><?=$totalNight ?> </span>nuit(s): <span class="fw-bold"><?= $prixTotal ?> </span>€</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="#available">
                            <button class="mt-3 btn btn-danger align-self-end">Réserver <?= $bedroom['bedroom_name'] ?></button>
                        </a>
                    </div>
                </main>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2">
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <h5 class="text-center mb-4 text-danger fst-italic fw-bolder">Hôtel <br> Belle-Nuit</h5>
                <hr class="solid">
                <div class="text-center sm">
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-in</h6>
                    <p><?= $dateBeginTxt ?></p>
                    <h6><i class="fa fa-fw fa-calendar-o fa-lg"></i>Check-out</h6>
                    <p><?= $dateEndTxt ?></p>
                </div>
                <hr class="solid">
                <div class="text-center sm">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#condition">
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
                <h5 class="modal-title" id="conditionModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Les montants et pourcentages des conditions ci dessous , sont à payer par les clients, en cas d’annulation.

                Conditions générales (réservations individuelles)

                De 7 à 0 jours avant date d’arrivé: 100%
                Sans frais 7 jours avant la date d'arrivée
                Réservation non-remboursable : perte du montant total.

                Le bureau de la réception, accessible au  00 32 86 21 23 00 est ouvert de 8h à 18h.

                Le check-in s'effectue à partir de 15h jusque maximum 21h.

                si vous souhaitez une arrivée tardive, soit après 22h, il est impératif de contacter la réception afin de prendre un arrangement au  00 32 86 21 23 00


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
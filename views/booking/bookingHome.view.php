<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="shadow-lg p-3 mb-5 bg-body rounded" id="available">
                <h2 class="text-center mb-4 text-danger fst-italic fw-bolder">Consultation des disponibilités et des
                    tarifs</h2>
                <form class="row g-3 align-items-end" method="post" action="bookingAvailable" onsubmit="return compareDates()">
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateBegin" id="dateBegin" min="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Date d'arrivée:">
                            <label for="dateBegin">Date de départ :</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="date" name="dateEnd" id="dateEnd" min="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Date départ:">
                            <label for="dateEnd">Date d'arrivée :</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3 align-self-end">
                        <button type="submit" class="btn-xs btn-danger rounded fw-bold ">Afficher les disponibilités
                        </button>
                    </div>
                </form>
            </div>
            <?php foreach ($bedrooms as $bedroom) : ?>
                <?php $carousel = 'carousel' . $bedroom['bedroom_id'] ?>
                <main class="container bg-light p-5 border border-danger rounded mb-5 mt-5">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="text-danger fst-italic fw-bolder "><?= $bedroom['bedroom_name'] ?></h2>
                            <p><?= $bedroom['bedroom_description'] ?></p>
                        </div>
                        <div id="<?= $carousel ?>" class="carousel slide col-6" data-bs-ride="carousel"
                             data-bs-interval="3000">
                            <div class="carousel-inner ">
                                <?php
                                // Récupére les images via l'id BedRoom
                                $images = $this->frontManager->getImagesBedroom($bedroom['bedroom_id']);
                                // Initialisation de la key 0
                                $keys = 0;
                                // Si le
                                if (!empty($images)) {
                                    foreach ($images as $key => $bedroomImages) {
                                        // Si la key est 0 à zéro alors on mets la balise active pour démarer la première image du caroussel
                                        $active = ($key == 0) ? 'active' : '';
                                        echo '<div class="carousel-item ' . $active . '">';
                                        // Si la Key est 0 alors on met active pour le carrousel sinon
                                        echo '<img src="' . $bedroomImages["picture_url"] . '" class="d-block carousel-img" alt="">
                        </div>';
                                        $key++;
                                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carousel . '" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon svg-fill-red " style="background-color: " aria-hidden="true"></span>
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
                        ';
                                    echo '<div class="carousel-item ">
                            <img src="' . URL . 'public/assets/images/chambres/default.png" class="d-block carousel-img" alt="Bientôt disponible">
                            </div>
                        ';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="#available">
                            <button class="mt-3 btn btn-danger align-self-end">Voir les disponibilités</button>
                        </a>
                    </div>
                </main>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2">
            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <h6 class="text-center mb-4 text-danger fst-italic fw-bolder">Hôtel <br> Belle-Nuit</h6>
                <hr class="solid">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Rue du Comte Ours Blanc 1, 6940 Durbuy</p>
                </div>
                <hr class="solid">
                <div class="text-center sm">
                    <i class="fas fa-envelope mt-4 fa-2x"></i>
                       <p><a href="contact">Contactez l’hôtel</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


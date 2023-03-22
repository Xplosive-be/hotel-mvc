<h1 class='text-center my-3 text-danger fw-bolder mt-5'>Nos chambres</h1>
<?php foreach ($bedrooms as $bedroom) : ?>
    <?php $carousel = 'carousel'.$bedroom['bedroom_id']?>
    <main class="container bg-light p-5 border border-danger rounded mb-5">
        <div class="row">
            <div class="col-6">
                <h2 class="text-danger fst-italic fw-bolder "><?= $bedroom['bedroom_name'] ?></h2>
                <p class="lead"><?= $bedroom['bedroom_description'] ?></p>
            </div>
            <div id="<?= $carousel ?>" class="carousel slide col-6" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner ">
                    <?php
                    // Récupére les images via l'id BedRoom
                    $images = $this->frontManager->getImagesBedroom($bedroom['bedroom_id']);
                    // Initialisation de la key 0
                    $keys = 0;
                    // Si le
                    if(!empty($images)){
                        foreach ($images as $key => $bedroomImages) {
                            // Si la key est 0 à zéro alors on mets la balise active pour démarer la première image du caroussel
                            $active = ($key == 0) ? 'active' : '';
                            echo '<div class="carousel-item ' . $active . '">';
                            // Si la Key est 0 alors on mets active pour le carrousel sinon
                            echo '<img src="' . $bedroomImages["picture_url"] . '" class="d-block carousel-img" alt="">
                        </div>';
                            $key++;
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#'. $carousel . '" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon svg-fill-red " style="background-color: " aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#'. $carousel . '" data-bs-slide="next">
                                    <span class="carousel-control-next-icon svg-fill-red" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                  </button>';
                        }
                    } else {
                        echo '<div class="carousel-item active">
                            <img src="'.URL.'public/assets/images/chambres/default.png" class="d-block carousel-img" alt="Bientôt disponible">
                            </div>
                        ';
                        echo '<div class="carousel-item ">
                            <img src="'.URL.'public/assets/images/chambres/default.png" class="d-block carousel-img" alt="Bientôt disponible">
                            </div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="mt-3 btn btn-danger align-self-end">Voir les disponibilités</button>
        </div>
    </main>
<?php endforeach; ?>


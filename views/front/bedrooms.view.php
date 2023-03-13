<h1 class='text-center my-3 text-danger fw-bolder'>Nos chambres</h1>
<!-- Boucle pour afficher les chambres  -->
<?php foreach ($bedrooms as $bedroom) : ?>
    <main class="container bg-light p-5 border border-danger rounded mb-5">
        <div class="row">
            <div class="col-6">
                <h2 class="text-danger fst-italic fw-bolder "><?= $bedroom['bedroom_name'] ?></h2>
                <p class="lead"><?= $bedroom['bedroom_description'] ?></p>
            </div>
            <div id="carouselExampleSlidesOnly" class="carousel slide col-6" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner ">
                    <?php
                    // Récupére les images via l'id BedRoom
                    $images = $this->frontManager->getImagesBedroom($bedroom['bedroom_id']);
                    // Initialisation de la key 0
                    $keys = 0;
                    // Si le
                    if(!empty($images)){
                    foreach ($images as $key => $bedroomImages) {
                        // Si la key est 0 à zéro  alors on mets la balise active pour démarer la première image du caroussel
                        $active = ($key == 0) ? 'active' : '';
                        echo '<div class="carousel-item ' . $active . '">';
                        // Si la Key est 0 alors on mets active pour le carrousel sinon
                        echo '<img src="' . $bedroomImages["picture_url"] . '" class="d-block w-100 active " alt="">
                        </div>';
                        $key++;
                    }
                    } else {
                        echo '<div class="carousel-item active">
                            <img src="'.URL.'public/assets/images/chambres/default.png" alt="Bientôt disponible">
                            </div>
                        ';
                        echo '<div class="carousel-item ">
                            <img src="'.URL.'public/assets/images/chambres/default.png" alt="Bientôt disponible">
                            </div>
                        ';
                    }
                    ?>
                </div>
                <h4>Prix: <span class="text-danger"><?= $bedroom['bedroom_priceday'] ?> </span> € /nuit.</h4>
            </div>
        </div>
    </main>
<?php endforeach; ?>
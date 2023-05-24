<?php var_dump($_SESSION['booking']);?>
<div class="shadow-lg p-3 mb-5 bg-body rounded">
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3  d-none d-md-block">
            <span class="badge  bg-light text-dark rounded">1</span>
            <span class="badge  bg-light text-dark">Choix de votre chambre</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge bg-light text-dark rounded">2</span>
            <span class="badge bg-light text-dark">Choix des bonus</span>
        </div>
        <div class="col-md-3  d-none d-md-block">
            <span class="badge  bg-light text-dark rounded">3</span>
            <span class="badge bg-light text-dark">Vos informations</span>
        </div>
        <div class="col-md-3  d-none d-md-block ">
            <span class="badge  bg-danger text-white rounded">4</span>
            <span class="badge bg-danger text-white">Récapitulatif</span>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="shadow-lg p-3 mb-5 bg-body rounded mx-auto">
        <h2 class="text-center text-danger fw-bolder">Récapitulatif de la réservation</h2>
        <h4 class="text-center fw-bolder">Informations de réservation</h4>
        <div class="mt-3 ms-5">
            <p><strong>Date d'arrivée:</strong> <?= $_SESSION['booking']['dateBeginTxt'] ?></p>
            <p><strong>Date de départ:</strong> <?= $_SESSION['booking']['dateEndTxt'] ?></p>
            <p><strong>Durée du séjour:</strong> <?= $_SESSION['booking']['nights'] ?> nuit(s)</p>
            <p><strong>Chambre:</strong> <?= $_SESSION['booking']['bedroom_name'] ?></p>
            <p><strong>Prix:</strong> <?= $_SESSION['booking']['price'] ?> €</p>
            <p><strong>Heure d'arrivée:</strong> <?= $_SESSION['booking']['arrivalTime'] ?></p>
            <p><strong>Commentaires:</strong> <?= $_SESSION['booking']['comments'] ?></p>
            <?php if (!empty($_SESSION['booking']['services'])) : ?>
                <h5 class="card-title">Services demandés</h5>
                <ul class="list-group col-md-6">
                    <?php foreach ($_SESSION['booking']['services'] as $service) : ?>
                        <li class="list-group-item"><?= $service['name'] ?> : <span><?= $service['price'] ?></span> €</li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucun service demandé.</p>
            <?php endif; ?>
        </div>
        <h4 class="text-center fw-bolder mt-3">Informations du client</h4>
        <div class="mt-3 ms-5">
            <p><strong>Civilité:</strong><td><?= ($_SESSION['booking']['customers']['gender'] == 'H') ? 'Monsieur' : (($_SESSION['booking']['customers']['gender'] == 'F') ? 'Madame' : 'Non-binaire') ?></td></p>
            <p><strong>Nom:</strong> <?= $_SESSION['booking']['customers']['name'] ?></p>
            <p><strong>Prénom:</strong> <?= $_SESSION['booking']['customers']['surname'] ?></p>
            <p><strong>Email:</strong> <?= $_SESSION['booking']['customers']['email'] ?></p>
            <p><strong>Adresse:</strong> <?= $_SESSION['booking']['customers']['address'] ?></p>
            <p><strong>Boîte:</strong> <?= $_SESSION['booking']['customers']['box'] ?></p>
            <p><strong>Pays:</strong> <?= $country ?></p></p>
            <p><strong>Ville:</strong> <?= $_SESSION['booking']['customers']['city'] ?></p>
            <p><strong>Code postal:</strong> <?= $_SESSION['booking']['customers']['postalCode'] ?></p>
            <p><strong>Téléphone:</strong> <?= $_SESSION['booking']['customers']['phone'] ?></p>
        </div>
        <h3 class="text-center tfw-bolder">Prix de la réservation</h3>
        <p class="text-center fw-bolder fs-1"><?= $_SESSION['booking']['priceTotal'] ?>€</p>
        <form class="row mx-auto mb-2" method="post" action="bookingValidate">
            <div class="col-md-6">
                <div class="text-center">
                    <button type="submit" name="cancelBooking" onclick="return confirm('Êtes-vous sûr de vouloir annuler votre réservation')" class="ms-3 btn btn-danger">Annuler la réservation</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <button type="submit" name="validateBooking" onclick="return confirm('Êtes-vous sûr de vouloir valider votre réservation')" class="ms-3 btn btn-success">Valider la réservation</button>
                </div>
            </div>
        </form>
    </div>
</div>

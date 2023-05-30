<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
    <div class="w-75 mx-auto">
        <h2 class="mt-3">Descriptif de la réservation</h2>
        <div class="row mt-4">
            <h5 class="mb-3">Détails de la réservation</h5>
            <div class="col-md-6">
                <div class="card-text-column">
                    <p>ID de réservation : <strong><?php echo $reservation['booking_id']; ?></strong></p>
                    <p>Date de début : <strong><?php echo $reservation['booking_date_begin']; ?></strong></p>
                    <p>Heure d'arrivée : <strong><?php echo $reservation['booking_arrival_time']; ?></strong></p>
                    <?php if (is_null($reservation['services'])) : ?>
                        <div class="card-text-column">
                            <p>Services :</p>
                            <ul>
                                <?php foreach ($reservation['services'] as $service) : ?>
                                    <li><strong><?php echo $service['service_name']; ?></strong></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div class="card-text-column">
                            <h5>Services</h5>
                            <p>Il n'y a pas de services demandés.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <p>Chambre : <strong><?php echo $reservation['bedroom_name']; ?></strong></p>
                <p>Date de fin : <strong><?php echo $reservation['booking_date_end']; ?></strong></p>
                <p>Prix total : <strong><?php echo $reservation['booking_price_total']; ?> €</strong></p>
            </div>
            <div class="col-md-12">
                <h5>Commentaires</h5>
                <p><?php echo $reservation['booking_comments']; ?></p>
            </div>
        </div>
        <hr class="mb-5 mt-3">
        <div class="row mt-3">
            <div class="col-md-6">
                <h5>Informations client</h5>
                <div class="card-text-column">
                    <p>Nom du client : <strong><?php echo $reservation['cus_name'] . ' ' . $reservation['cus_surname']; ?></strong></p>
                    <p>Adresse : <strong><?php echo $reservation['cus_address']; ?></strong></p>
                    <p>Ville : <strong><?php echo $reservation['cus_city']; ?></strong></p>
                    <p>Code postal : <strong><?php echo $reservation['cus_codepostal']; ?></strong></p>
                    <p>Téléphone : <strong><?php echo $reservation['cus_phone']; ?></strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Informations de contact</h5>
                <div class="card-text-column">
                    <p>Pays : <strong><?php echo $pays; ?></strong></p>
                    <p>Email : <strong><?php echo $reservation['cus_email']; ?></strong></p>
                </div>
            </div>
        </div>
            <hr>
        <div class="row mt-3 mb-3">
            <div class="col-md-6">
                <h5>Annulation</h5>
                <p class="fs-2"><?php echo $cancelationBadge; ?></p>
            </div>
            <div class="col-md-6">
                <h5>Validation</h5>
                <p class="fs-2"><?php echo $validationBadge ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <h5 class="mb-3">Actions</h5>
            <div class="col-md-6">
                <a href="adminReservation" class="btn btn-outline-dark">Retour Réservation</a>
            </div>
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" name="bookingId" value="<?php echo $reservation['booking_id']; ?>">
                    <?php if ($reservation['booking_validation'] == 0) : ?>
                        <button type="submit" class="btn btn-success" name="validateValidation"
                                onclick="return confirm('Êtes-vous sûr de vouloir confirmer votre réservation')">Valider</button>
                    <?php endif; ?>
                    <?php if ($reservation['booking_cancelation'] == 0) : ?>
                    <button type="submit" class="btn btn-danger" name="cancelReservation"
                            onclick="return confirm('Êtes-vous sûr de vouloir annuler votre réservation')">Annuler</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>

    </div>

</div>

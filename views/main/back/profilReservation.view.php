<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
    <h1 class="text-center my-3 text-danger fw-bolder mb-5">Gestion de vos réservations</h1>
    <!-- Partie "Vos réservations prochaines" -->
    <div class="mb-5">
        <h3 class="mb-3">Vos prochaines réservation</h3>
        <div class="accordion" id="upcomingReservationsAccordion">
            <?php foreach ($upcomingReservations as $reservation) {
                // Permets de calculer le nombre de jours entre le début et la fin
                $dateBegin = date_create($reservation['booking_date_begin']);
                $dateEnd = date_create($reservation['booking_date_end']);
                $diff = date_diff($dateBegin, $dateEnd);
                $numberOfNights = $diff->format('%a'); // %a représente le nombre de jours
                ?>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="reservationHeading<?= $reservation['booking_id'] ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $reservation['booking_id'] ?>" aria-expanded="true" aria-controls="collapse<?= $reservation['booking_id'] ?>" data-bs-parent="#upcomingReservationsAccordion">
                            <?= $reservation['bedroom_name'] ?> -  <?= date_format(date_create($reservation['booking_date_begin']), 'd-m-Y')?> au <?= date_format(date_create($reservation['booking_date_end']), 'd-m-Y')?>
                        </button>
                    </h3>
                    <div id="collapse<?= $reservation['booking_id'] ?>" class="accordion-collapse collapse" aria-labelledby="reservationHeading<?= $reservation['booking_id'] ?>">
                        <div class="accordion-body">
                            <div class="mt-3">
                                <p>Voici les informations de votre réservation :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Numéro de réservation :</strong> <?= $reservation['booking_id'] ?></p>
                                        <p><strong>Date d'arrivée :</strong> <?= date_format(date_create($reservation['booking_date_begin']), 'd-m-Y') ?> à partir de <?= date_format(date_create($reservation['booking_arrival_time']), 'H:i') ?></p>
                                        <p><strong>Durée du séjour :</strong> <?= $numberOfNights ?> nuit(s)</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Chambre :</strong> <?= $reservation['bedroom_name'] ?></p>
                                        <p><strong>Date de départ :</strong> <?= date_format(date_create($reservation['booking_date_end']), 'd-m-Y') ?></p>
                                        <p><strong>Prix :</strong> <?= $reservation['booking_price_total'] ?> €</p>
                                    </div>
                                </div>
                                    <?php if ($reservation['booking_validation'] == 1): ?>
                                        <p><strong>Réservation: <span class="text-success">Confirmée</span></strong></p>
                                    <?php else: ?>
                                        <p><strong>Réservation: <span class="text-danger">Non-Confirmée</span></strong></p>
                                    <?php endif; ?>
                                    <p>Votre réservation doit être validée par notre équipe avant de recevoir les modalités de paiement. Si vous souhaitez annuler votre réservation, veuillez nous contacter par e-mail ou par téléphone en précisant votre numéro de réservation. Merci. </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Partie "Vos réservations passées" -->
    <div>
        <h3 class="mb-3">Vos réservations passées</h3>

        <div class="accordion mb-5" id="pastReservationsAccordion">
            <?php foreach ($pastReservations as $reservation) { ?>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="reservationHeading<?= $reservation['booking_id'] ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $reservation['booking_id'] ?>" aria-expanded="true" aria-controls="collapse<?= $reservation['booking_id'] ?>" data-bs-parent="#pastReservationsAccordion">
                            <?= $reservation['bedroom_name'] ?>
                        </button>
                    </h3>
                    <div id="collapse<?= $reservation['booking_id'] ?>" class="accordion-collapse collapse" aria-labelledby="reservationHeading<?= $reservation['booking_id'] ?>">
                        <div class="accordion-body">
                            <div class="mt-3">
                                <p>Voici les informations de vos anciennes réservation :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Numéro de réservation :</strong> <?= $reservation['booking_id'] ?></p>
                                        <p><strong>Date d'arrivée :</strong> <?= date_format(date_create($reservation['booking_date_begin']), 'd-m-Y') ?> à partir de <?= date_format(date_create($reservation['booking_arrival_time']), 'H:i') ?></p>
                                        <p><strong>Durée du séjour :</strong> <?= $numberOfNights ?> nuit(s)</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Chambre :</strong> <?= $reservation['bedroom_name'] ?></p>
                                        <p><strong>Date de départ :</strong> <?= date_format(date_create($reservation['booking_date_end']), 'd-m-Y') ?></p>
                                        <p><strong>Prix :</strong> <?= $reservation['booking_price_total'] ?> €</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Vos réservations prochaines</h2>
            <div id="accordion-prochaines">
                <?php foreach ($upcomingReservations as $reservation) { ?>
                    <div class="card">
                        <div class="card-header" id="heading-<?php echo $reservation['booking_id']; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $reservation['booking_id']; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $reservation['booking_id']; ?>">
                                    <?php echo $reservation['bedroom_name']; ?> - <?php echo $reservation['booking_date_begin']; ?> à <?php echo $reservation['booking_date_end']; ?>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse-<?php echo $reservation['booking_id']; ?>" class="collapse" aria-labelledby="heading-<?php echo $reservation['booking_id']; ?>" data-bs-parent="#accordion-prochaines">
                            <div class="card-body">
                                <!-- Contenu de la réservation prochaine -->
                                <!-- Vous pouvez afficher les détails de la réservation ici -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Vos réservations passées</h2>
            <div id="accordion-passees">
                <?php foreach ($pastReservations as $reservation) { ?>
                    <div class="card">
                        <div class="card-header" id="heading-<?php echo $reservation['booking_id']; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $reservation['booking_id']; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $reservation['booking_id']; ?>">
                                    <?php echo $reservation['bedroom_name']; ?> - <?php echo $reservation['booking_date_begin']; ?> à <?php echo $reservation['booking_date_end']; ?>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse-<?php echo $reservation['booking_id']; ?>" class="collapse" aria-labelledby="heading-<?php echo $reservation['booking_id']; ?>" data-bs-parent="#accordion-passees">
                            <div class="card-body">
                                <!-- Contenu de la réservation passée -->
                                <!-- Vous pouvez afficher les détails de la réservation ici -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

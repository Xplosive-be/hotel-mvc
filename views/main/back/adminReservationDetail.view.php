<?php
    var_dump($reservation)
    ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">Détails de la réservation</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="card-text-column">
                    <p class="card-text">ID de réservation : <strong><?php echo $reservation['booking_id']; ?></strong></p>
                    <p class="card-text">Chambre : <strong><?php echo $reservation['bedroom_name']; ?></strong></p>
                    <p class="card-text">Date de début : <strong><?php echo $reservation['booking_date_begin']; ?></strong></p>
                    <p class="card-text">Heure d'arrivée : <strong><?php echo $reservation['booking_arrival_time']; ?></strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-text-column">
                    <p class="card-text">Date de fin : <strong><?php echo $reservation['booking_date_end']; ?></strong></p>
                    <p class="card-text">Prix total : <strong><?php echo $reservation['booking_price_total']; ?></strong></p>

                    <?php if (!empty($reservation['services']) && !is_null($reservation['services'])) : ?>
                        <div class="card-text-column">
                            <p class="card-text">Services :</p>
                            <ul>
                                <?php foreach ($reservation['services'] as $service) : ?>
                                    <li><strong><?php echo $service['service_name']; ?></strong></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div class="card-text-column">
                            <p class="card-text">Il n'y a pas de services demandés.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-12"><p class="card-text">Commentaires : <br>
                    <?php echo $reservation['booking_comments']; ?></p></div>
        </div>
    </div>

</div>

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title mb-3">Informations client</h5>
        <div class="row">
            <div class="col-md-6">
                <p class="card-text">Nom du client : <strong><?php echo $reservation['cus_name'] . ' ' . $reservation['cus_surname']; ?></strong></p>
                <p class="card-text">Adresse : <strong><?php echo $reservation['cus_address']; ?></strong></p>
                <p class="card-text">Ville : <strong><?php echo $reservation['cus_city']; ?></strong></p>
                <p class="card-text">Code postal : <strong><?php echo $reservation['cus_codepostal']; ?></strong></p>
            </div>
            <div class="col-md-6">
                <p class="card-text">Pays : <strong><?php echo $pays; ?></strong></p>
                <p class="card-text">Téléphone : <strong><?php echo $reservation['cus_phone']; ?></strong></p>
                <p class="card-text">Email : <strong><?php echo $reservation['cus_email']; ?></strong></p>
                <p class="card-text">Annulation : <strong><?php echo $cancelationBadge; ?></strong></p>
                <p class="card-text">Validation : <strong><?php echo $validationBadge ?></strong></p>
            </div>
        </div

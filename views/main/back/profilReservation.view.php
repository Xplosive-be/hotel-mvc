<div class="shadow-lg p-3 mb-5 bg-body rounded mx-auto">
    <h2>Vos réservations en cours! </h2>
    <?php
    var_dump($reservationById);
    foreach ($reservationById as $reservation) {
        $idChambre = $reservation['id_bedroom'];
        $dateDebut = $reservation['booking_date_begin'];
        $dateFin = $reservation['booking_date_end'];
        $prixTotal = $reservation['booking_price_total'];

        echo "ID de la chambre : " . $idChambre . "<br>";
        echo "Date de début : " . $dateDebut . "<br>";
        echo "Date de fin : " . $dateFin . "<br>";
        echo "Prix total : " . $prixTotal . "<br><br>";
    }
    ?>


</div>
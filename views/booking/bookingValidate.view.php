<div class="container-fluid">
    <div class="shadow-lg p-3 mb-5 bg-body rounded mx-auto">
        <h2 class="text-center text-danger fw-bolder">Confirmation de réservation</h2>
        <div class="mt-3">
            <?= var_dump($_SESSION) ?>
            <p>Nous vous remercions d'avoir choisi notre établissement pour votre prochain séjour. Votre réservation a été enregistrée avec succès et nous vous attendons avec impatience.</p>
            <p>Voici les informations de votre réservation :</p>
            <ul>
                <li><strong>Numéro de réservation :</strong> 514981</li>
                <li><strong>Date d'arrivée :</strong> <?= $_SESSION['booking']['dateBeginTxt'] ?></li>
                <li><strong>Date de départ :</strong> <?= $_SESSION['booking']['dateEndTxt'] ?></li>
                <li><strong>Durée du séjour :</strong> <?= $_SESSION['booking']['nights'] ?> nuit(s)</li>
                <li><strong>Chambre :</strong> <?= $_SESSION['booking']['bedroom_name'] ?></li>
                <li><strong>Prix :</strong> <?= $_SESSION['booking']['price'] ?> €</li>
                <?php if (!empty($_SESSION['booking']['services'])) : ?>
                    <li><strong>Services demandés :</strong></li>
                    <ul>

                        <?php foreach ($_SESSION['booking']['services'] as $service) : ?>
                            <li><?= $service['name'] ?> : <?= $service['price'] ?> €</li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </ul>
            <p>Nous tenons à vous informer que si vous n'avez pas fourni de détails de paiement lors de la réservation, le paiement sera effectué sur place lors de votre arrivée. Si vous n'êtes pas en mesure de vous présenter, veuillez nous contacter au plus vite pour annuler ou reporter votre réservation.</p>
            <p>Notre équipe reste disponible pour toute information ou assistance supplémentaire. Nous espérons que votre séjour parmi nous sera des plus agréables.</p>
            <p>Veuillez noter que toute annulation doit être effectuée au moins 48 heures avant la date d'arrivée prévue. Passé ce délai, des frais d'annulation pourront être appliqués. Merci de consulter nos conditions de réservation pour plus d'informations.</p>
        </div>
    </div>
</div>







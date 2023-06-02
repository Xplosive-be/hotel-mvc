<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
    <div class="ms-3 me-3">
        <h1 class="text-center my-3 text-danger fw-bolder mb-5">Gestionnaire des Réservations</h1>
        <form action="adminReservation" method="POST" class="mb-3">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label for="dateBegin" class="form-label">Date de début :</label>
                    <input type="date" class="form-control" id="dateBegin" name="dateBegin"
                           value="<?= isset($_POST['dateBegin']) ? $_POST['dateBegin'] : '' ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="dateEnd" class="form-label">Date de départ
                        :</label>
                    <input type="date" class="form-control" id="dateEnd" name="dateEnd"
                           value="<?= isset($_POST['dateEnd']) ?
                               $_POST['dateEnd'] : '' ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="booking_id" class="form-label">Numéro de réservation :</label>
                    <input type="text" class="form-control" id="booking_id" name="booking_id"
                           value="<?= isset($_POST['booking_id']) ? $_POST['booking_id'] : '' ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="search_name" class="form-label">Nom ou Prénom :</label>
                    <input type="text" class="form-control" id="search_name" name="search_name"
                           value="<?= isset($_POST['search_name']) ? $_POST['search_name'] : '' ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show_cancelled" name="show_cancelled" <?= isset($_POST['show_cancelled']) && $_POST['show_cancelled'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="show_cancelled">Afficher les annulations</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show_validated" name="show_validated" <?= isset($_POST['show_validated']) && $_POST['show_validated'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="show_validated">Afficher les réservations validées</label>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-5">
                <button type="submit" name="btnSearch" class="btn
            btn-danger">Rechercher</button>
            </div>

        </form>

        <table class="table container bg-light p-5 rounded mb-5 border border-2 border-dark">
            <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>Nom du client</th>
                <th>Chambre</th>
                <th>Date début</th>
                <th>Date de fin</th>
                <th>Prix Total</th>
                <th>Confirmation</th>
                <th>Annulée</th>
                <th>Détails</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $key => $reservation) :
                $validationBadge = ($reservation['booking_validation'] == 1) ? '<i class="fa-solid fa-check text-center" style="color: #2da800;"></i>' : '<i class="fa-solid fa-xmark" style="color: #db0000;"></i>';
                $cancelationBadge = ($reservation['booking_cancelation'] == 1) ? '<i class="fa-solid fa-check text-center" style="color: #2da800;"></i>' : '<i class="fa-solid fa-xmark" style="color: #db0000;"></i>';
                ?>

                <tr class="text-center">
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["booking_id"] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["cus_name"] . " " .$reservation["cus_surname"]  ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["bedroom_name"] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["booking_date_begin"] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["booking_date_end"] ?></p>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?= $reservation["booking_price_total"] . ' €' ?></p>
                    </td>
                    <td>
                        <?= $validationBadge ?>
                    </td>
                    <td>
                        <?= $cancelationBadge ?>
                    </td>
                    <td>
                        <a href="adminReservationDetail&id=<?= $reservation["booking_id"] ?>"><i class="fa-solid fa-book"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <a href="admin" class="btn btn-danger">Retour Menu</a>
    </div>
</div>

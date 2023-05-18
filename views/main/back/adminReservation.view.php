<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
    <?php
    if(isset($reservation))
    {
        echo var_dump($reservation);
    }
    ?>
    <h1 class="text-center my-3 text-danger fw-bolder mb-5">Gestionnaire des Réservations</h1>
    <form action="" method="POST" class="mb-3" onsubmit="return compareDates()">
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="dateBegin" class="form-label">Date de début :</label>
                <input type="date" class="form-control" id="dateBegin" name="dateBegin"
                       value="<?= isset($_POST['dateBegin']) ? $_POST['dateBegin'] : '' ?>">
            </div>
            <div class="col-md-4 mb-2">
                <label for="dateEnd" class="form-label">Date de départ
                    :</label>
                <input type="date" class="form-control" id="dateEnd" name="dateEnd"
                       value="<?= isset($_POST['dateEnd']) ?
                           $_POST['dateEnd'] : '' ?>">
            </div>
            <div class="col-md-4 mb-2">
                <label for="search_name" class="form-label">Recherche par nom :</label>
                <input type="text" class="form-control" id="search_name" name="search_name"
                       value="<?= isset($_POST['search_name']) ? $_POST['search_name'] : '' ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="show_cancelled" name="show_cancelled">
                    <label class="form-check-label" for="show_cancelled">Afficher les annulations</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="show_validated" name="show_validated">
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
        <tr>
            <th>ID</th>
            <th>Nom du client</th>
            <th>Chambre</th>
            <th>Date d'arrivée</th>
            <th>Date de départ</th>
            <th>Prix Total</th>
            <th>Confirmation</th>
            <th>Payé</th>
            <th>Détails</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

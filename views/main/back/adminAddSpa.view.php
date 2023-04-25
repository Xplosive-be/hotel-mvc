<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="text-start ">
            <main class="w-75 mx-auto pb-5" style="max-width: 80%;">
                <form method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Admin - Rajout d'un Spa</h1>
                    <div class="row g-3">
                        <!-- Nom -->
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nom du soin</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- Durée -->
                        <div class="col-sm-6">
                            <label for="time" class="form-label">Durée (en minutes)</label>
                            <input type="number" class="form-control" id="time" name="time" required>
                        </div>
                        <!-- Prix -->
                        <div class="col-sm-6">
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" class="form-control" name="price" id="price" step="0.01" min="1.00"/>
                        </div>
                        <!-- Catégorie -->
                        <div class="col-sm-6">
                            <label for="category" class="form-label">Catégorie</label>
                            <select class="form-select" id="category" name="category" required>
                                <?php
                                foreach ($spaCategories as $spaCategory) {
                                    echo '<option value="' . $spaCategory['spacategory_id'] . '">' . $spaCategory['spacategory_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="active" class="form-label">Disponible</label>
                            <input class="form-check-input " type="checkbox" value="1" id="active" name="active">
                        </div>
                    </div>
                    <!-- Bouton de Modification-->
                    <div class="text-center">
                        <button class="mt-3 btn btn-danger mx-auto mb-4 fw-bolder text-center" style="max-width: 80%" type="submit" name="btnAddSpa">Créer</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

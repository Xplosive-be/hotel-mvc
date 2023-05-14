<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="text-start ">
            <main class="w-75 mx-auto pb-5" style="max-width: 80%;">
                <form method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Admin - Rajout d'un Spa</h1>
                        <!-- Nom -->
                            <label for="name" class="form-label">Nom du plat</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        <!-- Prix -->
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" class="form-control" name="price" id="price" step="0.01" min="1.00"/>
                        <!-- Catégorie -->
                            <label for="category" class="form-label">Catégorie</label>
                            <select class="form-select" id="category" name="category" required>
                                <?php
                                foreach ($restoCategories as $restoCategory) {
                                    echo '<option value="' . $restoCategory['restocategory_id'] . '">' . $restoCategory['restocategory_name'] . '</option>';
                                }
                                ?>
                            </select>
                    <div class="mt-3">
                        <label for="active" class="form-label">Disponible</label>
                        <input class="form-check-input " type="checkbox" value="1" id="active" name="active">
                    </div>

                    <!-- Bouton de Modification-->
                    <div class="text-center">
                        <button class="mt-3 btn btn-danger mx-auto mb-4 fw-bolder text-center" style="max-width: 80%" type="submit" name="btnAddProduct">Créer</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

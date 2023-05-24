<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
        <div class="text-start ">
            <main class="w-75 mx-auto mt-4 pb-5" style="max-width: 80%;">
                <form method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Admin - Modification - <?= $resto['product_title'] ?></h1>
                    <div class="row g-3">
                        <!-- Nom -->
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nom du soin</label>
                            <input type="text" class="form-control" id="name" value="<?= $resto['product_title'] ?>" name="name" required>
                        </div>
                        <!-- Prix -->
                        <div class="col-sm-6">
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $resto['product_price']?>" step="0.01" min="1.00"/>
                        </div>
                        <!-- Catégorie -->
                        <div class="col-sm-6">
                            <label for="category" class="form-label">Catégorie</label>
                            <select class="form-select" id="category" name="category" required>
                                <?php
                                foreach ($restoCategories as $restoCategory) {
                                    echo '<option value="' . $restoCategory['restocategory_id'] . '"' . (($resto['id_restocategory'] == $restoCategory['restocategory_id']) ? 'selected'  : '') . '>' . $restoCategory['restocategory_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                                <label for="active" class="form-label">Disponible</label>
                                <input class="form-check-input " type="checkbox" value="1" id="active" name="active" <?php echo ($resto['product_active'] == 1) ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <!-- Bouton de Modification-->
                    <div class="text-center">
                        <button class="mt-3 btn btn-danger mx-auto mb-4 fw-bolder text-center" style="max-width: 80%" type="submit" name="btnEditProduct">Modifier</button>
                        <a class="mt-3 ms-3 btn btn-outline-danger mx-auto mb-4 fw-bolder text-center" style="max-width: 80%" href="adminRestaurant">Retour </a>
                    </div>
                </form>
            </main>
        </div>
    </div>

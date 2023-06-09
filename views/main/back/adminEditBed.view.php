<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="text-start body-signin">
            <main class="w-75 mx-auto pb-5 form-signin" style="max-width: 80%;">
                <form method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Admin - Modification du chambre</h1>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nom de la chambre</label>
                            <input type="text" class="form-control" id="name" value="<?php echo $bedroomById['bedroom_name'] ?>" name="name" required>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description (code en html)</label>
                            <textarea class="form-control" id="description" rows="12" name="description"><?php echo $bedroomById['bedroom_description'] ?></textarea>
                        </div>
                        <div class="col-sm mb-1">
                            <label for="typeBed" class="form-label">Type de lit : </label></br>
                            <select name="typeBed"class="form-select">
                                <option value="double"<?php echo ($bedroomById['bedroom_bed'] == 'double') ? ' selected' : ''; ?>>Double</option>
                                <option value="twin"<?php echo ($bedroomById['bedroom_bed'] == 'twin') ? ' selected' : ''; ?>>Jumelle</option>
                                <option value="single"<?php echo ($bedroomById['bedroom_bed'] == 'single') ? ' selected' : ''; ?>>Simple</option>
                            </select>
                        </div>
                        <div class="col-sm mb-1">
                            <label for="category" class="form-label">Catégorie</label>
                            <select class="form-select" id="category" name="category" required>
                                <?php
                                foreach ($CategoryBedList as $category) {
                                    $selected = ($bedroomById['id_roomcategory'] == $category['roomcategory_id']) ? 'selected' : '';
                                    echo '<option value="' . $category['roomcategory_id'] . '" ' . $selected . '>' . $category['roomcategory_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm mb-1">
                            <label for="price" class="form-label">Prix en €</label>
                            <input type="text" name="price" class="form-control" id="price" value="<?php echo $bedroomById['bedroom_priceday'] ?>" name="price" required>
                        </div>
                    </div>
                    <!-- Bouton de Modification-->
                    <div class="text-center">
                        <button class="mt-3 btn btn-danger mx-auto mb-4 fw-bolder text-center" style="width: 100%" type="submit" name="btnEditBed">Modifier</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="text-start body-signin ">
            <main class="form-signin" style="max-width: 80%;">
                <form method="post">
                    <h1 class="h3 mb-5 fw-normal text-center text-danger fw-bolder">Admin - Ajouter une chambre</h1>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nom de la chambre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description (code en html)</label>
                            <textarea class="form-control" id="description" rows="12" name="description">
                            </textarea>
                        </div>
                        <div class="col-sm-3 mb-1">
                            <label for="typeBed">Type de lit : </label></br>
                            <select name="typeBed">
                                <option value="double">Double</option>
                                <option value="twin"> Jumelle</option>
                                <option value="single">Simple</option>
                            </select>
                        </div>
                        <div class="col-sm mb-1">
                            <label for="category" class="form-label">Catégorie</label>
                            <select class="form-select" id="category" name="category" required>
                                <?php
                                // Récuperer les différents catégorie de la bedlist
                                foreach ($categoryBed as $category) {
                                    echo '<option value="' . $category['roomcategory_id'] . '"' . (($category['roomcategory_name'] == $bedroom['roomcategory_name']) ? 'selected'  : '') . '>' . $category['roomcategory_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm mb-1">
                            <label for="price" class="form-label">Prix en €</label>
                            <input type="text" name="price" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <!-- Bouton de Modification-->
        </div class="text-center"><button class=" mt-3 btn btn-danger mx-auto mb-4 fw-bolder text-center" type=submit" name="btnAddBed">Rajouter</button>
        </form>
        </main>
    </div>
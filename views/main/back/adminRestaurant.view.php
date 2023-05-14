<h1 class='text-center my-3 text-danger fw-bolder mb-5'>Gestionnaire du restaurant</h1>
<a href="adminAddResto"><button class="btn btn-danger btn-lg position-fixed top-1 end-0 me-2">+</button></a>
<table class="table container bg-light p-5 rounded mb-5 border border-2 border-dark">
    <thead class="bg-light">
    <tr>
        <th>Titre</th>
        <th>Catégorie</th>
        <th>Prix</th>
        <th>Actif</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    <!-- Affichage dans le tableau de tout les utilisateurs -->
    <?php foreach ($restaurants as $product) :
        $statusBadge = ($product['product_active'] == 1) ? '<span class="badge bg-success rounded-pill d-inline">Active</span>' : '<span class="badge bg-danger rounded-pill d-inline">Inactive</span>';
        ?>
        <tr>
            <td>
                <p class="fw-bold mb-1"><?= $product["product_title"] ?></p>
            </td>
            <td>
                <p class="fw-bold mb-1"><?= $product["restocategory_name"] ?></p>
            </td>
            <td>
                <p class="fst-italic mb-1 text-start"><?= $product["product_price"] ?> €</p>
            </td>
            <td><?= $statusBadge ?></td>
            <td>
                <a href="adminEditResto&id=<?= $product['product_id'] ?>" class="text-warning">
                    <i class="fa-solid fa-wrench fa-xl"></i>
                </a>
                <a href="adminDelResto&id=<?= $product['product_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="ms-3 text-danger">
                    <i class="fa-solid fa-xl fa-trash-can"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
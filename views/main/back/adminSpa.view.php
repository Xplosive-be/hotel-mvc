<h1 class='text-center my-3 text-danger fw-bolder mb-5'>Gestionnaire des Spa</h1>
<a href="adminAddSpa"><button class="btn btn-danger btn-lg position-fixed top-1 end-0 me-2">+</button></a>
<table class="table container bg-light p-5 rounded mb-5 border border-2 border-dark">
    <thead class="bg-light">
    <tr>
        <th>Titre</th>
        <th>Durée</th>
        <th>Catégorie</th>
        <th>Prix</th>
        <th>Actif</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    <!-- Affichage dans le tableau de tout les utilisateurs -->
    <?php foreach ($spas as $spa) :
        $statusBadge = ($spa['spa_active'] == 1) ? '<span class="badge bg-success rounded-pill d-inline">Active</span>' : '<span class="badge bg-danger rounded-pill d-inline">Inactive</span>';
        ?>
        <tr>
            <td>
                <p class="fw-bold mb-1"><?= $spa["spa_title"] ?></p>
            </td>
            <td>
                <p class="fw-bold mb-1"><?= $spa["spa_time"] ?></p>
            </td>
            <td>
                <p class="fw-bold mb-1"><?= $spa["spacategory_name"] ?></p>
            </td>
            <td>
                <p class="fst-italic mb-1  text-start"><?= $spa["spa_price"] ?> €</p>
            </td>
            <td><?= $statusBadge ?></td>
            <td>
                <a href="adminEditSpa&id=<?= $spa['spa_id'] ?>" class="text-warning">
                    <i class="fa-solid fa-wrench fa-xl"></i>
                </a>
                <a href="adminDelSpa&id=<?= $spa['spa_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="ms-3 text-danger">
                    <i class="fa-solid fa-xl fa-trash-can"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<div class="container-fluid shadow-lg p-3 mb-5 mt-5 bg-body rounded mx-auto">
<h1 class='text-center my-3 text-danger fw-bolder mb-5'>Gestionnaire d'Utilisateur</h1>
<table class="table container bg-light p-5 rounded mb-5 border border-2 border-dark">
    <thead class="bg-light">
    <tr>
        <th>ID</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Status</th>
        <th>Admin</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <!-- Affichage dans le tableau de tout les utilisateurs -->
    <?php foreach ($profils as $key => $profil) :
        $statusBadge = ($profil['acc_active'] == 1) ? '<span class="badge bg-success rounded-pill d-inline">Active</span>' : '<span class="badge bg-danger rounded-pill d-inline">Inactive</span>';
        $adminBadge = ($profil['acc_admin'] == 1) ? '<span class="badge bg-success rounded-pill d-inline">Active</span>' : '<span class="badge bg-danger rounded-pill d-inline">Inactive</span>';
        ?>
        <tr>
            <td>
                <p class="fw-bold mb-1"><?= $profil["acc_id"] ?></p>
            </td>
            <td>
                <p class="fw-bold mb-1"><?= $profil["acc_surname"] ?></p>
            </td>
            <td>
                <p class="fw-bold mb-1"><?= $profil["acc_name"] ?></p>
            </td>
            <td>
                <p class="fst-italic mb-1"><?= $profil["acc_email"] ?></p>
            </td>
            <td><?= $statusBadge ?></td>
            <td><?= $adminBadge ?></td>
            <td>
                <a href="adEditAccount&id=<?= $profil['acc_id'] ?>" class="text-warning">
                    <i class="fa-solid fa-wrench fa-xl"></i>
                </a>
                <a href="models/delete.php?idDelUser=<?= $profil["acc_id"] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="ms-3 text-danger">
                    <i class="fa-solid fa-xl fa-trash-can"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>
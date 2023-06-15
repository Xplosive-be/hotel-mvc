<div class="container">
    <div class="py-5 text-center">
        <h2 class="text-danger fw-bold">Changement de mot de passe</h2>
    </div>
    <div class="d-flex justify-content-center">
        <form action="profilPassword" method="POST" class="w-75 mx-auto pb-5">
            <div class="form-group row g-3">
                <div class="col-12">
                    <label for="currentPassword" class="form-label">Mot de passe actuel :</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" required>
                </div>
            </div>
            <div class="form-group row g-3">
                <div class="col-12">
                    <label for="newPassword" class="form-label">Nouveau mot de passe :</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}$" required>
                    <small class="text-muted">Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.</small>
                </div>
            </div>
            <div class="form-group row g-3">
                <div class="col-12">
                    <label for="confirmPassword" class="form-label">Confirmez le nouveau mot de passe :</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#])[a-zA-Z\d@$!%*?&#]{8,}$" required>
                    <small class="text-muted">Répétez le mot de passe exactement comme vous l'avez saisi ci-dessus.</small>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a class="mt-3 btn btn-secondary mx-2 fw-bolder text-center" href="profil">Retour au profil</a>
                <button class="mt-3 btn btn-danger mx-2 fw-bolder text-center" type="submit" name="btnEditPassword">Valider</button>
            </div>
        </form>
    </div>
</div>

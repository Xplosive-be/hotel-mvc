document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById("btnChangePassword").addEventListener("click", function() {
        const passwordFields = document.getElementById("passwordFields");
        if (passwordFields.style.display === "none") {
            passwordFields.style.display = "block";
        } else {
            passwordFields.style.display = "none";
        }
    });

    function validatePassword() {
        const newPassword = document.getElementById("newPassword").value;
        const confirmNewPassword = document.getElementById("confirmNewPassword").value;

        // Vérifiez si les champs de mot de passe sont vides
        if (newPassword === "" && confirmNewPassword === "") {
            return true;
        }

        // Expression régulière pour la validation du mot de passe
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

        // Vérifiez si le nouveau mot de passe correspond au motif de l'expression régulière
        if (!passwordRegex.test(newPassword)) {
            alert("Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.");
            return false;
        }

        // Vérifiez si les champs de nouveau mot de passe correspondent
        if (newPassword !== confirmNewPassword) {
            alert("Les mots de passe ne correspondent pas.");
            return false;
        }

        return true;
    }

    const form = document.querySelector("form[name='formProfil']");
    form.addEventListener("submit", function(event) {
        if (!validatePassword()) {
            event.preventDefault();
        }
    });
});

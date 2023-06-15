    console.log('Chargée');
// Fonction de validation du mot de passe
    function validatePassword() {
    const password = document.getElementById("password").value;
    const passwordConfirmation = document.getElementById("passwordConfirmation").value;

    // Expression régulière pour la vérification du mot de passe
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;


    if (!passwordRegex.test(password)) {
    alert("Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.");
    return false;
}

    if (password !== passwordConfirmation) {
    alert("Les mots de passe ne correspondent pas.");
    return false;
}

    return true;
}

    // Validation du formulaire lors de la soumission
    const form = document.forms["formulaire"];
    form.addEventListener("submit", function(event) {
    if (!validatePassword()) {
    event.preventDefault();
}
});

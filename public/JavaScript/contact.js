function validateForm() {
    var x =  document.getElementById('name').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'> Merci de remplir votre nom</p>";
        return false;
    }
    x =  document.getElementById('email').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'> Merci de remplir votre email.</p>";
        return false;
    } else {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(x)){
            document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'> Votre email est incorrect!</p>";
            return false;
        }
    }
    x =  document.getElementById('subject').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'> Le sujet ne doit pas être vide !</p>";
        return false;
    }
    x =  document.getElementById('message').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'>Votre message ne doit pas être vide!</p>";
        return false;
    }
    x =  document.getElementById('captcha').value;
    if (x != "vert") {
        document.getElementById('status').innerHTML = "<p class='text-danger fw-bolder'>Erreur sur le Captcha</p>";
        return false;
    }


    document.getElementById('status').innerHTML = "<p class='text-success fw-bolder'>Envoie en cours...</p>";
    document.getElementById('contact-form').submit();

  }
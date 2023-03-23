
<section class="container bg-light p-5 border rounded">
    <h2 class="h1-responsive  text-center my-4 fw-bold text-danger">Contactez-nous</h2>
    <p class="text-center w-responsive mx-auto mb-5 fst-italic ">Vous souhaitez effectuer une réservation ? Demander de plus amples renseignements à propos de nos chambres ou activités? N’hésitez pas à contacter notre Hôtel par téléphone, mail ou via notre formulaire ci-dessous. Nous nous ferrons un plaisir de répondre à vos questions.</p>
    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id ="contact-form" name="contact-form" action="" method="POST"  onsubmit="return validateForm()" >
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="md-form mb-0">
                            <label for="name" class="">Votre nom</label>
                            <!-- Préremplisage de l'input avec name -->
                            <?php  $name = (isset($_SESSION['name'])) ? $_SESSION['name'] : '';?>
                            <input type="text" id="name" name="name" value="<?= $name ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="md-form mb-0 ">
                            <label for="email" class="">Votre adresse mail</label>
                            <!-- Préremplisage de l'input avec email -->
                            <?php  $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : '';?>
                            <input type="text" id="email" name="email" value="<?= $email ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="md-form mb-0 ">
                            <label for="subject" class="">Sujet</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="md-form">
                            <label for="message">Votre message</label>
                            <textarea type="text" id="message" name="message" rows="5" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="md-form">
                            <label for="captcha">Si mon chien est vert. Quelle couleur est celle de mon chien?</label>
                            <input type="text" id="captcha" name="captcha" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="text-center text-md-start mt-3">
                    <div class="status" id="status"></div>
                    <button class="btn btn-danger"  name="btnContact" onclick="validateForm()">Envoyer</button>
                </div>
            </form>
        </div>
        <div class="col-md-3 text-center mt-5">
            <ul class="list-unstyled mb-0 ">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Rue du Comte Ours Blanc 1, 6940 Durbuy</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p><a href="tel:+32496156215">+32 496 15 62 15</a></p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p><a href="mailto:contact@belle-nuit.be">contact@belle-nuit.be</a></p>
                </li>
            </ul>
        </div>
    </div>

</section>
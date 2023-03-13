<!-- Présentation avec images -->
<?= var_dump($_SESSION) ?>
<div class="container py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?= URL ?>public/assets/images/83071739.jpg" class="d-block mx-lg-auto img-fluid rounded" alt="Photos de l'hôtel" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Hotel Belle-Nuit</h1>
            <p class="lead">Notre petit hôtel chaleureux en centre-ville propose des chambres confortables et bien équipées, ainsi qu'un petit déjeuner buffet chaque matin. Nous avons une équipe accueillante et notre salon confortable est idéal pour se détendre. Nous espérons vous accueillir bientôt !</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-danger btn-lg px-4 me-md-2">Primary</button>
                <button type="button" class="btn btn-outline-danger btn-lg px-4">Default</button>
            </div>
        </div>
    </div>
</div>
<!-- Présentation de nos équipes -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-5">
            <h2 class="display-4 font-weight-light">Nos équipes</h2>
            <p class="font-italic text-muted">Nous sommes là pour vous servir et rendre votre séjour inoubliable.</p>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-xl-3 col-sm-6 mb-5 sizeTeam">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="<?= URL ?>public/assets/images/teams/Elon_Musk_Royal_Society.jpg" alt="Elone Muska" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Elone Muska</h5><span class="small text-uppercase text-muted">Directeur</span>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-5 sizeTeam">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="<?= URL ?>public/assets/images/teams/receptionniste.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Samuel Hardy</h5><span class="small text-uppercase text-muted">Responsable Accueil</span>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-5 sizeTeam">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="<?= URL ?>public/assets/images/teams/menage.jpg" alt="Femme de ménage" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Tom Sunderland</h5><span class="small text-uppercase text-muted">Réponsable service ménage</span>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-5 sizeTeam">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="<?= URL ?>public/assets/images/teams/AVT_Philippe-Etchebest_9559.jpg" alt="Philippe Etchebest" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Phil Cestlebest</h5><span class="small text-uppercase text-muted">Chef étoiles</span>
            </div>
        </div>
    </div>
</div>
<!-- 3 éme section -->
<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Hanging icons</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="col d-flex align-items-start">
            <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
            </div>
            <div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="btn btn-danger">
                    Primary button
                </a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#cpu-fill"/></svg>
            </div>
            <div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="btn btn-danger">
                    Primary button
                </a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg>
            </div>
            <div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="btn btn-danger">
                    Primary button
                </a>
            </div>
        </div>
    </div>
</div>

<h1 class="text-center my-3 text-danger fw-bolder mt-5 mb-5">Restaurant de spécialités belges</h1>
<div class="row align-items-center mb-5">
    <div class="col-md-7 me-5 text-justify">
        <p class="lead">Bienvenue dans notre restaurant spécialisé en cuisine belge, situé au cœur de la province de La Roche-en-Ardenne. Nous vous invitons à découvrir une expérience culinaire authentique mettant en valeur les produits biologiques de la région.</p>
        <p>Notre menu propose une sélection variée de plats belges traditionnels, préparés avec soin par notre équipe de chefs talentueux. Vous pourrez déguster des entrées savoureuses et des plats principaux mettant en avant les saveurs locales. Notre menu offre des options pour tous les goûts, que vous préfériez la viande ou le poisson.</p>
        <p>Accompagnez votre repas avec notre carte de bières belges renommées et une sélection de vins choisis avec soin. Terminez en beauté avec nos délicieux desserts, préparés avec passion et créativité.</p>
        <p>Notre équipe attentionnée est impatiente de vous accueillir et de vous faire découvrir les plaisirs de la cuisine belge, dans une ambiance chaleureuse et conviviale. Réservez dès maintenant et laissez-vous séduire par les saveurs uniques de La Roche-en-Ardenne.</p>
    </div>
    <div class="col-md-4">
        <img src="<?= URL ?>public/assets/images/restaurant/cuisine2.jpg" alt="Cuisinier qui découpe un oignon" class="rounded-5 img-fluid">
    </div>
</div>


<h2 class="text-center my-3 text-danger fw-bolder mt-5 mb-5">
    Notre menu
</h2>

<div class="row mb-5 justify-content-center">
    <?php foreach ($categoryResto as $category) { ?>
        <div class="col-md-9 mx-auto">
            <h4 class="text-danger fw-bolder mb-3 mt-2"><?= $category["restocategory_name"] ?></h4>
            <?php foreach ($category["restaurant"] as $service) { ?>
                <p class="lh-1">
                    <?= $service['product_title'] ?><span class="float-end"><?= $service['product_price'] ?>€</span>
                </p>
            <?php } ?>
        </div>
    <?php } ?>
</div>


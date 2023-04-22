<h1 class="text-center my-3 text-danger fw-bolder mt-5 mb-5">Spa &amp; Bien-être</h1>

<div class="row mb-5">
    <div class="col-md-6 text-justify d-flex align-items-center">
            Le spa de Belle-nuit possède une piscine intérieure chauffée équipée de jets de massage pour se détendre. Il possède également un sauna sec et un hammam pour offrir différentes options de chaleur et d'humidité aux clients. <br><br>
            En ce qui concerne les soins du corps, le spa de Belle-nuit propose une variété de massages, tels que des massages suédois, des massages aux pierres chaudes, des massages ayurvédiques, des massages thaïlandais et des massages shiatsu. Les clients peuvent également profiter de soins du visage tels que des nettoyages de peau, des traitements anti-âge et des soins hydratants. <br><br>
            Le spa de Belle-nuit offre également des soins de beauté tels que des manucures et des pédicures, ainsi que des soins capillaires tels que des coupes de cheveux, des colorations et des coiffures pour les occasions spéciales. <br><br>
            Enfin, pour compléter l'expérience de détente, le spa de Belle-nuit propose également des cours de yoga, de Pilates ou de méditation pour aider les clients à se détendre et à se ressourcer.
    </div>
    <div class="col-md-6">
        <img src="<?= URL ?>public/assets/images/spa/spa1.jpg" alt="Massage + Huile" class="img-fluid rounded-5">
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-4">
        <img src="<?= URL ?>public/assets/images/spa/spa2.jpg" alt="Hammam" class="img-fluid">
    </div>
    <div class="col-md-4">
        <img src="<?= URL ?>public/assets/images/spa/spa3.jpg" alt="Piscine" class="img-fluid">
    </div>
    <div class="col-md-4">
        <img src="<?= URL ?>public/assets/images/spa/spa4.jpg" alt="Spa" class="img-fluid">
    </div>
</div>

<div class="row mb-5 bg-grey">
    <div class="col-md-6">
        <h3 class="text-danger fw-bolder mb-3 mt-2"><?= $categorySpa[0]["spacategory_name"] ?></h3>
        <?php foreach ($massages as $massage) { ?>
            <p class="lh-1">
                <?= $massage['spa_title'] ?> (<?= $massage['spa_time'] ?> minutes)<span class="float-end"><?= $massage['spa_price'] ?>€</span>
            </p>
        <?php } ?>
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <img src="<?= URL ?>public/assets/images/spa/spa5.jpg" alt="soin du visage" class="img-fluid rounded-5">
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <h3 class="text-danger fw-bolder mb-3"><?= $categorySpa[1]["spacategory_name"] ?></h3>
        <?php foreach ($facecares as $facecare) { ?>
            <p class="lh-1">
                <?php echo $facecare['spa_title']; ?>
                (<?php echo $facecare['spa_time'] . ' minutes'; ?>)
                <span class="float-end"><?php echo $facecare['spa_price'] . '€'; ?></span>
            </p>
        <?php } ?>
        <h3 class="text-danger fw-bolder mb-3"><?= $categorySpa[2]["spacategory_name"] ?></h3>
        <?php foreach ($bodycares as $bodycare) { ?>
            <p class="lh-1">
                <?php echo $bodycare['spa_title']; ?>
                (<?php echo $bodycare['spa_time'] . ' minutes'; ?>)
                <span class="float-end"><?php echo $bodycare['spa_price'] . '€'; ?></span>
            </p>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <h3 class="text-danger fw-bolder mb-3"><?= $categorySpa[3]["spacategory_name"] ?></h3>
        <?php foreach ($handfootcares as $handfootcare) { ?>
            <p class="lh-1">
                <?php echo $handfootcare['spa_title']; ?>
                (<?php echo $handfootcare['spa_time'] . ' minutes'; ?>)
                <span class="float-end"><?php echo $handfootcare['spa_price'] . '€'; ?></span>
            </p>
        <?php } ?>
        <h3 class="text-danger fw-bolder mb-3"><?= $categorySpa[4]["spacategory_name"] ?></h3>
        <?php foreach ($othercares as $othercare) { ?>
            <p class="lh-1">
                <?php echo $othercare['spa_title']; ?>
                (<?php echo $othercare['spa_time'] . ' minutes'; ?>)
                <span class="float-end"><?php echo $othercare['spa_price'] . '€'; ?></span>
            </p>
        <?php } ?>
    </div>
</div>


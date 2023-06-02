
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description; ?>">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="<?= URL ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>public/css/main.css">
    <script src="<?= URL ?>public/JavaScript/dateVerification.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
            integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e8c3134b85.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <?php require_once("views/main/common/__menu.php"); ?>
    <?php if (!empty($_SESSION['alert'])) : ?>
        <div class="alert font-weight-bold text-center <?= $_SESSION['alert']['type']; ?>" role="alert">
            <?php echo $_SESSION['alert']['message']; ?>
        </div>
        <?php
        unset($_SESSION['alert']);
    endif;
    ?>
    <?= $page_content; ?>
</div>
<?php require_once("views/main/common/__footer.php"); ?>
</body>

</html>
<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));

require_once("./controllers/FrontController.php");
require_once("./controllers/BackController.php");
require_once("./controllers/AdminController.php");
require_once("./controllers/BookingController.php");
require_once("./config/Securite.class.php");
$frontController = new FrontController();
$backController = new BackController();
$adminController = new AdminController();
$bookingController = new BookingController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = Securite::secureHTML($url[0]);
    }

    switch ($page) {
        case "accueil" :
            $frontController->accueil();
            break;
        case "bedrooms" :
            $frontController->bedrooms();
            break;
        case "contact" :
            $frontController->contact();
            break;
        case "login" :
            $backController->login();
            break;
        case "profil" :
            $backController->profil();
            break;
        case "disconnect":
            $frontController->disconnect();
            break;
        case "apply":
            $backController->apply();
            break;
        case "activation":
            $backController->activation();
            break;
        // Routage Admin
        case "admin":
            $adminController->adminMenu();
            break;
        case "adminAccount":
            $adminController->adminAccount();
            break;
        case "adEditAccount":
            $adminController->adminEditAccount();
            break;
        case "adminBedrooms":
            $adminController->adminBedrooms();
            break;
        case "adminEditBed":
            $adminController->adminEditBed();
            break;
        case "adminManagerBedPicture":
            $adminController->adminManagerBedPicture();
            break;
        case "adminBedroomAdd":
            $adminController->adminBedroomAdd();
            break;
        // Partie suppression
        case "deletePicture":
            $adminController->pictureDelete();
            break;
        case "deleteBedroom":
            $adminController->bedroomDelete();
            break;
        case "accueilBooking":
            $bookingController->bookingHome();
            break;
        case "BookingAvailable":
            $bookingController->BookingAvailable();
            break;
        default :
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $frontController->pageErreur($e->getMessage());
}

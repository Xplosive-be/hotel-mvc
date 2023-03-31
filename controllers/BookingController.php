<?php
require_once("models/FrontManager.model.php");
require_once("models/BookingManager.model.php");

class BookingController
{
    private $frontManager;
    private $bookingManager;
    public function __construct()
    {
        $this->frontManager = new FrontManager();
        $this->bookingManager = new BookingManager();
    }
    private function genererPage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public  function bookingHome() {
        if (Securite::verifConnectSession()){
            $bedrooms = $this->frontManager->getAllBedrooms();
            $data_page = [
                "page_description" => "Réservation",
                "page_title" => "Hôtel Belle-Nuit | Réservation",
                "bedrooms" => $bedrooms,
                "view" => "views/booking/bookingHome.view.php",
                "template" => "views/booking/common/__template_front.php",
                "page_javascript" => ["general.js"],
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Merci de bien vouloir vous connecter.",
                "type" => 'alert-danger',
            ];
            $_SESSION['loginBooking'] = 1;
            header('Location: login');
        }
    }
    public function bookingAvailable(){
        if(Securite::verifConnectSession()){
            $dateBegin = "";
            $dateEnd = "";

            // Vérifier si les clés existent dans le tableau $_POST
            if(isset($_POST['dateBegin']) && isset($_POST['dateEnd'])) {
                $dateBegin = Securite::secureHTML($_POST['dateBegin']);
                $dateEnd = Securite::secureHTML($_POST['dateEnd']);
            } else {
                // Si les clés n'existent pas, récupérer les valeurs des variables de session
                if(isset($_SESSION['booking']['dateBegin']) && isset($_SESSION['booking']['dateEnd'])) {
                    $dateBegin = $_SESSION['booking']['dateBegin'];
                    $dateEnd = $_SESSION['booking']['dateEnd'];
                }
            }

            // Vérifier si les dates de réservation sont définies
            if(empty($dateBegin) || empty($dateEnd)){
                $_SESSION['alert'] = [
                    "message" => "Merci de choisir une date",
                    "type" => "alert-danger"
                ];
                header('Location: accueilBooking');
            }

            // Enregistrer les dates de réservation dans les variables de session
            $_SESSION['booking']['dateBegin'] = $dateBegin;
            $_SESSION['booking']['dateEnd'] = $dateEnd;

            // Calculer le nombre de nuits pour la réservation
            $totalDay = strtotime($dateEnd) - strtotime($dateBegin);
            $totalNight = round($totalDay /(60 * 60 *24));
            $_SESSION['booking']['nights'] = $totalNight;

            // Récupérer les chambres disponibles et non disponibles pour les dates de réservation
            $bedroomsAvailable = $this->bookingManager->getAllBedroomsByAvailable($dateBegin,$dateEnd);
            $bedroomsNotAvailable = $this->bookingManager->getAllBedroomsByNotAvailable($dateBegin,$dateEnd);

            // Convertir les dates de réservation en formats lisibles par l'utilisateur
            $dateBeginStamp = strtotime($dateBegin);
            setlocale(LC_TIME, 'fr_FR.utf8');
            $_SESSION['booking']['dateBeginTxt'] = strftime('%A, %e %B %Y', $dateBeginStamp);
            $dateEndStamp= strtotime($dateEnd);
            $_SESSION['booking']['dateEndTxt'] = strftime('%A, %e %B %Y', $dateEndStamp);

            $data_page = [
                "page_description" => "Réservation",
                "page_title" => "Hôtel Belle-Nuit | Réservation",
                "bedroomsNotAvailable" => $bedroomsNotAvailable,
                "bedroomsAvailable" => $bedroomsAvailable,
                "totalNight" => $totalNight,
                "page_javascript" => ["general.js"],
                "view" => "views/booking/bookingAvailable.view.php",
                "template" => "views/booking/common/__template_front.php",
            ];
            $this->genererPage($data_page);
        } else {
            // Rediriger l'utilisateur vers la page de connexion si la session n'est pas active
            $_SESSION['alert'] = [
                "message" => "Merci de bien vouloir vous connecter.",
                "type" => 'alert-danger'
            ];
            $_SESSION['loginBooking'] = 1;
            header('Location: login');

        }
    }
    public function bookingServices()
    {
        if (Securite::verifConnectSession()) {
            $bedSelectedAvailable = $this->bookingManager->checkBedroomAvailableById($_SESSION['booking']['dateBegin'], $_SESSION['booking']['dateEnd'], Securite::secureHTML($_GET['idBedroom']));
            if (!empty($bedSelectedAvailable) && !empty($_SESSION['booking']["dateEnd"])) {
                $allServices = $this->bookingManager->getAllServicesBedroom();
                $_SESSION['booking']['bedroom_name'] = $bedSelectedAvailable['bedroom_name'];
                $_SESSION['booking']['price'] = $bedSelectedAvailable['bedroom_priceday'] * $_SESSION['booking']['nights'];
                $json = json_encode($allServices);
                $data_page = [
                    "allServices" => $allServices,
                    "page_description" => "Choix des bonus",
                    "page_title" => "Hôtel Belle-Nuit | Choix des bonus",
                    "json" => $json,
                    "page_javascript" => ["services.js"],
                    "view" => "views/booking/bookingServices.view.php",
                    "template" => "views/booking/common/__template_front.php",
                ];
                $this->genererPage($data_page);
            } else {
                $_SESSION['alert'] = [
                    "message" => "Désolé, il n'y a pas de chambres disponibles pour la période sélectionnée. Veuillez choisir une autre date ou contacter l'hôtel pour obtenir de l'aide.",
                    "type" => 'alert-danger'
                ];
                header('Location: bookingAvailable');
            }

        } else {
            $_SESSION['alert'] = [
                "message" => "Merci de bien vouloir vous connecter.",
                "type" => 'alert-danger'
            ];
            $_SESSION['loginBooking'] = 1;
            header('Location: login');
        }
    }
    public function bookingCustomers(){
            if(Securite::verifConnectSession()){
                $countrys = $this->frontManager->getCountryList();
                $data_page = [
                    "countrys" => $countrys,
                    "page_description" => "Informations Réservations",
                    "page_title" => "Hôtel Belle-Nuit | Vos informations",
                    "view" => "views/booking/bookingCustomers.view.php",
                    "template" => "views/booking/common/__template_front.php",
                ];
                $this->genererPage($data_page);
            } else {
                $_SESSION['alert'] = [
                    "message" => "Désolé, il n'y a pas de chambres disponibles pour la période sélectionnée. Veuillez choisir une autre date ou contacter l'hôtel pour obtenir de l'aide.",
                    "type" => 'alert-danger'
                ];
                header('Location: bookingAvailable');
            }
        }
    public function bookingResume(){
        if(Securite::verifConnectSession()){
            $data_page = [
                "page_description" => "Résumé de votre réservation",
                "page_title" => "Hôtel Belle-Nuit | Résumé de votre réservation",
                "view" => "views/booking/bookingResume.view.php",
                "template" => "views/booking/common/__template_front.php",
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Désolé, il n'y a pas de chambres disponibles pour la période sélectionnée. Veuillez choisir une autre date ou contacter l'hôtel pour obtenir de l'aide.",
                "type" => 'alert-danger'
            ];
            header('Location: bookingAvailable');
        }
    }
}
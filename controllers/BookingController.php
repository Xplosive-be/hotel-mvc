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
            unset($_SESSION['booking']);
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
    public function bookingAvailable()
    {
        if (Securite::verifConnectSession()) {
            unset($_SESSION['booking']);
            $dateBegin = "";
            $dateEnd = "";

            // Vérifier si les clés existent dans le tableau $_POST
            if (isset($_POST['dateBegin']) && isset($_POST['dateEnd'])) {
                $dateBegin = Securite::secureHTML($_POST['dateBegin']);
                $dateEnd = Securite::secureHTML($_POST['dateEnd']);
            } else {
                // Si les clés n'existent pas, récupérer les valeurs des variables de session
                if (isset($_SESSION['booking']['dateBegin']) && isset($_SESSION['booking']['dateEnd'])) {
                    $dateBegin = $_SESSION['booking']['dateBegin'];
                    $dateEnd = $_SESSION['booking']['dateEnd'];
                }
            }

            // Vérifier si les dates de réservation sont définies et valides
            if (empty($dateBegin) || empty($dateEnd) || strtotime($dateEnd) <= strtotime($dateBegin)) {
                $_SESSION['alert'] = [
                    "message" => "Merci de choisir des dates de réservation valides.",
                    "type" => "alert-danger"
                ];
                header('Location: accueilBooking');
                exit;
            }

            // Enregistrer les dates de réservation dans les variables de session
            $_SESSION['booking']['dateBegin'] = $dateBegin;
            $_SESSION['booking']['dateEnd'] = $dateEnd;

            // Calculer le nombre de nuits pour la réservation
            $totalDay = strtotime($dateEnd) - strtotime($dateBegin);
            $totalNight = round($totalDay / (60 * 60 * 24));
            $_SESSION['booking']['nights'] = $totalNight;

            // Récupérer les chambres disponibles et non disponibles pour les dates de réservation
            $bedroomsAvailable = $this->bookingManager->getAllBedroomsByAvailable($dateBegin, $dateEnd);
            $bedroomsNotAvailable = $this->bookingManager->getAllBedroomsByNotAvailable($dateBegin, $dateEnd);

            $dateBeginObj = new DateTime($dateBegin);
            $dateEndObj = new DateTime($dateEnd);

            // Tableaux de traduction des jours de la semaine et des mois en français
            $daysOfWeek = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
            $months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

            $dayOfWeekBeginIndex = (int)$dateBeginObj->format('w');
            $monthBeginIndex = (int)$dateBeginObj->format('n') - 1;
            $dayOfWeekEndIndex = (int)$dateEndObj->format('w');
            $monthEndIndex = (int)$dateEndObj->format('n') - 1;

            $_SESSION['booking']['dateBeginTxt'] = $daysOfWeek[$dayOfWeekBeginIndex] . ', ' . $dateBeginObj->format('j') . ' ' . $months[$monthBeginIndex] . ' ' . $dateBeginObj->format('Y');
            $_SESSION['booking']['dateEndTxt'] = $daysOfWeek[$dayOfWeekEndIndex] . ', ' . $dateEndObj->format('j') . ' ' . $months[$monthEndIndex] . ' ' . $dateEndObj->format('Y');



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
            exit;
        }
    }
    public function bookingServices()
    {
        if (Securite::verifConnectSession()) {
            $bedSelectedAvailable = $this->bookingManager->checkBedroomAvailableById($_SESSION['booking']['dateBegin'], $_SESSION['booking']['dateEnd'], Securite::secureHTML($_GET['idBedroom']));
            if (!empty($bedSelectedAvailable) && !empty($_SESSION['booking']["dateEnd"])) {
                unset($_SESSION['booking']['services']);
                $allServices = $this->bookingManager->getAllServicesBedroom();
                $_SESSION['booking']['bedroom_name'] = $bedSelectedAvailable['bedroom_name'];
                $_SESSION['booking']['bedroom_id'] = $bedSelectedAvailable['bedroom_id'];
                $_SESSION['booking']['price'] = $bedSelectedAvailable['bedroom_priceday'] * $_SESSION['booking']['nights'];
                $data_page = [
                    "allServices" => $allServices,
                    "page_description" => "Choix des bonus",
                    "page_title" => "Hôtel Belle-Nuit | Choix des bonus",
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
            if(Securite::verifConnectSession() && !empty($_SESSION['booking']['price'])){
                    if(isset($_POST['btnServices'])){
                        $_SESSION['booking']['arrivalTime'] = Securite::secureHTML($_POST['arrivalTime']);
                        $_SESSION['booking']['comments'] = $_POST['comments'];
                    // Vérifier si des services ont été sélectionnés
                        if (isset($_POST['services'])) {
                            // Créer un tableau associatif pour stocker les services sélectionnés
                            $services = array();
                            $total_price = $_SESSION['booking']['price'];
                            foreach ($_POST['services'] as $service_id) {
                                // Récupérer les informations du service à partir de l'id
                                $service = $this->bookingManager->getServiceById($service_id);
                                // Ajouter le service au tableau associatif
                                $services[$service['service_id']] = array(
                                    'id' => $service['service_id'],
                                    'name' => $service['service_name'],
                                    'price' => $service['service_price']
                                );
                                // Ajouter le prix du service au prix total
                                $total_price += $service['service_price'];
                            }
                            // Stocker le tableau associatif dans la variable de session
                            $_SESSION['booking']['services'] = $services;
                            // Stocker le prix total dans la variable de session
                            $_SESSION['booking']['priceTotal'] = $total_price;
                        } else {
                            // Si aucun service n'a été sélectionné, le prix total est égal au prix de la chambre
                            $_SESSION['booking']['prixTotal'] = $_SESSION['booking']['price'];
                        }
                    }
                $data_page = [
                    "countrys" => $this->frontManager->getCountryList(),
                    "page_description" => "Informations Réservations",
                    "page_title" => "Hôtel Belle-Nuit | Vos informations",
                    "view" => "views/booking/bookingCustomers.view.php",
                    "template" => "views/booking/common/__template_front.php",
                ];
                $this->genererPage($data_page);
            } else {
                $_SESSION['alert'] = [
                    "message" => "Problème durant la sélection des services, Merci de recommencer la réservation",
                    "type" => 'alert-danger'
                ];
                header('Location: bookingServices');
            }
        }
    public function bookingResume(){
        if(Securite::verifConnectSession() && isset($_POST) && !empty($_SESSION['booking'])){
            if (isset($_POST['btnCustomer'])) {
                // Verification et sécurisation des nouvelles données.
                $_SESSION['booking']['customers']['gender'] = Securite::secureHTML($_POST['gender']);
                $_SESSION['booking']['customers']['surname'] = Securite::secureHTML($_POST['surname']);
                $_SESSION['booking']['customers']['name'] = Securite::secureHTML($_POST['name']);
                $_SESSION['booking']['customers']['email'] = Securite::secureHTML($_POST['email']);
                $_SESSION['booking']['customers']['address'] = Securite::secureHTML($_POST['address']);
                $_SESSION['booking']['customers']['box'] = Securite::secureHTML($_POST['box']);
                $_SESSION['booking']['customers']['country'] = Securite::secureHTML($_POST['country']);
                $_SESSION['booking']['customers']['city'] = Securite::secureHTML($_POST['city']);
                $_SESSION['booking']['customers']['postalCode'] = Securite::secureHTML($_POST['postalCode']);
                $_SESSION['booking']['customers']['phone'] = Securite::secureHTML($_POST['phone']);
                $_SESSION['booking']['ready'] = 1;
            }
            $data_page = [
                "page_description" => "Résumé de votre réservation",
                "country" => $this->frontManager->getCountryById($_SESSION['booking']['customers']['country']),
                "page_title" => "Hôtel Belle-Nuit | Résumé de votre réservation",
                "view" => "views/booking/bookingResume.view.php",
                "template" => "views/booking/common/__template_front.php",
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Merci de recommencer votre réservation",
                "type" => 'alert-danger'
            ];
            header('Location: accueilBooking');
        }
    }
    public function bookingValidate(){
        if(Securite::verifConnectSession() && !empty($_SESSION['booking']['ready'] == 1 )){
            if(isset($_POST['validateBooking'])){
                $this->bookingManager->addBooking();
            }
            if(isset($_POST['cancelBooking'])){
                $_SESSION['alert'] = [
                    "message" => 'En espèrant, vous revoir bientôt',
                    "type" => 'alert-danger'
                ];
                header('Location: accueilBooking');
            }
            $data_page = [
                "booking_id" => $this->bookingManager->lastIdReservation($_SESSION['idAccount']),
                "page_description" => "Confirmation de la réservation",
                "page_title" => "Hôtel Belle-Nuit | Confirmation ",
                "view" => "views/booking/bookingValidate.view.php",
                "template" => "views/booking/common/__template_front.php",
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Merci de recommencer votre réservation",
                "type" => 'alert-danger'
            ];
            header('Location: accueilBooking');
        }
    }
}
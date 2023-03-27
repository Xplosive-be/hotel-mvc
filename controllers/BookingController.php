<?php
require_once("models/FrontManager.model.php");

class BookingController
{
    private $frontManager;
    public function __construct()
    {
        $this->frontManager = new FrontManager();
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
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Merci de bien vouloir vous connecter.",
                "type" => 'alert-danger'
            ];
            header('Location: login');
        }
    }
    public function BookingAvailable(){
        if(Securite::verifConnectSession()){
            if(empty($_POST['dateBegin']) || empty($_POST['dateEnd'])){
                $_SESSION['alert'] = [
                    "message" => "Merci de choisir une date",
                    "type" => "alert-danger"
                ];
                header('Location: accueilBooking');
            }
            $dateBegin = Securite::secureHTML($_POST['dateBegin']) ;
            $dateEnd = Securite::secureHTML($_POST['dateEnd']) ;
            $_SESSION['dateBegin '] = $dateBegin;
            $_SESSION['dateEnd'] = $dateEnd;

            $totalDay = strtotime($dateEnd) - strtotime($dateBegin);
            $totalNight = round($totalDay /(60 * 60 *24));
            $bedroomsAvailable = $this->frontManager->getAllBedroomsByAvailable($dateBegin,$dateEnd);
            $dateBeginStamp = strtotime($dateBegin);
            setlocale(LC_TIME, 'fr_FR.utf8');
            $dateBeginTxt = strftime('%A, %e %B %Y', $dateBeginStamp);
            $dateEndStamp= strtotime($dateEnd);
            $dateEndTxt = strftime('%A, %e %B %Y', $dateEndStamp);


            $data_page = [
                "page_description" => "Réservation",
                "page_title" => "Hôtel Belle-Nuit | Réservation",
                "bedroomsAvailable" => $bedroomsAvailable,
                "dateBeginTxt" => $dateBeginTxt,
                "dateEndTxt" => $dateEndTxt,
                "totalNight" => $totalNight,
                "view" => "views/booking/bookingAvailable.view.php",
                "template" => "views/booking/common/__template_front.php",
            ];
            $this->genererPage($data_page);
        } else
        {
            $_SESSION['alert'] = [
                "message" => "Merci de bien vouloir vous connecter.",
                "type" => 'alert-danger'
            ];
            header('Location: login');
        }
    }
}
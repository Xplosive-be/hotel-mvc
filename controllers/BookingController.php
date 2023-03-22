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

    public  function accueilBooking() {
        if (Securite::verifConnectSession()){
            $bedrooms = $this->frontManager->getAllBedrooms();
            $data_page = [
                "page_description" => "Menu d'Administration",
                "page_title" => "Hôtel Belle-Nuit | Administration",
                "bedrooms" => $bedrooms,
                "view" => "views/booking/booking_accueil.view.php",
                "template" => "views/booking/common/template_front.php",
            ];
            $this->genererPage($data_page);
        } else {
            $_SESSION['alert'] = [
                "message" => "Accès non-autorisé",
                "type" => 'alert-danger'
            ];
            header('Location: accueil');
        }
    }
}
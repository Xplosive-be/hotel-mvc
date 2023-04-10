<?php

require_once("models/FrontManager.model.php");

class FrontController{
    private $frontManager;
    private $backManager;

    public function __construct(){
        $this->frontManager = new FrontManager();
        $this->backManager = new BackManager();
    }
//Cette méthode privée génère une page en extrayant les données passées en paramètre et en incluant les fichiers de vue et de modèle.
    private function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
    // Page _css : tableau permettant d'ajouter des fichiers css Spécifique
    // Page_javascript : tableau permettant d'ajouter des fichiers Javascript spécifique
    public function accueil(){
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Hôtel Belle-Nuit | Accueil",
            "view" => "views/main/front/accueil.view.php",
            "template" => "views/main/common/__template_front.php"
        ];
        $this->genererPage($data_page);
    }
    public function bedrooms(){
        $bedrooms = $this->frontManager->getAllBedrooms();
        $data_page = [
                "page_description" => "Description de nos différentes chambres",
                "page_title" => "Hôtel Belle-Nuit | Nos Chambres",
                "bedrooms" => $bedrooms,
                "view" => "views/main/front/bedrooms.view.php",
                "template" => "views/main/common/__template_front.php"
        ];
        $this->genererPage($data_page);
    }
    public function contact(){
        if (isset( $_POST['btnContact'])) {
            $name = Securite::secureHTML($_POST['name']);
            $email = Securite::secureHTML($_POST['email']);
            $message = Securite::secureHTML($_POST['message']);
            $subject = Securite::secureHTML($_POST['subject']);
            $content="De la part : $name \n Email: $email \n Message: $message";
            $recipient = "smeyers.samir@gmail.com";
            $mailheader = "de: $email \r\n";
            //mail($recipient, $subject, $content, $mailheader) or die("Erreur!");
            $_SESSION['alert'] = [
                "message" => 'Votre message a été envoyé, nous y répondrons dans un délais de 24 h ouvrables.',
                "type" => 'alert-success'
            ];
        }

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Hôtel Belle-Nuit | Contactez-nous",
            "view" => "views/main/front/contact.view.php",
            "template" => "views/main/common/__template_front.php",
            "page_javascript" => ["contact.js"],
        ];

        $this->genererPage($data_page);
    }

    public function disconnect(){
        session_unset();
        session_destroy();
        $_SESSION['alert'] = [
            "message" => "Votre compte n'est pas activé, veuillez vérifier  votre boîte mail!",
            "type" => 'alert-danger'
        ];
        header('Location: accueil');
    }
    public function pageErreur($msg){
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "./views/main/front/erreur.view.php",
            "template" => "views/main/common/__template_front.php"
        ];
        $this->genererPage($data_page);
    }
}
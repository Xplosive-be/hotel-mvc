<?php

require_once("models/FrontManager.model.php");
require_once("models/BackManager.model.php");
require_once("models/AdminManager.model.php");

class BackController{
    private $frontManager;
    private $backManager;
    private $adminManager;

    public function __construct(){
        $this->frontManager = new FrontManager();
        $this->backManager = new BackManager();
        $this->adminManager = new AdminManager();
    }

    private function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    // Page _css : tableau permettant d'ajouter des fichiers css Spécifique
    // Page_javascript : tableau permettant d'ajouter des fichiers Javascript spécifique

    // Function Controller pour la page Login
    public function login(){
        if (isset( $_POST['btnConnection'])) {
            $login = Securite::secureHTML($_POST['login']);
            $account = $this->backManager->getLoginAccount($login);
            $password = Securite::EncryptPassword(Securite::secureHTML($_POST['password']));
            var_dump($password);
            // Connection
            if(!empty($account)) {
                if ($password == $account["acc_password"]  && $account["acc_active"] != 0 ){
                    //Init variable pour des fonctions suivante
                    $_SESSION['online'] = 1;
                    $_SESSION['idAccount'] = $account["acc_id"];
                    $_SESSION['surname'] = $account["acc_surname"];
                    $_SESSION['name'] = $account["acc_name"];
                    $_SESSION['email'] = $account["acc_email"];
                    $_SESSION['address'] = $account["acc_address"];
                    $_SESSION['city'] = $account["acc_city"];
                    $_SESSION['country'] = $account["acc_id_country"];
                    $_SESSION['admin'] = $account["acc_admin"];
                    //  Message de succès de connection
                    $_SESSION['alert'] = [
                        "message" => "Connection réussis avec succès",
                        "type" => "alert-success"
                    ];
                    header('Location: accueil');
                    exit();
                } elseif ($account["acc_active"] == 0){
                    // Erreur : Compte n'est pas activé
                    $_SESSION['alert'] = [
                        "message" => "Votre compte n'est pas activé, veuillez vérifier  votre boîte mail!",
                        "type" => 'alert-danger'
                    ];
                    header('Location: accueil');
                    exit();
                } else {
                    // $msg_error = "Un de vos identifiants est érroné! ";
                    $_SESSION['alert'] = [
                        "message" => "Un de vos identifiants est érroné!",
                        "type" => 'alert-danger'
                    ];
                    header('Location: accueil');
                    exit();
                }
            } else {
                // $msg_error = "Un de vos identifiants est érroné! ";
                $_SESSION['alert'] = [
                    "message" => "Un de vos identifiants est érroné!",
                    "type" => 'alert-danger'
                ];
                header('Location: accueil');
                exit();
            }
        }

        /** Envoie les données pour générer la page */
        $data_page = [
            "page_description" => "La page de connection",
            "page_title" => "Hôtel Belle-Nuit | Connectez-vous",
            "view" => "views/main/back/login.view.php",
            "template" => "views/main/common/template_front.php"
        ];
        $this->genererPage($data_page);
    }
    public function profil(){
        if (isset( $_POST['btnEdit'])) {
            // Verification et sécurisation des nouvelles données.
            $surname = Securite::secureHTML($_POST['surname']);
            $name = Securite::secureHTML($_POST['name']);
            $address = Securite::secureHTML($_POST['address']);
            $country = Securite::secureHTML($_POST['country']);
            $city = Securite::secureHTML($_POST['city']);
            //SQL pour mettre à jour la DB
            $this->backManager->setEditProfil($name,$surname,$address,$city,$country,$_SESSION["idAccount"]);
            //Update Session avec les nouvelles valeurs.
            $_SESSION['surname'] = $surname;
            $_SESSION['name'] = $name;
            $_SESSION['address'] = $address;
            $_SESSION['city'] = $city;
            $_SESSION['country'] = $country;
            // $msg_succes = "Vos informations ont été modifiés avec succès.";
            $_SESSION['alert'] = [
                "message" => 'Vos informations ont été modifiés avec succès.',
                "type" => 'alert-success'
            ];
        }

        $profil = $this->adminManager->getProfil($_SESSION['idAccount']);
        $countrys = $this->frontManager->getCountryList();
        $data_page = [
            "page_description" => " Page de Profil",
            "page_title" => "",
            "countrys" => $countrys,
            "profil" => $profil,
            "view" => "views/main/back/profil.view.php",
            "template" => "views/main/common/template_front.php"
        ];
        $this->genererPage($data_page);
    }
    public function apply(){
        if( isset( $_POST['btnRegistration'])){
            $surname = Securite::secureHTML($_POST['surname']);
            $name = Securite::secureHTML($_POST['name']);
            $email = Securite::secureHTML($_POST['email']);
            $password = Securite::secureHTML($_POST['password']);
            $password_two = Securite::secureHTML($_POST['password_two']);
            $address = Securite::secureHTML($_POST['address']);
            $country = Securite::secureHTML($_POST['country']);
            $city = Securite::secureHTML($_POST['city']);

            // Vérification si les mots de passes ne sont pas les même.
            if($password != $password_two) {
                $_SESSION['alert'] = [
                    "message" => 'Vos mots de passe ne sont pas identique!',
                    "type" => 'alert-danger'
                ];
                exit();
            }
            // Permet de crypter un mot de pass.
            $password = Securite::EncryptPassword($password);
            // Code généré pour permettre d'avoir un code unique pour valider son compte.
            $codeactivation = hash('md2', 'Hello'. rand(5000, 10000) . 'Inscription');

            $apply = $this->backManager->setApplyAccount($name,$surname,$address,$city,$country,$email,$password,$codeactivation);
            if($apply === true) {
                $_SESSION['alert'] = [
                    "message" => "Votre compte a été créé. Vérifier votre boîte mail pour valider votre compte.",
                    "type" => 'alert-success'
                ];
                header('refresh:0.5;url=accueil');
                exit();
            } else {
                $_SESSION['alert'] = [
                    "message" => "Votre adresse mail est déjà pris!",
                    "type" => 'alert-danger'
                ];
                exit();
            }
        }
        $countrys = $this->frontManager->getCountryList();
        $data_page = [
            "page_description" => " Page d'inscription",
            "page_title" => "",
            "countrys" => $countrys,
            "view" => "views/main/back/apply.view.php",
            "template" => "views/main/common/template_front.php"
        ];
        $this->genererPage($data_page);
    }
    public function activation() {
        // Exemple d'url:  activation&id=&codeActivation= .
        if(isset($_GET['id']) && isset($_GET['codeActivation'])){
            // récupération des Get dans une variable avec une vérification grâce à HtmlspecialChars
            $idAccount = Securite::secureHTML($_GET['id']);
            $codeActivation = Securite::secureHTML($_GET['codeActivation']);
            // Init du tableau dans une variable
            $InfoActivation = $this->backManager->getAccountCodeActivation($idAccount);
            // Init des variables via le tableau $InfoActivation
            if (!empty($InfoActivation['acc_code_activation'])){
                $codeDbActivation = $InfoActivation['acc_code_activation'];
                $InfoActivation['acc_active'];
            } else {
                $_SESSION['alert'] = [
                    "message" => "Erreur de la validation. Contactez un administrateur!",
                    "type" => 'alert-danger'
                ];
                header('Location: accueil');
            }
            // Condition si n'est pas active et que le code reçu en get est égal au code présent dans la db pour l'id présent dans le Get
            if ($codeActivation == $codeDbActivation && $InfoActivation['acc_active'] == '0') {
                // Changement de status pour l'activation
                $this->backManager->setAccountActivation($idAccount);
                // redirection vers le $msg_succes = "Votre compte a été activé.";
                $_SESSION['alert'] = [
                    "message" => "Votre compte a été activé.",
                    "type" => 'alert-success'
                ];
                header('Location: accueil');
                // Si Le compte est déjà validé
            } elseif ($InfoActivation['acc_active'] === 1 ) {
                // redirection vers le $msg_error = "Vous avez déjà validé, votre compte."
                $_SESSION['alert'] = [
                    "message" => "Vous avez déjà validé, votre compte",
                    "type" => 'alert-danger'
                ];
                header('Location: accueil');
            } else {
                // si le code n'est pas bon
                // redirection vers le $msg_error =  "Erreur de la validation. Contactez un administrateur!"
                $_SESSION['alert'] = [
                    "message" => "Erreur de la validation. Contactez un administrateur!",
                    "type" => 'alert-danger'
                ];
                header('Location: accueil');
            }
        }
        else {
            // Si l'utilsateur arrive sur la page avec autres choses chose que les 2 get.
            // redirection vers le $msg_error = "Accès Interdit"
            $_SESSION['alert'] = [
                "message" => "Accès Interdit",
                "type" => 'alert-danger'
            ];
            header('Location: accueil');
        }
    }
}
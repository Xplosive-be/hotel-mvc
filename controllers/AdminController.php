<?php
require_once("models/FrontManager.model.php");
require_once("models/BackManager.model.php");
require_once("models/AdminManager.model.php");

class AdminController
{
    private $frontManager;
    private $adminManager;
    private $backManager;

    public function __construct()
    {
        $this->frontManager = new FrontManager();
        $this->backManager = new BackManager();
        $this->adminManager = new AdminManager();
    }

//Cette méthode privée génère une page en extrayant les données passées en paramètre et en incluant les fichiers de vue et de modèle.
    private function genererPage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function adminMenu()
    {
        if (Securite::verifAccessSession()) {
            $data_page = [
                "page_description" => "Menu d'Administration",
                "page_title" => "Hôtel Belle-Nuit | Administration",
                "view" => "views/main/back/adminMenu.view.php",
                "template" => "views/main/common/__template_front.php",
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

    public function adminAccount()
    {
        if (Securite::verifAccessSession()) {
            $profils = $this->adminManager->getProfils();
            $data_page = [
                "page_description" => "Menu d'Administration",
                "page_title" => "Hôtel Belle-Nuit | Administration",
                "view" => "views/main/back/adminAccount.view.php",
                "template" => "views/main/common/__template_front.php",
                "profils" => $profils
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

    public function adminEditAccount()
    {
        if (Securite::verifAccessSession() & isset($_GET['id'])) {
            $profil = $this->adminManager->getProfil($_GET['id']);
            if (!$profil) {
                header('Location: adminaccount');
            }
            if (isset($_POST['btnEditAdmin'])) {
                // Verification et sécurisation des nouvelles données.
                $surname = Securite::secureHTML($_POST['surname']);
                $name = Securite::secureHTML($_POST['name']);
                $address = Securite::secureHTML($_POST['address']);
                $country = Securite::secureHTML($_POST['country']);
                $city = Securite::secureHTML($_POST['city']);
                $box = Securite::secureHTML($_POST['box']);
                $codePostal = Securite::secureHTML($_POST['codePostal']);
                $phone = Securite::secureHTML($_POST['phone']);
                $idAccount = Securite::secureHTML($_GET['id']);

                //SQL pour mettre à jour la DB
                if (!isset($_POST['admin'])) {
                    $admin = 0;
                } else {
                    $admin = Securite::secureHTML($_POST['admin']);
                }
                if (!isset($_POST['active'])) {
                    $active = 0;
                } else {
                    $active = Securite::secureHTML($_POST['active']);
                }
                // Requête pour mettre à jour le profil dans la section Admin.
                //SQL pour mettre à jour la DB
                $this->adminManager->setAdminEditProfil($name, $surname, $address, $city, $country, $active, $box, $codePostal, $phone, $admin, $idAccount);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adEditAccount&id=' . $idAccount);
            }
            $data_page = [
                "page_description" => " Page de Profil",
                "page_title" => "Edition de Profil",
                "countrys" => $this->frontManager->getCountryList(),
                "profil" => $profil,
                "view" => "views/main/back/adminEditAccount.view.php",
                "template" => "views/main/common/__template_front.php"
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

    public function adminBedrooms()
    {
        if (Securite::verifAccessSession()) {
            $bedrooms = $this->frontManager->getAllBedrooms();
            $data_page = [
                "page_description" => "Administration des chambres",
                "page_title" => "Edition des chambres",
                "bedrooms" => $bedrooms,
                "view" => "views/main/back/adminBedrooms.view.php",
                "template" => "views/main/common/__template_front.php"
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

    public function adminEditBed()
    {
        if (Securite::verifAccessSession() & isset($_GET['idEditBed'])) {
            $idEditBed = Securite::secureHTML($_GET['idEditBed']);
            if (!$idEditBed) {
                header('Location: adminBedrooms');
                exit();
            }
            if (isset($_POST['btnEditBed'])) {
                $name = Securite::secureHTML($_POST['name']);
                $description = $_POST['description'];
                $typeBed = Securite::secureHTML($_POST['typeBed']);
                $category = Securite::secureHTML($_POST['category']);
                $price = Securite::secureHTML($_POST['price']);
                $idEditBed = Securite::secureHTML($_GET['idEditBed']);
                $this->adminManager->setAdminEditBed($name, $description, $typeBed, $category, $price, $idEditBed);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adminEditBed&idEditBed=' . $idEditBed);
                exit();
            }
            $data_page = [
                "page_description" => "Administration des chambres",
                "page_title" => "Edition des chambres",
                "CategoryBedList" => $this->frontManager->getCategoryBedList(),
                "bedroomById" => $this->adminManager->getBedroomFromId(Securite::secureHTML($idEditBed)),
                "view" => "views/main/back/adminEditBed.view.php",
                "template" => "views/main/common/__template_front.php"
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

    public function adminBedroomAdd()
    {
        if (Securite::verifAccessSession()) {
            if (isset($_POST['btnAddBed'])) {
                $name = htmlspecialchars($_POST['name']);
                $description = $_POST['description'];
                $typeBed = htmlspecialchars($_POST['typeBed']);
                $category = htmlspecialchars($_POST['category']);
                $price = htmlspecialchars($_POST['price']);
                // Requête pour rajouter la nouvelle chambre
                $this->adminManager->addBed($name, $description, $typeBed, $category, $price);
                $_SESSION['alert'] = [
                    "message" => "Admin --- Chambre rajouté avec succès",
                    "type" => 'alert-success'
                ];
                header('Location: adminBedrooms');
            }
            $data_page = [
                "page_description" => "Ajouter une chambre",
                "page_title" => "Ajouter une chambre",
                "categoryBed" => $this->frontManager->getCategoryBedList(),
                "view" => "views/main/back/adminAddBed.view.php",
                "template" => "views/main/common/__template_front.php"
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

    public function bedroomDelete()
    {
        if(Securite::verifAccessSession()) {
            if (isset($_GET['idDelBedRoom'])) {
                $idDelBedRoom = $_GET['idDelBedRoom'];
                $this->adminManager->deleteIdBed($idDelBedRoom);
                $_SESSION['alert'] = [

                    "message" => "Admin --- La chambre a été supprimée avec succès.",
                    "type" => 'alert-success'
                ];
            } else {
                $_SESSION['alert'] = [
                    "message" => "Admin --- Erreur informations manquant!",
                    "type" => 'alert-danger'
                ];
            }
            header('Location: adminBedrooms');
        } else {
            $_SESSION['alert'] = [
                "message" => "Accès non-autorisé",
                "type" => 'alert-danger'
            ];
            header('Location: accueil');
        }
    }

    public function adminManagerBedPicture()
    {

        if (Securite::verifAccessSession() & isset($_GET['idEditBed'])) {
            $_SESSION['idEditBed'] = Securite::secureHTML($_GET['idEditBed']);
            if (isset($_POST['btnAddPic'])) {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    // L'image existe et a été stockée temporairement sur le serveur
                    if ($_FILES['image']['size'] <= 3000000) {
                        // L'image fait moins de 3 Mo
                        $informationsImage = pathinfo($_FILES['image']['name']);
                        $extensionImage = strtolower($informationsImage['extension']);
                        // Extensions que l'on autorise
                        $extensionsArray = array('png', 'gif', 'jpg', 'jpeg', 'webp');
                        // Le type de l'image correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur
                        if (in_array($extensionImage, $extensionsArray, true)) {
                            $uniqueName = time() . '-' . basename($_FILES['image']['name']);
                            move_uploaded_file($_FILES['image']['tmp_name'], 'public/assets/images/chambres/uploads/' . $uniqueName);
                            // On renomme notre image avec une clé unique suivie du nom du fichier
                            // Rajouter la photo dans la table picture
                            $this->adminManager->addBedPicture($uniqueName);
                            $_SESSION['alert'] = [
                                "message" => "Admin - La photo a été rajoutée avec succès.",
                                "type" => 'alert-success'
                            ];
                            header('Location: adminManagerBedPicture&idEditBed=' . $_SESSION['idEditBed']);
                        }
                    }
                }
            }
            $data_page = [
                "page_description" => "Edition des photos des chambres",
                "page_title" => "Edition des photos des chambres",
                "imagesBedroom" => $this->frontManager->getImagesBedroom($_SESSION['idEditBed']),
                "view" => "views/main/back/adminManagerBedPicture.view.php",
                "template" => "views/main/common/__template_front.php"
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
    public function pictureDelete()
    {
        if (Securite::verifAccessSession()) {
            if ($_GET['delIdPicture']) {

                $idPicture = $_GET['delIdPicture'];
                $idBedroom = $_SESSION['idEditBed'];
                $verificationPicture = $this->adminManager->verificationPicture($idPicture, $idBedroom);
                if (!empty($verificationPicture)) {
                    $this->adminManager->deleteIDPicture($idPicture, $idBedroom);
                    $_SESSION['alert'] = [
                        "message" => "Admin --- La photo a été supprimée avec succès.",
                        "type" => 'alert-success'
                    ];
                } else {
                    $_SESSION['alert'] = [
                        "message" => $verificationPicture,
                        "type" => 'alert-danger'
                    ];
                }
            } else {
                $_SESSION['alert'] = [
                    "message" => "Admin --- Erreur informations manquant!",
                    "type" => 'alert-danger'
                ];
            }
            header('Location: adminManagerBedPicture&idEditBed=' . $_SESSION['idEditBed']);
        } else {
            $_SESSION['alert'] = [
                "message" => "Accès non-autorisé",
                "type" => 'alert-danger'
            ];
            header('Location: accueil');
        }
    }
    public function adminSpa()
    {
        if (Securite::verifAccessSession()) {
            $data_page = [
                "page_description" => "Editer un service spa",
                "page_title" => "Editer un service spa",
                "spas" => $this->frontManager->getSpas(),
                "view" => "views/main/back/adminSpa.view.php",
                "template" => "views/main/common/__template_front.php"
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


    public function adminEditSpa()
    {
        if (Securite::verifAccessSession() & isset($_GET['id'])) {
            $id = Securite::secureHTML($_GET['id']);
            $spa = $this->frontManager->getSpaById(Securite::secureHTML($id));
            if (!$spa) {
                header('Location: adminaccount');
            }
            if (isset($_POST['btnEditSpa'])) {
                $name = Securite::secureHTML($_POST['name']);
                $time = Securite::secureHTML($_POST['time']);
                $price = Securite::secureHTML($_POST['price']);
                $category = Securite::secureHTML($_POST['category']);
                if (!isset($_POST['active'])) {
                    $active = 0;
                } else {
                    $active = Securite::secureHTML($_POST['active']);
                }

                $this->adminManager->setAdminEditSpa($id, $name, $time, $price, $category, $active);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adminEditSpa&id=' . $id);
                exit();
            }

            $data_page = [
                "spaCategories" => $this->frontManager->getCategorySpa(),
                "spa" => $spa,
                "page_description" => "Editer un service spa",
                "page_title" => "Hôtel Belle-Nuit | Editer un service spa",
                "view" => "views/main/back/adminEditSpa.view.php",
                "template" => "views/main/common/__template_front.php",
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
    public function adminAddSpa()
    {
        if (Securite::verifAccessSession()) {
            if (isset($_POST['btnAddSpa'])) {
                $name = Securite::secureHTML($_POST['name']);
                $time = Securite::secureHTML($_POST['time']);
                $price = Securite::secureHTML($_POST['price']);
                $category = Securite::secureHTML($_POST['category']);
                if (!isset($_POST['active'])) {
                    $active = 0;
                } else {
                    $active = Securite::secureHTML($_POST['active']);
                }

                $this->adminManager->setAdminAddSpa($name, $time, $price, $category, $active);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adminSpa' );
                exit();
            }

            $data_page = [
                "spaCategories" => $this->frontManager->getCategorySpa(),
                "page_description" => "Ajouter un service spa",
                "page_title" => "Hôtel Belle-Nuit | Ajouter un service spa",
                "view" => "views/main/back/adminAddSpa.view.php",
                "template" => "views/main/common/__template_front.php",
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
    public function adminDelSpa()
    {
        if (isset($_GET['id'])) {
            $id = Securite::secureHTML($_GET['id']);
            $delIdSpa = $this->frontManager->getSpaById($id);
            if (!$delIdSpa) {
                header('Location: adminaccount');
            }
            $this->adminManager->deleteSpa($delIdSpa['spa_id']);
            $_SESSION['alert'] = [

                "message" => "Admin --- Le service Spa a été supprimée avec succès.",
                "type" => 'alert-success'
            ];
        } else {
            $_SESSION['alert'] = [
                "message" => "Admin --- Erreur informations manquant!",
                "type" => 'alert-danger'
            ];
        }
        header('Location: adminSpa');
    }

    public function adminRestaurant()
    {
        if (Securite::verifAccessSession()) {
            $data_page = [
                "page_description" => "Editer un produit du restaurant",
                "page_title" => "Editer un produit du restaurant",
                "restaurants" => $this->frontManager->getRestaurants(),
                "view" => "views/main/back/adminRestaurant.view.php",
                "template" => "views/main/common/__template_front.php"
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
    public function adminEditRestaurant()
    {
        if (Securite::verifAccessSession() & isset($_GET['id'])) {
            $id = Securite::secureHTML($_GET['id']);
            $resto = $this->frontManager->getRestaurantById(Securite::secureHTML($id));
            if (!$resto) {
                header('Location: adminaccount');
            }
            if (isset($_POST['btnEditProduct'])) {
                $name = Securite::secureHTML($_POST['name']);
                $price = Securite::secureHTML($_POST['price']);
                $category = Securite::secureHTML($_POST['category']);
                if (!isset($_POST['active'])) {
                    $active = 0;
                } else {
                    $active = Securite::secureHTML($_POST['active']);
                }

                $this->adminManager->setAdminEditResto($id, $name, $price, $category, $active);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adminEditResto&id=' . $id);
                exit();
            }
            $data_page = [
                "restoCategories" => $this->frontManager->getCategoryRestaurant(),
                "resto" => $resto,
                "page_description" => "Editer un produit",
                "page_title" => "Hôtel Belle-Nuit | Editer un produit",
                "view" => "views/main/back/adminEditRestaurant.view.php",
                "template" => "views/main/common/__template_front.php",
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
    public function adminAddResto()
    {
        if (Securite::verifAccessSession()) {
            if (isset($_POST['btnAddProduct'])) {
                $name = Securite::secureHTML($_POST['name']);
                $time = Securite::secureHTML($_POST['time']);
                $price = Securite::secureHTML($_POST['price']);
                $category = Securite::secureHTML($_POST['category']);
                if (!isset($_POST['active'])) {
                    $active = 0;
                } else {
                    $active = Securite::secureHTML($_POST['active']);
                }

                $this->adminManager->setAdminAddResto($name,$price, $category, $active);
                $_SESSION['alert'] = [
                    "message" => 'Les informations ont été modifiés avec succès.',
                    "type" => 'alert-success'
                ];
                header('Location: adminRestaurant' );
                exit();
            }

            $data_page = [
                "restoCategories" => $this->frontManager->getCategoryRestaurant(),
                "page_description" => "Ajouter un produit restaurant",
                "page_title" => "Hôtel Belle-Nuit | Ajouter un produit restaurant",
                "view" => "views/main/back/adminAddRestaurant.view.php",
                "template" => "views/main/common/__template_front.php",
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
    public function adminDelResto()
    {
        if (isset($_GET['id'])) {
            $id = Securite::secureHTML($_GET['id']);
            $delIdResto = $this->frontManager->getRestaurantById($id);
            if (!$delIdResto) {
                header('Location: adminaccount');
            }
            $this->adminManager->deleteResto($delIdResto['product_id']);
            $_SESSION['alert'] = [

                "message" => "Admin --- Le produit du restaurant a été supprimée avec succès.",
                "type" => 'alert-success'
            ];
        } else {
            $_SESSION['alert'] = [
                "message" => "Admin --- Erreur informations manquant!",
                "type" => 'alert-danger'
            ];
        }
        header('Location: adminRestaurant');
    }
}




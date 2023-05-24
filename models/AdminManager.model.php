<?php

require_once("Model.class.php");

class AdminManager extends Model
{
    // Récupère les informations d'un compte via l'id Account.
    public function getProfil($idAccount)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT  *
        FROM `account` 
        WHERE `acc_id`=  :idAccount LIMIT 1');
        $stmt->bindValue(":idAccount", $idAccount);
        $stmt->execute();
        $profil = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $profil;
    }

    // Récupère les informations de tous les comptes.
    public function getProfils()
    {
        $stmt = $this->getBdd()->prepare('
        SELECT  *
        FROM `account`');
        $stmt->execute();
        $profils = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $profils;
    }

    function getBedroomFromId($idBedroom)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT bedroom_id,bedroom_name,bedroom_description,bedroom_bed,bedroom_priceday, category_bedroom.roomcategory_name FROM bedroom
        INNER JOIN category_bedroom ON  bedroom.id_roomcategory = category_bedroom.roomcategory_id
        WHERE bedroom_id = :idBedroom');
        $stmt->bindValue(":idBedroom", $idBedroom);
        $stmt->execute();
        $bedroomById = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomById;
    }

    public function setAdminEditProfil($name, $surname, $address, $city, $country, $active, $box, $codePostal, $phone, $admin, $idAccount)
    {
        $stmt = $this->getBdd()->prepare('
        UPDATE `account` 
        SET `acc_name` = :name, `acc_surname` = :surname, `acc_address` = :address, `acc_addressbox` = :box, `acc_city` = :city, `acc_codepostal` = :codePostal, `acc_id_country` = :country, `acc_phone` = :phone, `acc_admin` = :admin, `acc_active` = :active  
        WHERE `account`.`acc_id` = :idAccount');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':box', $box, PDO::PARAM_INT);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':codePostal', $codePostal, PDO::PARAM_INT);
        $stmt->bindValue(':country', $country, PDO::PARAM_INT);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':admin', $admin, PDO::PARAM_INT);
        $stmt->bindValue(':active', $active, PDO::PARAM_INT);
        $stmt->bindValue(':idAccount', $idAccount, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function setAdminEditBed($name, $description, $typeBed, $category, $price, $idEditBed)
    {
        $stmt = $this->getBdd()->prepare('
        UPDATE `bedroom` SET `bedroom_name` = "' . $name . '", `bedroom_description` = "' . $description . '", `bedroom_bed` = "' . $typeBed . '", `id_roomcategory` = "' . $category . '", `bedroom_priceday` = "' . $price . '"  
        WHERE `bedroom`.`bedroom_id` = "' . $idEditBed . '"');
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addBedPicture($uniqueName)
    {
        $pictureUrl = 'public/assets/images/chambres/uploads/' . $uniqueName;
        $stmt = $this->getBdd()->prepare('INSERT INTO `picture` (`picture_name`, `picture_url`, `picture_description`) VALUES (:picture_name, :picture_url, :picture_description)');
        $stmt->bindParam(':picture_name', $_FILES['image']['name']);
        $stmt->bindParam(':picture_url', $pictureUrl);
        $stmt->bindParam(':picture_description', $_FILES['image']['name']);
        $stmt->execute();

        // requête pour récupérer la dernière valeur d'entrée du tableau de l'id picture
        $stmt = $this->getBdd()->prepare('SELECT `picture_id` FROM `picture` ORDER BY `picture_id` DESC LIMIT 1');
        $stmt->execute();
        $idpicture = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // la requête pour lier la photo avec l'id de la chambre dans la gallery
        $stmt = $this->getBdd()->prepare('INSERT INTO `gallery` (`id_picture`, `id_bedroom`) VALUES (:id_picture, :id_bedroom)');
        $stmt->bindParam(':id_picture', $idpicture[0]['picture_id']);
        $stmt->bindParam(':id_bedroom', $_SESSION['idEditPic']);
        $stmt->execute();
    }
    public function verificationPicture($idPicture, $idBedroom){
        $stmt = $this->getBdd()->prepare('SELECT * FROM `gallery` WHERE `id_picture` = :idPicture AND `id_bedroom` = :idBedroom');
        $stmt->bindParam(':idPicture', $idPicture);
        $stmt->bindParam(':idBedroom', $idBedroom);
        $stmt->execute();
        $verificationPicture = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $verificationPicture;
    }
    public function deleteIDPicture($idPicture, $idBedroom)
    {
        $stmt = $this->getBdd()->prepare('SELECT `picture_url` FROM `picture` WHERE `picture_id` = :idPicture');
        $stmt->bindParam(':idPicture', $idPicture);
        $stmt->execute();
        $urlPicture = $stmt->fetch(PDO::FETCH_ASSOC);
        unlink($urlPicture['picture_url']);

        $stmt = $this->getBdd()->prepare('DELETE FROM `gallery` WHERE `id_picture` = :idPicture AND `id_bedroom` = :idBedroom');
        $stmt->bindParam(':idPicture', $idPicture);
        $stmt->bindParam(':idBedroom', $idBedroom);
        $stmt->execute();

        $stmt = $this->getBdd()->prepare('DELETE FROM `picture` WHERE `picture_id` = :idPicture');
        $stmt->bindParam(':idPicture', $idPicture);
        $stmt->execute();
    }

    public function deleteIdBed($idBedroom)
    {
        // Supprime les images liées à la chambre
        $stmt = $this->getBdd()->prepare('DELETE FROM `gallery` WHERE `id_bedroom` = :idBedroom');
        $stmt->bindParam(':idBedroom', $idBedroom);
        $stmt->execute();

        // Supprime la chambre elle-même
        $stmt = $this->getBdd()->prepare('DELETE FROM `bedroom` WHERE `bedroom_id` = :idBedroom');
        $stmt->bindParam(':idBedroom', $idBedroom);
        $stmt->execute();
    }

    public function addBed($name,$description,$typeBed,$category,$price){
        $stmt = $this->getBdd()->prepare('INSERT INTO `bedroom` (`bedroom_name`, `bedroom_description`, `bedroom_bed`, `id_roomcategory`, `bedroom_priceday`) VALUES (:name, :description, :typeBed, :category, :price)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':typeBed', $typeBed);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    public function setAdminEditSpa($id, $name, $time, $price, $category, $active) {
        $stmt = $this->getBdd()->prepare('UPDATE spa SET spa_title = :name, spa_time = :time, spa_price = :price, id_spacategory = :category, spa_active = :active WHERE spa_id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function setAdminAddSpa($name, $time, $price, $category, $active) {
        $stmt = $this->getBdd()->prepare('INSERT INTO spa (spa_title, spa_time, spa_price, id_spacategory, spa_active) VALUES (:name, :time, :price, :category, :active)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':active', $active);
        $stmt->execute();
    }
    public function deleteSpa($delIdSpa){
        $stmt = $this->getBdd()->prepare('DELETE FROM `spa` WHERE `spa_id` = :spaId');
        $stmt->bindParam(':spaId', $delIdSpa);
        $stmt->execute();
    }
    public function setAdminEditResto($id, $name,$price, $category, $active) {
        $stmt = $this->getBdd()->prepare('UPDATE restaurant SET product_title = :name, product_price = :price, id_restocategory = :category, product_active = :active WHERE product_id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function setAdminAddResto($name, $price, $category, $active) {
        $stmt = $this->getBdd()->prepare('INSERT INTO restaurant (product_title, product_price, id_restocategory, product_active) VALUES (:name, :price, :category, :active)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function deleteResto($delIdResto){
        $stmt = $this->getBdd()->prepare('DELETE FROM `restaurant` WHERE `product_id` = :productId');
        $stmt->bindParam(':productId', $delIdResto);
        $stmt->execute();
    }
    public function filterBookings($date_begin, $date_end, $search_name, $show_cancelled, $show_validated) {
        // Initialisation des conditions
        $conditions = [];
        $params = [];

        // Ajout des conditions en fonction des paramètres
        if ($date_begin) {
            $conditions[] = 'booking_date_end >= ?';
            $params[] = $date_begin;
        }
        if ($date_end) {
            $conditions[] = 'booking_date_begin <= ?';
            $params[] = $date_end;
        }
        if ($search_name) {
            $conditions[] = '(cus_name LIKE ? OR cus_surname LIKE ?)';
            $params[] = '%'.$search_name.'%';
            $params[] = '%'.$search_name.'%';
        }
        if ($show_cancelled) {
            $conditions[] = 'booking_cancelation = 1';
        }
        if ($show_validated) {
            $conditions[] = 'booking_validation = 1';
        }

        // Construction de la requête SQL
        $sql = 'SELECT bookings.booking_id, account.acc_name, account.acc_surname, bedroom.bedroom_name, bookings.booking_date_begin, bookings.booking_date_end, bookings.booking_price_total, bookings.booking_validation, bookings.booking_cancelation 
        FROM bookings 
        INNER JOIN bedroom ON bookings.id_bedroom = bedroom.bedroom_id 
        INNER JOIN account ON bookings.id_acc = account.acc_id';
        if ($conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        // Préparation et exécution de la requête
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->execute($params);

        // Récupération des résultats
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function adminReservation(){
        $stmt = $this->getBdd()->prepare('SELECT bookings.booking_id, account.acc_name, account.acc_surname, bedroom.bedroom_name, bookings.booking_date_begin, bookings.booking_date_end, bookings.booking_price_total, bookings.booking_validation, bookings.booking_cancelation 
    FROM bookings 
    INNER JOIN bedroom ON bookings.id_bedroom = bedroom.bedroom_id 
    INNER JOIN account ON bookings.id_acc = account.acc_id;');
        $stmt->execute();
        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reservation;
    }
    public function getReservationById($id)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT bookings.*, bedroom.bedroom_name, services_bedroom.service_name 
        FROM bookings 
        LEFT JOIN bedroom ON bookings.id_bedroom = bedroom.bedroom_id 
        LEFT JOIN lnk_services_reservation ON bookings.booking_id = lnk_services_reservation.id_booking 
        LEFT JOIN services_bedroom ON lnk_services_reservation.id_service = services_bedroom.service_id 
        WHERE bookings.booking_id = :booking_id');

        // Lier l'ID de réservation à la requête
        $stmt->bindValue(':booking_id', $id);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer les détails de réservation
        $reservationDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermer le curseur
        $stmt->closeCursor();

        // Construire un tableau pour stocker les services
        $services = array();

        // Parcourir les résultats et ajouter les services au tableau
        foreach ($reservationDetails as $reservation) {
            $service = array(
                'service_name' => $reservation['service_name']
            );
            $services[] = $service;
        }

        // Ajouter le tableau des services à l'ensemble des détails de réservation
        $reservationDetails[0]['services'] = $services;

        // Retourner les détails de réservation mis à jour
        return $reservationDetails[0];
    }

}
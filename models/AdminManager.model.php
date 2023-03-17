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

    public function setAdminEditProfil($name, $surname, $address, $city, $country, $active, $admin, $idAccount)
    {
        $stmt = $this->getBdd()->prepare('
        UPDATE `account` 
        SET `acc_name` = "' . $name . '", `acc_surname` = "' . $surname . '", `acc_address` = "' . $address . '", `acc_city` = "' . $city . '", `acc_id_country` = "' . $country . '" , `acc_admin` = "' . $admin . '" , `acc_active` = "' . $active . '"  
        WHERE `account`.`acc_id` = "' . $idAccount . '"');
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

}
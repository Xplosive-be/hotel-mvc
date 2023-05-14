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

}
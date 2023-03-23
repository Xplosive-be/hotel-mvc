<?php
require_once("Model.class.php");

class FrontManager extends Model
{

    public function getAllBedrooms()
    {
        $stmt = $this->getBdd()->prepare('
        SELECT bedroom_id,bedroom_name,bedroom_description,bedroom_bed,bedroom_priceday, category_bedroom.roomcategory_name FROM bedroom
        INNER JOIN category_bedroom ON  bedroom.id_roomcategory = category_bedroom.roomcategory_id');
        $stmt->execute();
        $bedrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedrooms;
    }
    public function getAllBedroomsByAvailable($dateBegin,$dateEnd)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT * FROM bedroom WHERE bedroom_id NOT IN ( SELECT id_bedroom FROM reservation WHERE date_begin <= :dateBegin AND date_end >= :dateEnd )');
        $stmt->bindValue(':dateBegin', $dateBegin);
        $stmt->bindValue(':dateEnd', $dateEnd);
        $stmt->execute();
        $bedroomsAvailable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomsAvailable;
    }

    public function getImagesBedroom($idBedroom)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT p.picture_id,picture_name,picture_url,picture_description
        FROM picture p 
        INNER JOIN gallery g on p.picture_id = g.id_picture
        INNER JOIN bedroom b on b.bedroom_id = g.id_bedroom
        WHERE b.bedroom_id = :idBedroom;');
        $stmt->bindValue(':idBedroom', $idBedroom);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $images;
    }
    public function getCountryList()
    {
        $stmt = $this->getBdd()->prepare('
        SELECT country_id, country_fr 
        FROM country');
        $stmt->execute();
        $countrys = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $countrys;
    }
    public function getCategoryBedList(){
        $stmt = $this->getBdd()->prepare('SELECT * FROM category_bedroom');
        $stmt->execute();
        $getCategoryBedList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getCategoryBedList;
    }

}


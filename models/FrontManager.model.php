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

    public function getCategorySpa(){
        $stmt = $this->getBdd()->prepare('SELECT spacategory_name FROM category_spa');
        $stmt->execute();
        $categorySpaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $categorySpaList;
    }

    public function getSpaByIdCategory($category){
        $stmt = $this->getBdd()->prepare('SELECT c.spacategory_id, s.spa_title, s.spa_time, s.spa_price 
                                  FROM category_spa c 
                                  LEFT JOIN spa s ON c.spacategory_id = s.id_spacategory 
                                  WHERE s.spa_active = 1 AND s.id_spacategory = ' . $category . '
                                  ORDER BY s.id_spacategory');
        $stmt->execute();
        $getSpaById = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getSpaById;
}



}


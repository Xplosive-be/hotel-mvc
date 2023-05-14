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
    public function getCountryById($id)
    {
        $stmt = $this->getBdd()->prepare('SELECT country_fr FROM country  WHERE country_id = :idCountry');
        $stmt->bindParam(':idCountry', $id, PDO::PARAM_INT);
        $stmt->execute();
        $country = $stmt->fetchColumn();
        $stmt->closeCursor();
        return $country;
    }
    public function getCategoryBedList(){
        $stmt = $this->getBdd()->prepare('SELECT * FROM category_bedroom');
        $stmt->execute();
        $getCategoryBedList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getCategoryBedList;
    }

    public function getCategorySpa(){
        $stmt = $this->getBdd()->prepare('SELECT * FROM category_spa');
        $stmt->execute();
        $categorySpaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $categorySpaList;
    }

    public function getSpaByIdCategory($category){
        $stmt = $this->getBdd()->prepare('SELECT c.spacategory_id, s.spa_title, s.spa_time, s.spa_price 
                              FROM category_spa c 
                              LEFT JOIN spa s ON c.spacategory_id = s.id_spacategory 
                              WHERE s.spa_active = 1 AND s.id_spacategory = :category
                              ORDER BY s.id_spacategory');
        $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        $stmt->execute();
        $getSpaById = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getSpaById;
    }

    public function getSpas() {
        $stmt = $this->getBdd()->prepare('SELECT s.spa_id,s.spa_title, s.spa_time, s.spa_price, s.spa_active, c.spacategory_name
                                        FROM spa s
                                        INNER JOIN category_spa c ON s.id_spacategory = c.spacategory_id
                                        ORDER BY s.spa_id;');
        $stmt->execute();
        $getSpas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getSpas;
    }

    public function getSpaById($idSpa) {
        $stmt = $this->getBdd()->prepare('SELECT s.spa_id, s.spa_title, s.spa_time, s.spa_price, s.spa_active, s.id_spacategory, c.spacategory_name
                                      FROM spa s
                                      INNER JOIN category_spa c ON s.id_spacategory = c.spacategory_id
                                      WHERE s.spa_id = :idSpa
                                      ORDER BY s.spa_id');
        $stmt->bindParam(':idSpa', $idSpa, PDO::PARAM_INT);
        $stmt->execute();
        $getSpas = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getSpas;
    }

    public function getCategoryRestaurant(){
        $stmt = $this->getBdd()->prepare('SELECT * FROM category_restaurant');
        $stmt->execute();
        $categoryRestaurantList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $categoryRestaurantList;
    }
    public function getRestaurantByIdCategory($category){
        $stmt = $this->getBdd()->prepare('SELECT c.restocategory_id, r.product_title, r.product_price 
                              FROM category_restaurant c 
                              LEFT JOIN restaurant r ON c.restocategory_id = r.id_restocategory 
                              WHERE r.product_active = 1 AND r.id_restocategory = :category
                              ORDER BY r.id_restocategory');
        $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        $stmt->execute();
        $getSpaById = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getSpaById;
    }
    public function getRestaurants() {
        $stmt = $this->getBdd()->prepare('SELECT r.product_id,r.product_title, r.product_price, r.product_active, c.restocategory_name
                                        FROM restaurant r
                                        INNER JOIN category_restaurant c ON r.id_restocategory = c.restocategory_id
                                        ORDER BY r.id_restocategory;');
        $stmt->execute();
        $getRestaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getRestaurants;
    }
    public function getRestaurantById($idResto) {
        $stmt = $this->getBdd()->prepare('SELECT r.product_id,r.product_title, r.product_price, r.product_active, c.restocategory_name, r.id_restocategory
                                      FROM restaurant r
                                      INNER JOIN category_restaurant c ON r.id_restocategory = c.restocategory_id
                                      WHERE r.product_id = :idResto');
        $stmt->bindParam(':idResto', $idResto, PDO::PARAM_INT);
        $stmt->execute();
        $getProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $getProduct;
    }
}


<?php

require_once("Model.class.php");
class BookingManager extends Model
{
    public function getAllBedroomsByAvailable($dateBegin,$dateEnd)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT * FROM bedroom WHERE bedroom_id NOT IN ( SELECT id_bedroom FROM bookings WHERE booking_date_begin <= :dateBegin AND booking_date_end >= :dateEnd )');
        $stmt->bindValue(':dateBegin', $dateBegin);
        $stmt->bindValue(':dateEnd', $dateEnd);
        $stmt->execute();
        $bedroomsAvailable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomsAvailable;
    }
    public function getAllBedroomsByNotAvailable($dateBegin,$dateEnd)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT * FROM bedroom WHERE bedroom_id IN ( SELECT id_bedroom FROM bookings WHERE booking_date_begin <= :dateBegin AND booking_date_end >= :dateEnd )');
        $stmt->bindValue(':dateBegin', $dateBegin);
        $stmt->bindValue(':dateEnd', $dateEnd);
        $stmt->execute();
        $bedroomsNotAvailable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomsNotAvailable;
    }

    public function getAllServicesBedroom()
    {
        $stmt = $this->getBdd()->prepare('SELECT * FROM `services_bedroom` ORDER BY `services_bedroom`.`service_id` ASC');
        $stmt->execute();
        $bedroomServices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomServices;
    }

    public function checkBedroomAvailableById($dateBegin , $dateEnd, $idBedroom){
        $stmt = $this->getBdd()->prepare('SELECT *
        FROM bedroom
        WHERE bedroom_id = :bedroomId
        AND bedroom_id NOT IN (
            SELECT id_bedroom
            FROM bookings
            WHERE (
                (booking_date_begin <= :dateEnd AND booking_date_end >= :dateEnd)
                OR (booking_date_begin <= :dateBegin AND booking_date_end >= :dateBegin)
                OR (booking_date_begin >= :dateBegin AND booking_date_end <= :dateEnd)
            ))');
        $stmt->bindValue(':dateBegin', $dateBegin);
        $stmt->bindValue(':dateEnd', $dateEnd);
        $stmt->bindValue(':bedroomId', $idBedroom);
        $stmt->execute();
        $bedroomAvailable = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomAvailable;

    }
}

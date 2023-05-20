<?php

require_once("Model.class.php");
class BookingManager extends Model
{
    public function getAllBedroomsByAvailable($dateBegin, $dateEnd)
    {
        $stmt = $this->getBdd()->prepare('
    SELECT * FROM bedroom WHERE bedroom_id NOT IN (
        SELECT id_bedroom FROM bookings WHERE (
            (booking_date_begin <= :dateEnd AND booking_date_end >= :dateBegin)
            OR (booking_date_begin <= :dateBegin AND booking_date_end >= :dateEnd)
            OR (booking_date_begin >= :dateBegin AND booking_date_end <= :dateEnd)
        )
    )');
        $stmt->bindValue(':dateBegin', $dateBegin);
        $stmt->bindValue(':dateEnd', $dateEnd);
        $stmt->execute();
        $bedroomsAvailable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bedroomsAvailable;
    }

    public function getAllBedroomsByNotAvailable($dateBegin, $dateEnd)
    {
        $stmt = $this->getBdd()->prepare('
    SELECT * FROM bedroom WHERE bedroom_id IN (
        SELECT id_bedroom FROM bookings WHERE (
            (booking_date_begin <= :dateEnd AND booking_date_end >= :dateBegin)
            OR (booking_date_begin <= :dateBegin AND booking_date_end >= :dateEnd)
            OR (booking_date_begin >= :dateBegin AND booking_date_end <= :dateEnd)
        )
    )');
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
    public function getServicesByIds($ids) {
        // Préparez la requête SQL en utilisant des paramètres nommés
        $inQuery = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT `service_name`,`service_price`  FROM services_bedroom WHERE service_id IN ($inQuery)";
        $stmt = $this->getBdd()->prepare($sql);

        // Exécutez la requête en passant le tableau d'ID comme paramètres
        $stmt->execute($ids);

        return $stmt->fetchAll();
    }

    public function getServiceById($id){
        $stmt = $this->getBdd()->prepare('SELECT service_id, service_name, service_price FROM services_bedroom WHERE service_id = :service_id');
        $stmt->bindParam(':service_id', $id);
        $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        return $service;
    }
    public function addBooking()
    {
        $bdd = $this->getBdd();
        $bdd->beginTransaction();
        try {
            // Insert the booking information
            $stmt = $bdd->prepare('INSERT INTO bookings (id_bedroom, id_acc, cus_gender, booking_date_begin, booking_arrival_time, booking_date_end, booking_price_total, booking_comments, cus_name, cus_surname, cus_address, cus_addressbox, cus_city, cus_codepostal, cus_id_country, cus_phone, cus_email) VALUES (:id_bedroom, :id_acc, :cus_gender, :booking_date_begin, :booking_arrival_time, :booking_date_end, :booking_price_total, :booking_comments, :cus_name, :cus_surname, :cus_address, :cus_addressbox, :cus_city, :cus_codepostal, :cus_id_country, :cus_phone, :cus_email)');
            $stmt->execute(array(
                ':id_bedroom' => $_SESSION['booking']['bedroom_id'],
                ':id_acc' => $_SESSION['idAccount'],
                ':cus_gender' => $_SESSION['booking']['customers']['gender'],
                ':booking_date_begin' => $_SESSION['booking']['dateBegin'],
                ':booking_arrival_time' => $_SESSION['booking']['arrivalTime'],
                ':booking_date_end' => $_SESSION['booking']['dateEnd'],
                ':booking_price_total' => $_SESSION['booking']['priceTotal'],
                ':booking_comments' => $_SESSION['booking']['comments'],
                ':cus_name' => $_SESSION['booking']['customers']['name'],
                ':cus_surname' => $_SESSION['booking']['customers']['surname'],
                ':cus_address' => $_SESSION['booking']['customers']['address'],
                ':cus_addressbox' => !empty($_SESSION['booking']['customers']['box']) ? $_SESSION['booking']['customers']['box'] : null,
                ':cus_city' => $_SESSION['booking']['customers']['city'],
                ':cus_codepostal' => $_SESSION['booking']['customers']['postalCode'],
                ':cus_id_country' => $_SESSION['booking']['customers']['country'],
                ':cus_phone' => $_SESSION['booking']['customers']['phone'],
                ':cus_email' => $_SESSION['booking']['customers']['email'],
            ));
            $booking_id = $bdd->lastInsertId();

            // Insert the linked services
            if (!empty($booking['services'])) {
                foreach ($booking['services'] as $service) {
                    $stmt = $bdd->prepare('INSERT INTO lnk_services_reservation (id_booking, id_service, quantity) VALUES (:id_booking, :id_service, :quantity)');
                    $stmt->execute(array(
                        ':id_booking' => $booking_id,
                        ':id_service' => $service['id'],
                        ':quantity' => $service['quantity'],
                    ));
                }
            }

            $bdd->commit();

            return $booking_id;
        } catch (Exception $e) {
            $bdd->rollback();
            throw $e;
        }
    }

    public function lastIdReservation($id) {
        $stmt = $this->getBdd()->prepare('SELECT booking_id FROM `bookings`  WHERE `id_acc` = :id_acc ORDER BY `bookings`.`booking_id` ASC');
        $stmt->bindParam(':id_acc', $id);
        $stmt->execute();
        $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
        return $lastId['booking_id'];
    }

}

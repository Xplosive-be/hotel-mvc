<?php

require_once("Model.class.php");
class BackManager extends Model
{
    public function getLoginAccount($login)
    {
        $stmt = $this->getBdd()->prepare('
        SELECT * 
        FROM account 
        WHERE acc_email = :mail');
        $stmt->bindValue(':mail', $login, PDO::PARAM_STR);
        $stmt->execute();
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $account;
    }
    public function setApplyAccount($name,$surname,$address,$city,$country,$email,$password,$codeactivation){
        $stmt = $this->getBdd()->prepare('
        SELECT count(*) as numberEmail 
        FROM account 
        WHERE acc_email = :mail');
        $stmt->bindValue(':mail', $email, PDO::PARAM_STR);
        $stmt->execute();
        // Boucle pour savoir si le
        while($email_verification = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($email_verification['numberEmail'] != 0) {
                $stmt->closeCursor();
                return  false;
            }
        $stmt = $this->getBdd()->prepare('
        INSERT `account` SET `acc_name` = "'. $name . '", `acc_surname` = "' . $surname . '", `acc_address` = "' . $address . '", `acc_city` = "' . $city . '", `acc_id_country` = "' . $country . '", `acc_email` = "' . $email . '", `acc_password` = "' . $password . '", `acc_code_activation` = "' . $codeactivation .'", `acc_admin` = "0", `acc_active` = "0"');
        $stmt->execute();
        $stmt->closeCursor();
        return true;
        }
    }

    public function getAccountCodeActivation($idAccount) {
        $stmt = $this->getBdd()->prepare('
        SELECT  `acc_code_activation`, `acc_active`
        FROM `account` 
        WHERE `acc_id`=  :idAccount LIMIT 1');
        $stmt->bindValue(":idAccount", $idAccount);
        $stmt->execute();
        $InfoActivation = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $InfoActivation;
    }
    public function setAccountActivation($idAccount) {
        $stmt = $this->getBdd()->prepare('
        UPDATE `account` 
        SET `acc_active`= 1 
        WHERE `acc_id` = :idAccount LIMIT 1');
        $stmt->bindValue(":idAccount", $idAccount);
        $stmt->execute();
        $stmt->closeCursor();
    }
    public function setEditProfil($name,$surname,$address,$city,$country,$idAccount){
        $stmt = $this->getBdd()->prepare('
        UPDATE `account` SET `acc_name` = "'. $name . '", `acc_surname` = "' . $surname . '", `acc_address` = "' . $address . '", `acc_city` = "' . $city . '", `acc_id_country` = "' . $country . '" 
        WHERE `account`.`acc_id` = "'. $idAccount . '"');
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }
}


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
    public function setApplyAccount($name,$surname,$address,$box,$city,$codePostal,$country,$phone,$email,$password,$codeactivation){
        $stmt = $this->getBdd()->prepare('SELECT count(*) as numberEmail FROM account WHERE acc_email = :mail');
        $stmt->bindValue(':mail', $email, PDO::PARAM_STR);
        $stmt->execute();

        while($email_verification = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($email_verification['numberEmail'] != 0) {
                $stmt->closeCursor();
                return  false;
            }
        }

        $stmt = $this->getBdd()->prepare('INSERT INTO account (acc_name, acc_surname, acc_address, acc_addressbox, acc_city, acc_codepostal, acc_id_country, acc_phone, acc_email, acc_password, acc_code_activation, acc_admin, acc_active) VALUES (:name, :surname, :address, :box, :city, :codepostal, :country, :phone, :email, :password, :codeactivation, 0, 0)');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':box', $box, PDO::PARAM_INT);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':codepostal', $codePostal, PDO::PARAM_INT);
        $stmt->bindValue(':country', $country, PDO::PARAM_INT);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':codeactivation', $codeactivation, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
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
    public function setEditProfil($name, $surname, $address, $box, $city, $codePostal, $country, $phone, $idAccount){
        $stmt = $this->getBdd()->prepare('
        UPDATE `account` 
        SET `acc_name` = :name, `acc_surname` = :surname, `acc_address` = :address, `acc_addressbox` = :box, 
            `acc_city` = :city, `acc_codepostal` = :codePostal, `acc_id_country` = :country, `acc_phone` = :phone
        WHERE `acc_id` = :idAccount
    ');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':box', $box, PDO::PARAM_INT);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':codePostal', $codePostal, PDO::PARAM_INT);
        $stmt->bindValue(':country', $country, PDO::PARAM_INT);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':idAccount', $idAccount, PDO::PARAM_INT);

        $stmt->execute();
        $stmt->closeCursor();

        return true;
    }

}


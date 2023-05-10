<?php

class Securite {
    public static function secureHTML($string){
        return htmlentities($string);
    }

    public static function EncryptPassword($password){
        $SALT = 'H@nk@4';
        $PEPPER = 'S@m!r';
        return hash('sha512',$SALT.$password.$PEPPER);
    }
    public static function verifAccessSession(){
        return (isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin'] === 1);
    }
    public  static function verifConnectSession(){
        return ( $_SESSION['online'] === 1 && !empty($_SESSION['online']));

    }
}
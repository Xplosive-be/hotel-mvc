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
    public static function genereCookiePassword(){
        $ticket = session_id().microtime().rand(0,9999999);
        $ticket = hash("sha512", $ticket);
        setcookie(COOKIE_PROTECT, $ticket, time() + (60 * 20));
        $_SESSION[COOKIE_PROTECT] = $ticket;
    }

    public static function verificationCookie(){
        if(isset($_SESSION[COOKIE_PROTECT]) && $_COOKIE[COOKIE_PROTECT] === $_SESSION[COOKIE_PROTECT]){
            Securite::genereCookiePassword();
            return true;
        } else {
            session_destroy();
            throw new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public static function verifAccessSession(){
        return (isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin'] === 1);
    }
    public  static function verifConnectSession(){
        return ( $_SESSION['online'] === 1 && !empty($_SESSION['online']));

    }

    public static function verificationAccess(){
        return (self::verifAccessSession() && self::verificationCookie());
    }
}
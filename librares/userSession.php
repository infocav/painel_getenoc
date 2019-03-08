<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userSession
 *
 * @author cicero
 */
class userSession {

    //put your code here

    private static $login;
    private static $passwd;
    private static $perssimao;
    private static $sessionId;

    static function getSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        self::setLogin($_SESSION['login']);
        self::setPasswd($_SESSION['password']);
        self::setSessionId(session_id());
    }

    static function getSessionId() {
        return self::$sessionId;
    }

    static function setSessionId($sessionId) {
        self::$sessionId = $sessionId;
    }

    static function deslogar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();
        // unset($_SESSION['login']);
        // unset($_SESSION['password']);
    }

    static function getLogin() {

        self::getSession();

        return self::$login;
    }

    static function getPasswd() {
        self::getSession();

        return self::$passwd;
    }

    static function setLogin($login) {
        $_SESSION['login'] = $login;
        self::$login = $login;
    }

    static function setPasswd($passwd) {
        $_SESSION['password'] = $passwd;

        self::$passwd = $passwd;
    }

    static function getPerssimao() {
        return self::$perssimao;
    }

    static function setPerssimao($perssimao) {
        self::$perssimao = $perssimao;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of postgressdb
 *
 * @author cicero
 */
class postgressdb {

    //put your code here

    private $hostname;
    private $username;
    private $passwd;
    private $dbname;
    private $db;

    function __construct() {
        $this->hostname = POSTGRES_HOST;
        $this->username = POSTGRES_USER;
        $this->passwd = POSTGRES_PASSWD;
        $this->dbname = POSTGRES_DBNAME;
        
        
    }

    function conecta() {
        $this->db = pg_connect("host=" . $this->hostname . " dbname=" . $this->dbname . " user=" . $this->username . " password=" . $this->passwd)
                or die('Could not connect: ' . pg_last_error());
        
        return $this->db;
        
    }   
    

    function desconecta() {
        // Closing connection
        pg_close($this->db);
    }
    
    function getHostname() {
        return $this->hostname;
    }

    function getUsername() {
        return $this->username;
    }

    function getPasswd() {
        return $this->passwd;
    }

    function getDbname() {
        return $this->dbname;
    }

    function getDb() {
        return $this->db;
    }

    function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    function setDbname($dbname) {
        $this->dbname = $dbname;
    }

    function setDb($db) {
        $this->db = $db;
    }


    

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente
 * Carregará todas as informações necessárias para cadastro em todas as bases de dados
 * @author cicero
 */
class cliente {
    //put your code here
    private $uid;
    private $givenName;
    private $surname;
    private $password;
    private $email;
    
    function getUid() {
        return $this->uid;
    }

    function getGivenName() {
        return $this->givenName;
    }

    function getSurname() {
        return $this->surname;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

    function setGivenName($givenName) {
        $this->givenName = $givenName;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }


    
    
}

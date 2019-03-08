<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ldapModel
 *
 * @author cicero
 */
class ldapModel {
    //put your code here
    private $host;
    private $port;
    private $userCN;
    private $passCN;
    private $ds;
    private $bind;
    
    function getBind() {
        return $this->bind;
    }

    function setBind($bind) {
        $this->bind = $bind;
    }

        
    function getDs() {
        return $this->ds;
    }

    function setDs($ds) {
        $this->ds = $ds;
    }

        
    function getHost() {
        return $this->host;
    }

    function getPort() {
        return $this->port;
    }

    function getUserCN() {
        return $this->userCN;
    }

    function getPassCN() {
        return $this->passCN;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function setUserCN($userCN) {
        $this->userCN = $userCN;
    }

    function setPassCN($passCN) {
        $this->passCN = $passCN;
    }


}

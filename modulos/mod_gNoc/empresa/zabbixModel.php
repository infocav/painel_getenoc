<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zabbixModel
 *
 * @author cicero
 */
class zabbixModel {

    //put your code here
    private $empresa_id;
    private $zabbix_id;
    private $zabbixName; //nome_conteiner
    private $zabbixRede;
    private $zabbixIp;
    private $zabbixPorta;
    private $zabbixDb;
    private $zabbixIpDb;
    private $zabbxUser;
    private $zabbixPass;
    private $st_db_zbx;
    private $st_user_db_zbx;
    private $st_perm_user_db_zbx;
    private $st_perm_user_table_db_zbx;
    private $st_docker_zbx;
    private $st_front_zbx;
    private $st_user_ldap_zabbix;

    function __construct() {
        $this->st_db_zbx = 'N';
        $this->st_user_db_zbx = 'N';
        $this->st_perm_user_db_zbx = 'N';
        $this->st_perm_user_table_db_zbx = 'N';
        $this->st_docker_zbx = 'N';
        $this->st_front_zbx = 'N';
        $this->st_user_ldap_zabbix = 'N';
    }

    function getJson() {
        $json .= '{ "empresa_id":"' . $this->empresa_id . '",';
        $json .= '"zabbix_id":"' . $this->zabbix_id . '",';
        $json .= '"zabbixName":"' . $this->zabbixName . '",';
        $json .= '"zabbixRede":"' . $this->zabbixRede . '",';
        $json .= '"zabbixIp":"' . $this->zabbixIp . '",';
        $json .= '"zabbixPorta":"' . $this->zabbixPorta . '",';
        $json .= '"zabbixDb":"' . $this->zabbixDb . '",';
        $json .= '"zabbixIpDb":"' . $this->zabbixIpDb . '",';
        $json .= '"zabbxUser":"' . $this->zabbxUser . '",';
        $json .= '"zabbixPass":"' . $this->zabbixPass . '",';
        $json .= '"st_db_zbx":"' . $this->st_db_zbx . '",';
        $json .= '"st_user_db_zbx":"' . $this->st_user_db_zbx . '",';
        $json .= '"st_perm_user_db_zbx":"' . $this->st_perm_user_db_zbx . '",';
        $json .= '"st_perm_user_table_db_zbx":"' . $this->st_perm_user_table_db_zbx . '",';
        $json .= '"st_docker_zbx":"' . $this->st_docker_zbx . '",';
        $json .= '"st_user_ldap_zabbix":"'.$this->st_user_ldap_zabbix . '",';
        $json .= '"st_front_zbx":"' . $this->st_front_zbx . '" }';

        return $json;
    }

    function getInsertPostgres() {

        return Array('id_empresa' => (int) $this->empresa_id,
            'zbx_db_name' => $this->zabbixDb,
            'zbx_name' => $this->zabbixName,
            'zbx_rede' => $this->zabbixRede,
            'zbx_ip' => $this->zabbixIp,
            // 'zbx_porta' => $this->zabbixPorta,
            'zbx_ip_db' => $this->zabbixIpDb,
            'zbx_user' => $this->zabbxUser,
            'zbx_pass' => $this->zabbixPass,
            'st_db_zbx' => $this->st_db_zbx,
            'st_user_db_zbx' => $this->st_user_db_zbx,
            'st_perm_user_db_zbx' => $this->st_perm_user_db_zbx,
            'st_perm_user_table_db_zbx' => $this->st_perm_user_table_db_zbx,
            'st_docker_zbx' => $this->st_docker_zbx,
            'st_front_zbx' => $this->st_front_zbx,
            'st_user_ldap_zabbix' => $this->st_user_ldap_zabbix
        );
    }

    function getZabbixName() {
        return $this->zabbixName;
    }

    function getZabbixRede() {
        return $this->zabbixRede;
    }

    function getZabbixIp() {
        return $this->zabbixIp;
    }

    function getZabbixPorta() {
        return $this->zabbixPorta;
    }

    function getZabbixDb() {
        return $this->zabbixDb;
    }

    function getZabbixIpDb() {
        return $this->zabbixIpDb;
    }

    function getZabbxUser() {
        return $this->zabbxUser;
    }

    function getZabbixPass() {
        return $this->zabbixPass;
    }

    function setZabbixName($zabbixName) {
        $this->zabbixName = $zabbixName;
    }

    function setZabbixRede($zabbixRede) {
        $this->zabbixRede = $zabbixRede;
    }

    function setZabbixIp($zabbixIp) {
        $this->zabbixIp = $zabbixIp;
    }

    function setZabbixPorta($zabbixPorta) {
        $this->zabbixPorta = $zabbixPorta;
    }

    function setZabbixDb($zabbixDb) {
        $this->zabbixDb = $zabbixDb;
    }

    function setZabbixIpDb($zabbixIpDb) {
        $this->zabbixIpDb = $zabbixIpDb;
    }

    function setZabbxUser($zabbxUser) {
        $this->zabbxUser = $zabbxUser;
    }

    function setZabbixPass($zabbixPass) {
        $this->zabbixPass = $zabbixPass;
    }

    function getEmpresa_id() {
        return $this->empresa_id;
    }

    function getZabbix_id() {
        return $this->zabbix_id;
    }

    function setEmpresa_id($empresa_id) {
        $this->empresa_id = $empresa_id;
    }

    function setZabbix_id($zabbix_id) {
        $this->zabbix_id = $zabbix_id;
    }

    function getSt_db_zbx() {
        return $this->st_db_zbx;
    }

    function getSt_user_db_zbx() {
        return $this->st_user_db_zbx;
    }

    function getSt_perm_user_db_zbx() {
        return $this->st_perm_user_db_zbx;
    }

    function getSt_perm_user_table_db_zbx() {
        return $this->st_perm_user_table_db_zbx;
    }

    function getSt_docker_zbx() {
        return $this->st_docker_zbx;
    }

    function getSt_front_zbx() {
        return $this->st_front_zbx;
    }

    function setSt_db_zbx($st_db_zbx) {
        $this->st_db_zbx = $st_db_zbx;
    }

    function setSt_user_db_zbx($st_user_db_zbx) {
        $this->st_user_db_zbx = $st_user_db_zbx;
    }

    function setSt_perm_user_db_zbx($st_perm_user_db_zbx) {
        $this->st_perm_user_db_zbx = $st_perm_user_db_zbx;
    }

    function setSt_perm_user_table_db_zbx($st_perm_user_table_db_zbx) {
        $this->st_perm_user_table_db_zbx = $st_perm_user_table_db_zbx;
    }

    function setSt_docker_zbx($st_docker_zbx) {
        $this->st_docker_zbx = $st_docker_zbx;
    }

    function setSt_front_zbx($st_front_zbx) {
        $this->st_front_zbx = $st_front_zbx;
    }
    
    function getSt_user_ldap_zabbix() {
        return $this->st_user_ldap_zabbix;
    }

    function setSt_user_ldap_zabbix($st_user_ldap_zabbix) {
        $this->st_user_ldap_zabbix = $st_user_ldap_zabbix;
    }

    


}

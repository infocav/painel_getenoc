<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioModel
 *
 * @author cicero
 */
class usuarioModel {

    //put your code here
    private $id;
    private $id_empresa;
    private $username;
    private $surname;
    private $givenName;
    private $senha;
    private $tipo_usuario;
    private $email;
    private $st_ldap;
    private $st_zabbix;
    private $st_grafana;

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getId() {
        return $this->id;
    }

    function getSurname() {
        return $this->surname;
    }

    function getGivenName() {
        return $this->givenName;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setGivenName($givenName) {
        $this->givenName = $givenName;
    }

    function getUsername() {
        return $this->username;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTipo_usuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

    function getId_empresa() {
        return $this->id_empresa;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    function getInsertPostgres() {

        return Array('id_empresa' => (int) $this->id_empresa,
            'tipo' => $this->tipo_usuario,
            'usuario' => $this->username,
            'senha' => $this->senha,
            'surname' => $this->surname,
            'givenName' => $this->givenName,
            'email' => $this->email,            
            'st_ldap' => $this->st_ldap,
            'st_zabbix' => $this->st_zabbix,
            'st_grafana' => $this->st_grafana);
    }

    function getJson() {
        $json = ' {"id" : "' . $this->id . '",';
        $json .= ' "id_empresa" : "' . $this->id_empresa . '",';
        $json .= ' "username" : "' . $this->username . '",';
        $json .= ' "surname" : "' . $this->surname . '",';
        $json .= ' "givenName" : "' . $this->givenName . '",';
        $json .= ' "senha" : "' . $this->senha . '",';
        $json .= ' "tipo_usuario" : "' . $this->tipo_usuario . '",';
        $json .= ' "email" : "' . $this->email . '", ';
        $json .= ' "st_ldap" : "' . $this->st_ldap . '", ';
        $json .= ' "st_zabbix" : "' . $this->st_zabbix . '", ';
        $json .= ' "st_grafana" : "' . $this->st_grafana . '"}';

        return $json;
    }

    function getSt_zabbix() {
        return $this->st_zabbix;
    }

    function getSt_grafana() {
        return $this->st_grafana;
    }

    function setSt_zabbix($st_zabbix) {
        $this->st_zabbix = $st_zabbix;
    }

    function setSt_grafana($st_grafana) {
        $this->st_grafana = $st_grafana;
    }

    function getSt_ldap() {
        return $this->st_ldap;
    }

    function setSt_ldap($st_ldap) {
        $this->st_ldap = $st_ldap;
    }

}

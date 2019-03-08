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
class grafanaModel {

    //put your code here
    private $id_empresa;
    private $org_id;
    private $user_id;
    private $org_user_id;
    private $data_source_id;

    function getInsertPostgres() {

        return Array('id_empresa' => (int) $this->id_empresa,
            'org_id' => $this->org_id,
            'user_id' => $this->user_id,
            'org_user_id' => $this->org_user_id,
            'data_source_id' => $this->data_source_id);
    }

    function getJson() {
        $json = ' {"id_empresa" : "' . $this->id_empresa . '",';
        $json .= ' "org_id" : "' . $this->org_id . '",';
        $json .= ' "user_id" : "' . $this->user_id . '",';
        $json .= ' "org_user_id" : "' . $this->org_user_id . '",';
        $json .= ' "data_source_id" : "' . $this->data_source_id . '"}';
       
        return $json;
    }
    
    
    
    function getId_empresa() {
        return $this->id_empresa;
    }

    function getOrg_id() {
        return $this->org_id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getOrg_user_id() {
        return $this->org_user_id;
    }

    function getData_source_id() {
        return $this->data_source_id;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    function setOrg_id($org_id) {
        $this->org_id = $org_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setOrg_user_id($org_user_id) {
        $this->org_user_id = $org_user_id;
    }

    function setData_source_id($data_source_id) {
        $this->data_source_id = $data_source_id;
    }



}

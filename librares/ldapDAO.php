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
class ldapDAO {

    //put your code here

    private $ldapModel;
    private $ldap_entries_user;
    private $ds;
    private $ldap_host;
    private $ldap_porta;
    private $ldap_base;
    private $ldap_manager_group;
    private $ldap_ou;

    function __construct($ldap_host, $ldap_porta) {

        $this->ldap_host = $ldap_host;
        $this->ldap_porta = $ldap_porta;
    }

    function ldap_conectar() {
        $this->ds = ldap_connect($this->ldap_host, $this->ldap_porta);
        ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);

        if ($this->ds) {

            return true;
        } else {
            return false;
        }
    }

    function getLdap_ou() {
        return $this->ldap_ou;
    }

    function setLdap_ou($ldap_ou) {
        $this->ldap_ou = $ldap_ou;
    }

    function getLdap_manager_group() {
        return $this->ldap_manager_group;
    }

    function setLdap_manager_group($ldap_manager_group) {
        $this->ldap_manager_group = $ldap_manager_group;
    }

    function autenticar($usuario, $senha) {
        //  echo "<br/> autenticar: "." , ".$usuario. " ".$senha;
       //  echo "Conexao: " . $this->getDs() . ", ldap_ou: " . $this->getLdap_base() . ", Usuário: " . $usuario . ", Senha: " . $senha;

        // if($bind = @ldap_bind($this->ds, "uid=" . $usuario . "," . $this->ldap_base, $senha)) {
        if ($bind = @ldap_bind($this->ds, "uid=" . $usuario . ",ou=Admins," . $this->ldap_base, $senha)) {

            return true;
        } else {
            return false;
        }
    }

    function checaGrupoUsuario($usuario, $ldap_manager_group) {
        // valid
        // check presence in groups
        $filter = "(uid=$usuario)";
        $attr = array("memberOf");
        $result = ldap_search($this->ds, $this->ldap_base, $filter, $attr) or exit("Unable to search LDAP server");
        $entries = ldap_get_entries($this->ds, $result);
        ldap_unbind($this->ds);

        // check groups
        $access = 0;

	//print_r($entries);

        foreach ($entries[0]['memberof'] as $grps) {
            // is manager, break loop
            //echo $grps;
            if (strpos($grps, $ldap_manager_group)) {
                $access = 2;
                break;
            }
        }

        if ($access != 0) {

            return true;
        } else {
            // user has no rights
            return false;
        }
    }

    function getLdapModel() {
        return $this->ldapModel;
    }

    function setLdapModel($ldapModel) {
        $this->ldapModel = $ldapModel;
    }

    function getDs() {
        return $this->ds;
    }

    function setDs($ds) {
        $this->ds = $ds;
    }

    function getLdap_entries_user() {
        return $this->ldap_entries_user;
    }

    function setLdap_entries_user($ldap_entries_user) {
        $this->ldap_entries_user = $ldap_entries_user;
    }

    function getLdap_host() {
        return $this->ldap_host;
    }

    function getLdap_porta() {
        return $this->ldap_porta;
    }

    function getLdap_base() {
        return $this->ldap_base;
    }

    function setLdap_host($ldap_host) {
        $this->ldap_host = $ldap_host;
    }

    function setLdap_porta($ldap_porta) {
        $this->ldap_porta = $ldap_porta;
    }

    function setLdap_base($ldap_base) {
        $this->ldap_base = $ldap_base;
    }

}

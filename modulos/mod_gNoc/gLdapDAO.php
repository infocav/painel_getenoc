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
class gLdapDAO extends ldapDAO {

    //put your code here


    function __construct($ldap_host, $ldap_porta) {
        parent::__construct($ldap_host, $ldap_porta);
    }

    /**
      function ldap_conectar() {
      $ds = ldap_connect($this->ldapModel->getHost(), $this->ldapModel->getPort()) or die("Could not connect to LDAP Server");
      $this->ldapModel->setDs($ds);
      //var_dump($this->ldapModel->getDs());
      ldap_set_option($this->ldapModel->getDs(), LDAP_OPT_PROTOCOL_VERSION, 3);
      if ($this->ldapModel->getDs()) {

      $bind_rdn = "cn=" . $this->ldapModel->getUserCN() . ",dc=gatenoc,dc=cloud";
      $bind_pass = $this->ldapModel->getPassCN();
      //$ds = $this->ldapModel->getDs();
      $this->ldapModel->setBind(ldap_bind($this->ldapModel->getDs(), $bind_rdn, $bind_pass));

      //  $this->ldapModel->setBind($bind);
      // var_dump($this->ldapModel);
      // $bind = $this->ldapModel->getBind();
      //  print_r($this->ldapModel);

      return $this->ldapModel->getBind();
      //var_dump($this->ldapModel);
      // $this->ldapModel->setBind(ldap_bind($this->ldapModel->getDs(), "cn=ldapadm,dc=gatenoc,dc=cloud", "gate#noc77"));
      } else {
      return false;
      }
      }
     * */
    function autenticar($usuario, $senha) {
        //  echo "<br/> autenticar: "." , ".$usuario. " ".$senha;
        //    echo "Conexao: " . $this->ds . ", ldap_ou: " . $this->getLdap_base() . ", Usuário: " . $usuario . ", Senha: " . $senha;

        if ($bind = @ldap_bind($this->getDs(), "cn=" . $usuario . "," . $this->getLdap_base(), $senha)) {
            return true;
        } else {
            return false;
        }
    }

    function register_user($uid, $givenName, $surname, $mail, $password) {

        $info["uid"] = $uid;
        $info["givenName"] = $givenName;
        $info["sn"] = $surname;
        $info["cn"] = $givenName . " " . $surname;
        $info["mail"] = $mail;
        $info["objectClass"] = "inetOrgPerson";
        $info["userPassword"] = "{SHA}" . base64_encode(pack("H*", sha1($password)));

        $r = ldap_add($this->getDs(), "uid=$uid,ou=Clientes," . $this->getLdap_base(), $info);
        return $r;
    }

    /**
     * Description of check_user
     *
     * @abstract usado para checar a existencia do usuário pelo uid e pela senha
     * @return number retorna 0 para usuário e senha não existem; 1 para usuário e senha existem; 2 para usuário ou senha não existem
     */
    function check_user($uid, $email) {
    
        if ($this->check_user_by_uid($uid) == 0 and $this->check_user_by_email($email) == 0) {
            return 0;
        } elseif (($this->check_user_by_uid($uid) == 1 and $this->check_user_by_email($email) == 1)) {
            return 1;
        } else {
            return 2;
        }
    }

    function check_user_by_uid($uid) {

        $searchUser = ldap_search($this->getDs(), $this->getLdap_base(), "uid=" . $uid);
        $checkUser = ldap_get_entries($this->getDs(), $searchUser);
        $this->setLdap_entries_user($checkUser);
        if ("$checkUser[count]" == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function check_user_by_email($email) {


        $searchMail = ldap_search($this->getDs(), $this->getLdap_base(), "mail=" . $email);
        $checkMail = ldap_get_entries($this->getDs(), $searchMail);
        if ($checkMail[count] == 0) {
            return 0;
        } else {
            return 1;
        }
    }

}

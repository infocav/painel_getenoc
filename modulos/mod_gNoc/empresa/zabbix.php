<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zabbix
 *
 * @author cicero
 */
class zabbix {

    //put your code here
    private $empresa;

    function __construct($empresa) {
        $this->empresa = $empresa;
    }

    function criarBancoZabbix() {
        $newdb = $this->empresa->getZabbix()->getZabbixDb();
        $cmd = "/usr/bin/psql -U postgres -c \"CREATE DATABASE  " . $newdb . " WITH TEMPLATE zbxtemplate\" 2>&1";

        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
    }

    function criarUsuarioBancoZabbix() {
        $newUser = $this->empresa->getZabbix()->getZabbxUser();
        $newPass = $this->empresa->getZabbix()->getZabbixPass();
        $cmd = "/usr/bin/psql -U postgres -c \"CREATE USER " . $newUser . " WITH PASSWORD '" . $newPass . "'\" 2>&1";

        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
    }

    function criarPermissaoUsuarioBancoZabbix() {

        $newUser = $this->empresa->getZabbix()->getZabbxUser();
        $zbxDb = $this->empresa->getZabbix()->getZabbixDb();

        $cmd = "/usr/bin/psql -U postgres -c \"GRANT ALL PRIVILEGES ON DATABASE " . $zbxDb . " TO " . $newUser . " WITH GRANT OPTION \" 2>&1";

        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
    }

    function criarPermissaoUsuarioTabelasBancoZabbix() {

        $newUser = $this->empresa->getZabbix()->getZabbxUser();
        $zbxDb = $this->empresa->getZabbix()->getZabbixDb();

        $cmd = "/usr/bin/psql -U postgres " . $zbxDb . " -c \"GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO " . $newUser . " WITH GRANT OPTION \" 2>&1";
        //echo $cmd;
        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
    }

    function inserirUsuariosLdapZabbix() {

        $usuarios = $this->empresa->getUsuariosList();
        //$alias = $this->empresa->getalias_postgres();
        $usuarioCadastrado = Array();
        foreach ($usuarios as $key => $value) {
            // print_r($value);
            // print_r($alias);
            $cmd = "sudo /opt/gatenoc/modules/zapi " . $this->empresa->getalias_postgres() . " " . $value->getusername() . " '" . $value->getgivenName() . "'  '" . $value->getsurname() . "'  " . $value->getEmail() . " 2>&1";

            exec($cmd, $output, $status);
            return array("status" => $status, "mensagem" => $output);
//            if ($status == '0') {
//
//                $this->empresa->getZabbix()->setst_user_ldap_zabbix('S');
//                if (strcasecmp($this->empresa->getStatus_zabbix(), "N") !== 0) {
//                    $this->empresa->setStatus_zabbix('S');
//                }
//            } else {
//                $this->empresa->setMsg_criacao($this->empresa->getMsg_criacao() . ", Erro ao inserir o usuário  " . $value->getgivenName() . ", Com o erro: " . $output);
//                $this->empresa->getZabbix()->setst_user_ldap_zabbix('N');
//            }
//            exec($cmd, $o, $v);
//           
//            if ($v == '0') {
//
//                $this->empresa->getZabbix()->setst_user_ldap_zabbix('S');
//                if (strcasecmp($this->empresa->getStatus_zabbix(), "N") !== 0) {
//                    $this->empresa->setStatus_zabbix('S');
//                }
//
//            } else {
//                $this->empresa->setMsg_criacao($this->empresa->getMsg_criacao() . ", Erro ao inserir o usuário  " . $value->getgivenName() . ", Com o erro: " . $v);
//                $this->empresa->getZabbix()->setst_user_ldap_zabbix('N');
//
//            }
        }
    }

    function inserirUsuarioLdapZabbix($usuarios) {
        $cmd = "sudo /opt/gatenoc/modules/zapi " . $this->empresa->getalias_postgres() . "  " . $usuarios->getusername() . " '" . $usuarios->getgivenName() . "'  '" . $usuarios->getsurname() . "'  " . $usuarios->getEmail() . " 2>&1";
        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
        //   print_r($o);
        //   print_r($v);
//        if ($v == '0') {
//
//            //     echo "PASSOU: ".$v;
//            // echo "Banco criado com sucesso.";
//            // $this->empresa->getZabbix()->setst_user_ldap_zabbix('S');
////                if (strcasecmp($this->empresa->getStatus_zabbix(), "N") !== 0) {
////                    $this->empresa->setStatus_zabbix('S');
////                }
//            //AJUSTAR TABELA DE USUÁRIO E COLOCAR UMA NOVA FLAG PARA INFORMAR QUE OUSUÁRIO DO LDAP FOI CRIADO 
//            //NO ZABBIX  
//            //   array_push($usuarioCadastrado, );
//
//
//            return true;
//        } else {
//            //echo "Banco Já existe.";
////                $this->empresa->setMsg_criacao($this->empresa->getMsg_criacao() . ", Erro ao inserir o usuário  " . $usuarios->getgivenName().", Com o erro: ".$v);
////                $this->empresa->getZabbix()->setst_user_ldap_zabbix('N');
//            //    echo $v;
//            return false;
//        }
    }

    function criarFrontEnd() {

        $cmd = "sudo /opt/gatenoc/templates/zbxconf.sh "
                . $this->empresa->getZabbix()->getZabbixDb()
                . " " . $this->empresa->getZabbix()->getZabbxUser()
                . " " . $this->empresa->getZabbix()->getZabbixPass()
                . " " . $this->empresa->getZabbix()->getZabbixIp()
                . " " . $this->empresa->getZabbix()->getZabbxUser()
                . " 2>&1"
        ;

        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);

//        //echo $cmd;
//        exec($cmd, $o, $v);
//        //print_r($o);
//        //echo $o[2];
//        if ($v == 0) {
//            // echo "Banco criado com sucesso.";
//            $this->empresa->getZabbix()->setst_front_zbx('S');
//            if (strcasecmp($this->empresa->getStatus_zabbix(), "N") !== 0) {
//                $this->empresa->setStatus_zabbix('S');
//            }
//
//            return 1;
//        } else {
//            //echo "Banco Já existe.";
//            $this->empresa->setMsg_criacao($this->empresa->getMsg_criacao() . ", Erro ao criar o front end do Zabbix. " . $o);
//            $this->empresa->getZabbix()->setst_front_zbx('N');
//            return 2;
//        }
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

}

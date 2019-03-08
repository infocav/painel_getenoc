<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresaDAO
 *
 * @author cicero
 */
require_once(dirname(__FILE__) . DS . 'postgressdb.php');
require_once(dirname(__FILE__) . DS . 'usuarioModel.php');

class usuarioDAO {

    //put your code here
    private $db;

    function __construct() {
        $this->db = new postgressdb();
        $this->db = $this->db->conecta();
//        $sql = 'INSERT INTO empresas_usuarios ( id_empresa, tipo, usuario, senha, surname, givenName, email, st_ldap) VALUES ($1, $2, $3, $4, $5,$6,$7, $8)  returning id';
//
//        pg_prepare($this->db, 'inserirUsuario', $sql);
    }

    function insereUsuario($usuario) {
        // var_dump($usuario->getInsertPostgres());
        //$result = pg_execute($this->db, 'inserirUsuario', $usuario->getInsertPostgres());

        $sql = 'INSERT INTO empresas_usuarios ( id_empresa, tipo, usuario, senha, surname, givenName, email, st_ldap, st_zabbix, st_grafana) VALUES ($1, $2, $3, $4, $5,$6,$7, $8, $9, $10)  returning id';
        pg_prepare($this->db, 'inserirUsuario', $sql);
        $result = pg_execute($this->db, 'inserirUsuario', $usuario->getInsertPostgres());
        $result = pg_fetch_array($result);
        $usuario->setId($result['id']);

        return $usuario;
    }

    function atualizaStUsuariosPostgres($usuario) {

        $sql = "UPDATE public.empresas_usuarios
	SET  st_ldap='" . $usuario->getSt_ldap() . "' , 
             st_zabbix=  '" . $usuario->getst_zabbix() . "' ,  
             st_grafana=  '" . $usuario->getst_grafana() . "'		
	WHERE id = " . $usuario->getId() . " and id_empresa = " . $usuario->getId_empresa() . "";

        //echo $sql;

        $result = pg_query($this->db, $sql);
        //var_dump($result);
        if (!$result) {
            //echo "Update failed!!";
        } else {
            //echo "Update successfull;";
        }

        return $usuario;
    }
    
    function buscarUsuarios($username)
    {
         $sql = "SELECT id, id_empresa, tipo, usuario, senha, surname, email, givenname, st_ldap, st_zabbix, st_grafana
                FROM public.empresas_usuarios u where u.usuario ='" . $username . "' order by id";

        $result = pg_query($this->db, $sql);
       // var_dump($result);
        $usuariosList = array();
        if (pg_num_rows($result) > 0) {
            
            require_once(dirname(__FILE__) . DS . 'usuarioModel.php');

            while ($i = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                $usuario = new usuarioModel();
                $usuario->setId($i['id']);
                $usuario->setId_empresa($i['id_empresa']);
                $usuario->setGivenName($i['givenname']);
                $usuario->setSurname($i['surname']);
                $usuario->setUsername($i['usuario']);
                $usuario->setEmail($i['email']);
                $usuario->setSenha($i['senha']);
                $usuario->setTipo_usuario($i['tipo']);
                $usuario->setSt_ldap($i['st_ldap']);
                $usuario->setst_zabbix($i['st_zabbix']);
                $usuario->setst_grafana($i['st_grafana']);
              //  var_dump($usuario);

                array_push($usuariosList, $usuario);
              //  var_dump($usuariosList);
            }
        } 
      //  echo "ULTIO **************";
       // var_dump($usuariosList);
         return $usuariosList;
    }

}

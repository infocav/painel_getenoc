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
require_once(dirname(__FILE__) . DS . 'zabbixModel.php');

class zabbixDAO {

    //put your code here
    private $db;

    function __construct() {
        $this->db = new postgressdb();
        $this->db = $this->db->conecta();
        
    }

    function insereZabbix($zabbix) {
        //  var_dump($zabbix->getInsertPostgres());
        $sql = "INSERT INTO empresas_zabbix ( id_empresa, zbx_db_name, zbx_name, zbx_rede, zbx_ip, zbx_porta, zbx_ip_db, zbx_user, zbx_pass, st_db_zbx, st_user_db_zbx, st_perm_user_db_zbx, st_perm_user_table_db_zbx, st_docker_zbx, st_front_zbx,st_user_ldap_zabbix)
	VALUES ( $1, $2, $3, $4, $5 || nextval('zbx_docker_ip'), nextval('zbx_docker_porta'), $6, $7, $8, $9, $10,$11,$12,$13,$14,$15)  returning id";

        pg_prepare($this->db, 'inserirZabbix', $sql);
        $result = pg_execute($this->db, 'inserirZabbix', $zabbix->getInsertPostgres());

        $result = pg_fetch_array($result);
        $zabbix->setZabbix_id($result['id']);

        $zabbix = $this->buscarZabbixConfig($zabbix);

        return $zabbix;
    }

    function updateZabbix($zabbix) {
        //  var_dump($zabbix);
        $sql = "UPDATE public.empresas_zabbix
	SET  st_db_zbx='".$zabbix->getst_db_zbx()."',  
		  st_user_db_zbx='".$zabbix->getst_user_db_zbx()."', 
		  st_perm_user_db_zbx='".$zabbix->getst_perm_user_db_zbx()."', 
		  st_perm_user_table_db_zbx='".$zabbix->getst_perm_user_table_db_zbx()."', 
		  st_docker_zbx='".$zabbix->getst_docker_zbx()."', 
		  st_front_zbx='".$zabbix->getst_front_zbx()."',
                  st_user_ldap_zabbix='".$zabbix->getst_user_ldap_zabbix()."'    
	WHERE id = ".$zabbix->getZabbix_id()." and id_empresa = ".$zabbix->getEmpresa_id()."";
        
        //echo $sql;
        
        $result = pg_query($this->db, $sql);
        
        if (!$result) {
            //echo "Update failed!!";
        } else {
            //echo "Update successfull;";
        }


        return $zabbix;
    }

    function buscarZabbixConfig($zabbix) {
        $sql = "SELECT * FROM EMPRESAS_ZABBIX Z WHERE Z.ID = " . $zabbix->getZabbix_id() . " AND Z.ID_EMPRESA = " . $zabbix->getEmpresa_id();

        $result = pg_query($this->db, $sql);

        while ($row = pg_fetch_assoc($result)) {
            $zabbix->setZabbixIp($row["zbx_ip"]);
            $zabbix->setZabbixPorta($row["zbx_porta"]);
            $zabbix->setZabbixIpDb($row["zbx_ip_db"]);
        }
        return $zabbix;
    }

}

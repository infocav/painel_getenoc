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
require_once(dirname(__FILE__) . DS . 'empresaModel.php');

class empresaDAO {

    //put your code here
    private $db;
    private $empresa;

    function __construct($empresa) {
        $this->db = new postgressdb();
        $this->db = $this->db->conecta();
        $this->empresa = $empresa;
    }

    function checaAlias() {
        $sql = "SELECT * FROM EMPRESAS E WHERE E.ALIAS = '" . $this->empresa->getAlias_postgres() . "'";

        // echo $sql;
        $result = pg_query($this->db, $sql);
        //var_dump($result);
        if (pg_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function carregaEmpresa() {
        $sql = "SELECT * FROM EMPRESAS E WHERE UPPER(E.ALIAS) = UPPER('" . $this->empresa->getAlias_postgres() . "')";

        $result = pg_query($this->db, $sql);

        if (pg_num_rows($result) > 0) {
            $result = pg_fetch_array($result, 0, PGSQL_ASSOC);
            $this->empresa->setId_postgres($result['id']);
            $this->empresa->setCnpj_postgres($result['cnpj']);
            $this->empresa->setRazao_social_postgres($result['razao_social']);
            $this->empresa->setAlias_postgres($result['alias']);
            $this->empresa->setEndereco_postgres($result['endereco']);
            $this->empresa->setNome_fantasia_postgres($result['nome_fantasia']);


            return true;
        } else {
            return false;
        }
    }

    function buscarByIdEmpresa($id) {
        $sql = "SELECT * FROM EMPRESAS E WHERE id = " . $id;

        $result = pg_query($this->db, $sql);

        if (pg_num_rows($result) > 0) {
            $result = pg_fetch_array($result, 0, PGSQL_ASSOC);
            $this->empresa->setId_postgres($result['id']);
            $this->empresa->setCnpj_postgres($result['cnpj']);
            $this->empresa->setRazao_social_postgres($result['razao_social']);
            $this->empresa->setAlias_postgres($result['alias']);
            $this->empresa->setEndereco_postgres($result['endereco']);
            $this->empresa->setNome_fantasia_postgres($result['nome_fantasia']);


            return true;
        } else {
            return false;
        }
    }

    function carregaUsuarios() {
        $sql = "SELECT id, id_empresa, tipo, usuario, senha, surname, email, givenname, st_ldap, st_zabbix, st_grafana
                FROM public.empresas_usuarios u where  u.tipo in (0,1) and u.id_empresa =" . $this->empresa->getId_postgres() . " order by id";

        $result = pg_query($this->db, $sql);

        if (pg_num_rows($result) > 0) {
            $usuariosList = array();
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

                array_push($usuariosList, $usuario);
            }

            $this->empresa->setUsuariosList($usuariosList);

            return true;
        } else {
            return false;
        }
    }

    function carregaZabbix() {
        $sql = "SELECT id, id_empresa, zbx_db_name, zbx_name, zbx_rede, zbx_ip, zbx_porta, zbx_ip_db, zbx_user, zbx_pass,
                COALESCE(st_db_zbx, 'N') st_db_zbx, COALESCE(st_user_db_zbx,  'N') st_user_db_zbx, 
                COALESCE(st_perm_user_db_zbx,  'N') st_perm_user_db_zbx, COALESCE(st_perm_user_table_db_zbx,  'N') st_perm_user_table_db_zbx, 
                COALESCE(st_docker_zbx,  'N') st_docker_zbx, COALESCE(st_front_zbx,'N')  st_front_zbx , COALESCE(st_user_ldap_zabbix, 'N') st_user_ldap_zabbix
                FROM public.empresas_zabbix z where  z.id_empresa =" . $this->empresa->getId_postgres();

        $result = pg_query($this->db, $sql);

        if (pg_num_rows($result) > 0) {
            require_once(dirname(__FILE__) . DS . 'zabbixModel.php');
            $zabbix = new zabbixModel();

            $result = pg_fetch_array($result, 0, PGSQL_ASSOC);

            $zabbix->setempresa_id($result['id_empresa']);
            $zabbix->setzabbix_id($result['id']);
            $zabbix->setzabbixName($result['zbx_name']);
            $zabbix->setzabbixRede($result['zbx_rede']);
            $zabbix->setzabbixIp($result['zbx_ip']);
            $zabbix->setzabbixPorta($result['zbx_porta']);
            $zabbix->setzabbixDb($result['zbx_db_name']);
            $zabbix->setzabbixIpDb($result['zbx_ip_db']);
            $zabbix->setzabbxUser($result['zbx_user']);
            $zabbix->setzabbixPass($result['zbx_pass']);
            $zabbix->setst_db_zbx($result['st_db_zbx']);
            $zabbix->setst_user_db_zbx($result['st_user_db_zbx']);
            $zabbix->setst_perm_user_db_zbx($result['st_perm_user_db_zbx']);
            $zabbix->setst_perm_user_table_db_zbx($result['st_perm_user_table_db_zbx']);
            $zabbix->setst_docker_zbx($result['st_docker_zbx']);
            $zabbix->setst_front_zbx($result['st_front_zbx']);
            $zabbix->setst_user_ldap_zabbix($result['st_user_ldap_zabbix']);


            $this->empresa->setZabbix($zabbix);


            return true;
        } else {
            return false;
        }
    }

    function carregaGrafana() {

//     $sql = "SELECT id, id_empresa, zbx_db_name, zbx_name, zbx_rede, zbx_ip, zbx_porta, zbx_ip_db, zbx_user, zbx_pass,
//                COALESCE(st_db_zbx, 'N') st_db_zbx, COALESCE(st_user_db_zbx,  'N') st_user_db_zbx, 
//                COALESCE(st_perm_user_db_zbx,  'N') st_perm_user_db_zbx, COALESCE(st_perm_user_table_db_zbx,  'N') st_perm_user_table_db_zbx, 
//                COALESCE(st_docker_zbx,  'N') st_docker_zbx, COALESCE(st_front_zbx,'N')  st_front_zbx , COALESCE(st_user_ldap_zabbix, 'N') st_user_ldap_zabbix
//                FROM public.empresas_zabbix z where  z.id_empresa =" . $this->empresa->getId_postgres();
//        

        $sql = "SELECT id_empresa, org_id, user_id, org_user_id, data_source_id
	FROM public.empresa_grafana e
	where e.id_empresa = " . $this->empresa->getId_postgres();
        //var_dump($this->db);
        // return false;
        // $result = pg_query($this->db, $sql);
        $result = pg_query($this->db, $sql);

        //  var_dump($result);

        if (pg_num_rows($result) > 0) {
            require_once(dirname(__FILE__) . DS . 'grafanaModel.php');
            $grafana = new grafanaModel();
            $result = pg_fetch_array($result, 0, PGSQL_ASSOC);

            $grafana->setId_empresa($result['id_empresa']);
            $grafana->setOrg_id($result['org_id']);
            $grafana->setUser_id($result['user_id']);
            $grafana->setOrg_user_id($result['org_user_id']);
            $grafana->setData_source_id($result['data_source_id']);


            $this->empresa->setGrafana($grafana);

            return true;
        } else {
            return false;
        }
    }

    function checaCPF() {
        $sql = "SELECT * FROM EMPRESAS E WHERE E.CNPJ = '" . $this->empresa->getCnpj_postgres() . "'";
        $result = pg_query($this->db, $sql);
        if (pg_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insereEmpresa() {
        $sql = 'INSERT INTO empresas(  cnpj, razao_social, alias, endereco, nome_fantasia) VALUES ($1, $2, $3, $4, $5)  returning id';

        pg_prepare($this->db, 'insertEmpresa', $sql);
        $result = pg_execute($this->db, 'insertEmpresa', $this->empresa->getInsertPostgres());

        $result = pg_fetch_array($result);
        $this->empresa->setId_postgres($result['id']);
    }

    function insereGrafana() {
        $sql = 'INSERT INTO public.empresa_grafana(  id_empresa, org_id, user_id, org_user_id, data_source_id ) VALUES ($1, $2, $3, $4, $5) ';

        pg_prepare($this->db, 'insertGrafana', $sql);
        $result = pg_execute($this->db, 'insertGrafana', $this->empresa->getGrafana()->getInsertPostgres());

        $result = pg_fetch_array($result);
    }

    function listarEmpresas() {
        $sql = "SELECT * FROM EMPRESAS ORDER BY ID";

        $result = pg_query($this->db, $sql);


        $qtde_row = pg_num_rows($result);
        $i = 1;
        $json = '[';
        while ($row = pg_fetch_assoc($result)) {

            $json .= '{ ';
            $json .= ' "ID":"' . $row["id"] . '",';
            $json .= ' "cnpj":"' . $row["cnpj"] . '",';
            $json .= ' "razao_social":"' . $row["razao_social"] . '",';
            $json .= ' "alias":"' . $row["alias"] . '",';
            $json .= ' "endereco":"' . $row["endereco"] . '",';
            $json .= ' "nome_fantasia":"' . $row["nome_fantasia"] . '"';
            $json .= '} ';

            if ($qtde_row != $i) {
                $json .= ',';
            }
            $i ++;
        }

        $json .= ']';

        return $json;
        // $json = json_encode($json);
        //echo ($json);
    }

    function getDb() {
        return $this->db;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setDb($db) {
        $this->db = $db;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

}

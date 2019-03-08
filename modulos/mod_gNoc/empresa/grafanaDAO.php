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
require_once(dirname(__FILE__) . DS . 'grafanadb.php');

class grafanaDAO {

    private $db;

    function __construct() {
        $this->db = new grafanadb();
        $this->db = $this->db->conecta();
    }

    function integraGrafanaZabbix($empresa) {

        $sql = "select public.f_integra_grafana_zabbix('" . $empresa->getalias_postgres() . "',
                '" . $empresa->getUsuariosList()[1]->getusername() . "',
                '" . $empresa->getUsuarioslist()[1]->getsenha() . "',	
                '" . $empresa->getUsuarioslist()[1]->getEmail() . "',
                '" . $empresa->getUsuarioslist()[1]->getgivenname() . " " . $empresa->getUsuarioslist()[1]->getsurname() . "',
                '" . $empresa->getUsuarioslist()[0]->getusername() . "',
                '" . $empresa->getUsuarioslist()[0]->getsenha() . "') as integracao_json";
        //    var_dump($sql);
//        
        $result = pg_query($this->db, $sql);

        if (pg_num_rows($result) > 0) {
            $result = pg_fetch_array($result, 0, PGSQL_ASSOC);
            // echo $row["integracao_json"] ;

            $json = json_decode($result["integracao_json"], true);

            if ($json['status'] == 'S') {
                $empresa->setstatus_grafana('S');
                $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', Grafana integrado');

                require_once(dirname(__FILE__) . DS . 'grafanaModel.php');
                $grafana = new grafanaModel();
                $grafana->setOrg_id($json['v_org_id']);
                $grafana->setData_source_id($json['v_data_source_id']);
                $grafana->setOrg_user_id($json['v_org_user_id']);
                $grafana->setUser_id($json['v_user_id']);
                $grafana->setId_empresa($empresa->getid_postgres());

                $empresa->setGrafana($grafana);
            } else {
                $empresa->setstatus_grafana('N');
                $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ' . $json['erro']);
            }

            //  return true;
        } else {
            $empresa->setstatus_grafana('N');
            $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ERRO DESCONHECIDO');
        }

        return $empresa;
    }

    function criaOrgDataSource($empresa) {

        $usuarioApi;
        foreach ($empresa->getUsuarioslist() as $key => $value) {
            if ($value->getTipo_usuario() === '0' && $value->getSt_grafana() === 'N') {
                $usuarioApi = $value;



                $sql = "select public.f_cria_org_data_source('" . $empresa->getalias_postgres() . "',
                '" . $usuarioApi->getusername() . "',
                '" . $usuarioApi->getsenha() . "') as integracao_json";
                //    var_dump($sql);
//        
                $result = pg_query($this->db, $sql);

                if (pg_num_rows($result) > 0) {
                    $result = pg_fetch_array($result, 0, PGSQL_ASSOC);
                    // echo $row["integracao_json"] ;


                    $json = json_decode($result["integracao_json"], true);

                    if ($json['status'] == 'S') {
                        $empresa->setstatus_grafana('S');
                        $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', Grafana integrado');

                        require_once(dirname(__FILE__) . DS . 'grafanaModel.php');
                        $grafana = new grafanaModel();
                        $grafana->setOrg_id($json['v_org_id']);
                        $grafana->setData_source_id($json['v_data_source_id']);
                        // $grafana->setOrg_user_id($json['v_org_user_id']);
                        // $grafana->setUser_id($json['v_user_id']);
                        $grafana->setId_empresa($empresa->getid_postgres());



                        $empresa->setGrafana($grafana);
                    } else {
                        $empresa->setstatus_grafana('N');
                        $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ' . $json['erro']);
                    }

                    //  return true;
                } else {
                    $empresa->setstatus_grafana('N');
                    $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ERRO DESCONHECIDO');
                }

                break;
            }
        }

        return $empresa;
    }

    function registrarUserZabbix($empresa) {

        $usuario = $empresa->getUsuarioslist();
        foreach ($usuario as $key => $value) {
            if ($value->getSt_grafana() === 'N') {
                
                $sql = "select public.f_registrar_user_zabbix('" . $value->getusername() . "',
                '" . $value->getsenha() . "',
                    '" . $value->getEmail() . "',
                        '" . $value->getgivenName() . " " . $value->getsurname() . "',
                '" . $empresa->getGrafana()->getorg_id() . "') as integracao_json";
                //    var_dump($sql);
//        
                $result = pg_query($this->db, $sql);

                if (pg_num_rows($result) > 0) {
                    $result = pg_fetch_array($result, 0, PGSQL_ASSOC);
                    // echo $row["integracao_json"] ;


                    $json = json_decode($result["integracao_json"], true);

                    if ($json['status'] == 'S') {
                        $empresa->setstatus_grafana('S');
                        $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', Grafana integrado');

                         $usuario[$key]->setSt_grafana('S');
                    } else {
                        $empresa->setstatus_grafana('N');
                        $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ' . $json['erro']);
                         $usuario[$key]->setSt_grafana('N');
                    }

                    //  return true;
                } else {
                    $empresa->setstatus_grafana('N');
                    $empresa->setmsg_criacao($empresa->getMsg_criacao() . ', ERRO DESCONHECIDO');
                     $usuario[$key]->setSt_grafana('N');
                }
            }
            
        }
        
        
        //var_dump($usuario);
        $empresa->setUsuarioslist($usuario);

        return $empresa;
    }

}

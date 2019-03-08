<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of docker
 *
 * @author cicero
 */
class docker {

//put your code here
    private $zabbix; //objeto zabbixModel

    function __construct($zabbix) {
        $this->zabbix = $zabbix;
    }

    function criarDocker() {

        $cmd = 'sudo /usr/bin/docker run --name ' . $this->zabbix->getZabbixName() . ' --net ' . $this->zabbix->getZabbixRede() . ' --ip ' . $this->zabbix->getZabbixIp() . ' --restart=always -e DB_SERVER_HOST="' . $this->zabbix->getZabbixIpDb() . '" -e POSTGRES_DB="' . $this->zabbix->getZabbixDb() . '" -e POSTGRES_USER="' . $this->zabbix->getZabbxUser() . '" -e POSTGRES_PASSWORD="' . $this->zabbix->getZabbixPass() . '" -p ' . $this->zabbix->getZabbixPorta() . ':10051 -v /etc/localtime:/etc/localtime:ro -v /opt/gatenoc/zbx_env/alertscripts:/usr/lib/zabbix/alertscripts:ro -v /opt/gatenoc/zbx_env/externalscripts:/usr/lib/zabbix/externalscripts:ro -d zabbix/zabbix-server-pgsql:'.DOCKER_IMAGEM_ZABBIX.' 2>&1';
        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
        //       exec($cmd, $o, $v);
//        //print_r($o);
//        //echo $o[2];
//        if ($v == 0) {
//           
//            return 1;
//        } else {
//            
//            return 2;
//        }
    }

    function rodarDocker() {
        $cmd = 'sudo /usr/bin/docker start ' . $this->zabbix->getZabbixName() . ' 2>&1';
        exec($cmd, $output, $status);
        return array("status" => $status, "mensagem" => $output);
//        exec($cmd, $o, $v);
//        //print_r($o);
//        //echo $o[2];
//        if ($v == 0) {
//
//            return 1;
//        } else {
//
//            return 2;
//        }
    }

    function getZabbix() {
        return $this->zabbix;
    }

    function setZabbix($zabbix) {
        $this->zabbix = $zabbix;
    }

}

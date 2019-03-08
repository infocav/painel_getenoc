<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresaModel
 *
 * @author cicero
 */
class empresaModel {

    //put your code here

    private $id_postgres;
    private $cnpj_postgres;
    private $razao_social_postgres;
    private $alias_postgres;
    private $endereco_postgres;
    private $nome_fantasia_postgres;
    private $usuariosList = array();
    private $contatosList = array();
    private $grafana;
    private $dados;
    private $status_criacao;
    private $status_ldap;
    private $status_docker;
    private $status_zabbix;
    private $status_frontend_zabbix;
    private $status_grafana;
    private $msg_criacao;
    private $zabbix;
    private $url_zabbix;
    private $url_grafana;

    public function __construct($dados) {
        $this->dados = $dados;
        $this->setPostgresEmp();
        $this->criaUsuariosPadroes();
        $this->criarEstruturaZabbix();
        $this->criarEstruturaGrafana();
    }

    function setPostgresEmp() {

        $this->cnpj_postgres = $this->dados['cnpj'];
        $this->razao_social_postgres = $this->dados['razao_social'];
        $this->alias_postgres = strtolower($this->dados['alias']);
        $this->endereco_postgres = $this->dados['endereco'];
        $this->nome_fantasia_postgres = $this->dados['nome_fantasia'];
    }

    function getJson() {

        $json = '{ "id" : "' . $this->id_postgres . '" , ';
        $json .= '  "cnpj" : "' . $this->cnpj_postgres . '" , ';
        $json .= '  "razao_social" : "' . $this->razao_social_postgres . '" , ';
        $json .= '  "alias" : "' . $this->alias_postgres . '" , ';
        $json .= '  "endereco" : "' . $this->endereco_postgres . '" , ';
        $json .= '  "nome_fantasia" : "' . $this->nome_fantasia_postgres . '",';
        $json .= '  "status_criacao" : "' . $this->status_criacao . '",';
        $json .= '  "msg_criacao" : "' . $this->msg_criacao . '",';
        $json .= '  "status_ldap" : "' . $this->status_ldap . '",';
        $json .= '  "status_docker" : "' . $this->status_docker . '",';
        $json .= '  "status_grafana" : "' . $this->status_grafana . '",';
        $json .= '  "status_zabbix" : "' . $this->status_zabbix . '",';
        $json .= '  "zabbix" : ' . $this->zabbix->getJson() . ',';
        $json .= '  "grafana" : ' . $this->grafana->getJson() . ',';
        $json .= '  "url_zabbix" : "' . $this->url_zabbix . '",';
        $json .= '  "url_grafana" : "' . $this->url_grafana . '",';
        $json .= '  "usuarios" : [';

        $i = 0;



        foreach ($this->usuariosList as $key => $value) {

            if ($i > 0) {
                $json .= ',';
            }
            $i++;
            //  var_dump($value);
            $json .= $value->getJson();
        }

        $json .= ']';
//  $json .= '  "usuarios" : [' . $this->usuariosList[0]->getJson() . ',' . $this->usuariosList[1]->getJson() . ']';


        $json .= '}';

        //return json_encode($json);
        return $json;
    }

    function getUrl_zabbix() {
        return $this->url_zabbix;
    }

    function getUrl_grafana() {
        return $this->url_grafana;
    }

    function setUrl_zabbix($url_zabbix) {
        $this->url_zabbix = $url_zabbix;
    }

    function setUrl_grafana($url_grafana) {
        $this->url_grafana = $url_grafana;
    }

    function criarEstruturaGrafana() {
        require_once(dirname(__FILE__) . DS . 'grafanaModel.php');
        $this->grafana = new grafanaModel();
    }

    function criarEstruturaZabbix() {
        require_once(dirname(__FILE__) . DS . 'zabbixModel.php');
        $zabbixM = new zabbixModel();
        $zabbixM->setZabbixDb('zbx' . $this->alias_postgres);
        $zabbixM->setZabbixIp("172.18.0.");
        //$zabbixM->setZabbixIpDb('IP');
        $zabbixM->setZabbixName($this->getAlias_postgres());
        $zabbixM->setZabbixPass($this->gerarSenha());
        $zabbixM->setZabbixPorta('PO');
        $zabbixM->setZabbixRede('zbxnet');
        $zabbixM->setZabbxUser($this->alias_postgres);

        $this->zabbix = $zabbixM;
    }

    function criaUsuariosPadroes() {
        require_once 'usuarioModel.php';

        $this->criarUsuarioAPI();
        $this->criarUsuarioPrimario();
    }

    function criarUsuarioAPI() {
        $usuario = new usuarioModel();
        $usuario->setGivenName('api');
        $usuario->setSurname('api');
        $usuario->setUsername($this->alias_postgres . '_api');
        $usuario->setEmail(null);
        $usuario->setSenha($this->gerarSenha());
        $usuario->setTipo_usuario('0');
        $usuario->setSt_ldap('N');
        $usuario->setst_zabbix('N');
        $usuario->setst_grafana('N');

        array_push($this->usuariosList, $usuario);
        //falta o email
    }

    function criarUsuarioPrimario() {
        $usuario = new usuarioModel();
        $usuario->setGivenName($this->dados['givenName']);
        $usuario->setSurname($this->dados['surname']);
        $usuario->setUsername($this->alias_postgres);
        $usuario->setEmail($this->dados['email']);
        $usuario->setSenha('@senha123');
        $usuario->setTipo_usuario('1');
        $usuario->setSt_ldap('N');
        $usuario->setst_zabbix('N');
        $usuario->setst_grafana('N');

        array_push($this->usuariosList, $usuario);
    }

    function gerarSenha() {
        return hash("sha256", rand(0000000, 9999999));
    }

    function getInsertPostgres() {

        return Array('cnpj' => $this->cnpj_postgres,
            'razao_social' => $this->razao_social_postgres,
            'alias' => $this->alias_postgres,
            'endereco' => $this->endereco_postgres,
            'nome_fantasia' => $this->nome_fantasia_postgres);
    }

    function getEmail() {
        return $this->email;
    }

    function getStatus_criacao() {
        return $this->status_criacao;
    }

    function getMsg_criacao() {
        return $this->msg_criacao;
    }

    function setStatus_criacao($status_criacao) {
        $this->status_criacao = $status_criacao;
    }

    function setMsg_criacao($msg_criacao) {
        $this->msg_criacao = $msg_criacao;
    }

    function getDados() {
        return $this->dados;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDados($dados) {
        $this->dados = $dados;
    }

    function getContatosList() {
        return $this->contatosList;
    }

    function setContatosList($contatosList) {
        $this->contatosList = $contatosList;
    }

    function getUsuariosList() {
        return $this->usuariosList;
    }

    function setUsuariosList($usuariosList) {
        $this->usuariosList = $usuariosList;
    }

    function getId_postgres() {
        return $this->id_postgres;
    }

    function getCnpj_postgres() {
        return $this->cnpj_postgres;
    }

    function getRazao_social_postgres() {
        return $this->razao_social_postgres;
    }

    function getAlias_postgres() {
        return $this->alias_postgres;
    }

    function getEndereco_postgres() {
        return $this->endereco_postgres;
    }

    function getNome_fantasia_postgres() {
        return $this->nome_fantasia_postgres;
    }

    function setId_postgres($id_postgres) {
        $this->id_postgres = $id_postgres;
        //var_dump($this->usuariosList );
        foreach ($this->usuariosList as $key => $value) {
            $value->setId_empresa($id_postgres);

            $this->usuariosList[$key] = $value;
        };

        $this->zabbix->setEmpresa_id($id_postgres);

        // var_dump( $this->zabbix);
    }

    function setCnpj_postgres($cnpj_postgres) {
        $this->cnpj_postgres = $cnpj_postgres;
    }

    function setRazao_social_postgres($razao_social_postgres) {
        $this->razao_social_postgres = $razao_social_postgres;
    }

    function setAlias_postgres($alias_postgres) {
        $this->alias_postgres = $alias_postgres;
    }

    function setEndereco_postgres($endereco_postgres) {
        $this->endereco_postgres = $endereco_postgres;
    }

    function setNome_fantasia_postgres($nome_fantasia_postgres) {
        $this->nome_fantasia_postgres = $nome_fantasia_postgres;
    }

    function getZabbix() {
        return $this->zabbix;
    }

    function setZabbix($zabbix) {
        $this->zabbix = $zabbix;
    }

    function getStatus_ldap() {
        return $this->status_ldap;
    }

    function getStatus_docker() {
        return $this->status_docker;
    }

    function getStatus_zabbix() {
        return $this->status_zabbix;
    }

    function getStatus_grafana() {
        return $this->status_grafana;
    }

    function setStatus_ldap($status_ldap) {
        $this->status_ldap = $status_ldap;
    }

    function setStatus_docker($status_docker) {
        $this->status_docker = $status_docker;
    }

    function setStatus_zabbix($status_zabbix) {
        $this->status_zabbix = $status_zabbix;
    }

    function setStatus_grafana($status_grafana) {
        $this->status_grafana = $status_grafana;
    }

    function getStatus_frontend_zabbix() {
        return $this->status_frontend_zabbix;
    }

    function setStatus_frontend_zabbix($status_frontend_zabbix) {
        $this->status_frontend_zabbix = $status_frontend_zabbix;
    }

    function getGrafana() {
        return $this->grafana;
    }

    function setGrafana($grafana) {
        $this->grafana = $grafana;
    }

}

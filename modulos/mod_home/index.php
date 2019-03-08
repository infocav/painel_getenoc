<?php

require_once(dirname(__FILE__) . DS . 'homeView.php');

class homeController {

    private $options;

    function __construct($options) {
        $this->options = $options;
    }

    function logar() {

        $ldap = new ldapDAO(LDAP_HOST, LDAP_PORTA);
        //print_r($ldap);

        if ($ldap->ldap_conectar()) {
            $ldap->setLdap_base(LDAP_OU);

            //se autenticar então checa se o usuário pertence ao grupo de administradores do portal
            //echo $this->options['username']. " ". $this->options['senha'];
            //  echo "Conexao: " . $ldap->getDs() . ", ldap_ou: " . $ldap->getLdap_base() . ", Usuário: " . LDAP_USER_ADMIN . ", Senha: " . LDAP_USER_PASS;

            if ($ldap->autenticar($this->options['username'], $this->options['senha'])) {
                echo "Autenticado";

		//$ldap->checaGrupoUsuario($this->options['username'], LDAP_MANAGER_GROUP);
                if ($ldap->checaGrupoUsuario($this->options['username'], LDAP_MANAGER_GROUP)) {
                    userSession::setLogin($this->options['username']);
                    header("Location:index.php");
                }
            } else {
                echo "Usuário não autenticado";
            }
        }


        //colocar a função para logar
        //codigo temporário
        /*  if (session_status() == PHP_SESSION_NONE) {
          session_start();
          }
         */
        /*  userSession::setLogin($this->options['username']);
          echo 'USUARIO LOGADO: '.userSession::getLogin().'<br/>';
          echo 'CONFIG.: '. LDAP_OU .'<br/>'; */
        // header("Location:index.php");
    }

    function deslogar() {
        //echo "Deslogar";
        userSession::deslogar();
        header("Location:index.php");
    }

    function action() {


        if (array_key_exists('action', $this->options)) {
            if (strcasecmp($this->options['action'], "logar") == 0) {

                $this->logar();
            }

            if (strcasecmp($this->options['action'], "deslogar") == 0) {
                $this->deslogar();
            }
        }
    }

    function run() {


        $tpl;

        if (array_key_exists('action', $this->options)) {

            $this->action();
        }



        if (array_key_exists('view', $this->options)) {
            $tpl = $this->options['view'] . 'ViewTemplate.php';
        } else {
            $tpl = null;
        }


        $view = new homeView();
        if ($this->options['view'] == 'login') {
            $view->login();
        }
        $view->loadViewTemplate($tpl, 'conteudo');

        $view->display();
    }

}
?>



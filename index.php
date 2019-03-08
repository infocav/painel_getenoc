<?php

//ATIVA O LOG DO PHP PARA DEPURAÇÃO
//ini_set('display_errors', 1);
//error_reporting(E_ALL); 

//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');


define('PATH_BASE', dirname(__FILE__));

define('DS', DIRECTORY_SEPARATOR);

require_once (PATH_BASE . DS . 'includes' . DS . 'requires.php' );


while (list($campo, $valor) = each($_REQUEST)) {
    $valores[$campo] = $valor;
}
$valores['file'] = $_FILES;

//echo userSession::getLogin();
if (LOGIN_REQUIRED) {

    if((userSession::getLogin() ) )
    {
       
        if (empty($valores['modulo']))
        {
            $valores['modulo'] = 'home';
            $valores['view'] = 'home';
        }

       

    }else
    {
            $valores['view'] = 'login';
            $valores['modulo'] = 'home';
     
        

    }


}

//echo $valores['modulo'];
//echo $valores['action'] ."\n";

$boot = new boot($valores);
$boot->load();



?>

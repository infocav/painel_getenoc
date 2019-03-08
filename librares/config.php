<?php

//LDAP CONFIG
//requer login
define( 'LOGIN_REQUIRED', TRUE );

// active directory server
define( 'LDAP_HOST', '127.0.0.1');
 
define( 'LDAP_PORTA', '389');

// active directory DN (base location of ldap search)
define('LDAP_BASE', 'dc=gatenoc,dc=cloud');

define('LDAP_USER_ADMIN', 'root');
define('LDAP_USER_PASS', 'gate#noc77');

// active directory manager group name
define('LDAP_MANAGER_GROUP','portal');

define('LDAP_OU', 'ou=Usuarios,dc=gatenoc,dc=cloud' );



//POSTGRES CONFIG
define('POSTGRES_HOST','127.0.0.1');
define('POSTGRES_DBNAME', 'gatenoc');
define('POSTGRES_USER', 'pgadmin');
define('POSTGRES_PASSWD', 'super#pg#ADMIN');

define('GRAFANA_HOST','127.0.0.1');
define('GRAFANA_DBNAME', 'grafana');
define('GRAFANA_USER', 'pgadmin');
define('GRAFANA_PASSWD', 'super#pg#ADMIN');

//DOMÍNIO CONFIG

define('ZABBIX_BASE', 'cloudnoc.com.br/index.php');
define('GRAFANA_BASE', 'cloudnoc.com.br/grafana');


define('DOCKER_IMAGEM_ZABBIX', 'alpine-4.0-latest');



?>
<?php

$uid = "ciceromelo";
$givenName = "Melo";
$surname = "Cícero";
$password = "@senha123";
$mail = "cicerocav@gatenoc.com.br"; 

$ds = ldap_connect("proxy.gatenoc.com.br","389") or die ("Could not connect to LDAP Server");
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
if ($ds) {
	$r = ldap_bind($ds,"cn=ldapadm,dc=gatenoc,dc=cloud","gate#noc77");
        //verifica se usuário ou e-mail existem.
        $searchUser = ldap_search($ds,"dc=gatenoc,dc=cloud","uid=$uid");
     //   var_dump($searchUser);
        $checkUser = ldap_get_entries($ds,$searchUser);
//var_dump($checkUser);
        $searchMail = ldap_search($ds,"dc=gatenoc,dc=cloud","mail=$mail");
        
        $checkMail = ldap_get_entries($ds,$searchMail);
        
        
        if ("$checkUser[count]" == 0 and "$checkMail[count]" == 0) {
                $info["uid"] = $uid;
                $info["givenName"] = $givenName;
                $info["sn"] = $surname;
                $info["mail"] = $mail;
                $info["objectClass"] = "top";
                $info["objectClass"] = "person";
                $info["objectClass"] = "inetOrgPerson";
                $info["userPassword"] = "{SHA}" . base64_encode( pack( "H*", sha1( $password ) ) );
                $r = ldap_add($ds,"cn=$uid,dc=gatenoc,dc=cloud",$info);
                $sr = ldap_search($ds,"dc=gatenoc,dc=cloud","uid=$uid");
                $confirm = ldap_get_entries($ds,$sr);
                if ($confirm[0]["dn"]) { echo "Usuário criado com sucesso!\n"; }
        } else {
                echo "Usuario já existe.\n";
        }
}
ldap_close($ds);
?>


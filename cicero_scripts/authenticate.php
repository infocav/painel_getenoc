<?php
function authenticate($user, $password) {
	if(empty($user) || empty($password)) return false;

	// active directory server
	$ldap_host = "127.0.0.1";

	// active directory DN (base location of ldap search)
	$ldap_dn = "dc=gatenoc,dc=cloud";

	// active directory manager group name
	$ldap_manager_group = "portal";

	$ldap_ou = 'ou=usuarios,dc=gatenoc,dc=cloud';

	// connect to active directory
	$ldap = ldap_connect($ldap_host);

	// configure ldap params
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

	// verify user and password

	if($bind = @ldap_bind($ldap, "uid=" . $user . "," . $ldap_ou, $password)) {
		// valid
		// check presence in groups
		$filter = "(uid=$user)";
		$attr = array("memberOf");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);

		// check groups
		$access = 0;

		//print_r($entries);

		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			echo $grps;
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }

		}

		if($access != 0) {
			// establish session variables
			$_SESSION['user'] = $user;
			$_SESSION['access'] = $access;
			return true;
		} else {
			// user has no rights
			return false;
		}

	} else {
                // invalid name or password
                return false;

	}
}
?>

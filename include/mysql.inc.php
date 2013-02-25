<?php
DEFINE('DB_USER','adminfoto');
DEFINE('DB_PASSWORD','AZERTY11');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','PhotoForYou');
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_set_charset($dbc, 'utf8');
function get_password_hash($password) 
{
	
	// A besoin de la connexion à la base de données :
	global $dbc;
	
	// Renvoyer le mot de passe échappé :
	return mysqli_real_escape_string ($dbc, sha1($password, false));
	
}
?>

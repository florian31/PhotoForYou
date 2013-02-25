<?php
require('./include/mysql.inc.php');
require('./include/config.inc.php');
include('./include/entete.php');

$_SESSION = array(); // Détruire les variables.
session_destroy(); // Détruire la session elle-même.

include('./include/pieddepage.php');
   
?>

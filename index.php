<?php
require('./include/config.inc.php');
// Réclame la connexion à la base
require (MYSQL);

// Evite la notice lorsque le POST n'est pas encore défini (ex: email)
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	include ('./include/login.inc.php');
}
include('./include/entete.php');
?>

<h3>Bienvenue</h3>
<p>Bienvenue dans PhotoForYou un site pour acheter ou vendre des photos artisiques et professionnelles.</p>

<?php 
    include('./include/pieddepage.php');
?>

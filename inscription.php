<?php
require ('./include/config.inc.php');
require ('./include/mysql.inc.php');
require ('./include/form_functions.inc.php');
// Le fichier config démarre aussi la session.

// Inclure le fichier d'en-tête :
$page_title = 'Inscription';
include ('./include/entete.php');

// Pour stocker les erreurs d'inscription :
$reg_errors = array();

// Vérifier l'envoi du formulaire :
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Vérifier la présence du prénom :
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $_POST['first_name']);
	} else {
		$reg_errors['first_name'] = 'Veuillez indiquer votre prénom !';
	}
	
	// Vérifier la présence du nom de famille :
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_POST['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $_POST['last_name']);
	} else {
		$reg_errors['last_name'] = 'Veuillez indiquer votre nom de famille !';
	}
	
	// Vérifier la présence d'un nom d'utilisateur :
	if (preg_match ('/^[A-Z0-9]{2,30}$/i', $_POST['username'])) {
		$u = mysqli_real_escape_string ($dbc, $_POST['username']);
	} else {
		$reg_errors['username'] = 'Veuillez indiquer le nom d\'utilisateur souhaité !';
	}
	
	// Vérifier la présence d'une adresse e-mail :
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$reg_errors['email'] = 'Veuillez entrer une adresse e-mail correcte !';
	}

	// Vérifier la concordance entre le mot de passe et la confirmation du mot de passe :
	if (preg_match ('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/', $_POST['pass1']) ) {
		if ($_POST['pass1'] == $_POST['pass2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['pass1']);
		} else 
                {
			$reg_errors['pass2'] = 'La confirmation du mot de passe ne correspond pas au mot de passe !';
		}
	} else {
		$reg_errors['pass1'] = 'Veuillez entrer un mot de passe valable !';
	}
	$t=$_POST['type_user'];
	if (empty($reg_errors)) { // Si tout est bon...

		// Vérifier que l'adresse e-mail et le nom d'utilisateur sont disponibles :

		$q = "SELECT email, type FROM users WHERE email='$e' AND type='$t';";
		$r = mysqli_query ($dbc, $q);
		// Récupérer le nombre de lignes renvoyées :
		$rows = mysqli_num_rows($r);
		if ($rows == 0) 
                { // Pas de problème !
			// Ajouter l'utilisateur à la base de données...
			$q = "INSERT INTO users (email,type,prenom,nom,pseudo,motdepasse) VALUES ('$e', '$t', '$fn', '$ln', '$u', '" .  get_password_hash($p)."' )";
			$r = mysqli_query ($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) 
                        { // Si l'exécution a réussi.	
				echo "<h3>Merci ! Inscription Ok !</h3>";
				// Terminer la page :
				include ('./include/pieddepage.php'); // Inclure le pied-de-page HTML.
				exit(); // Arrêter la page.
			} else 
                        { // Si l'exécution n'a pas réussi.
				trigger_error('Votre inscription n\'a pas pu être réalisée en raison d\'une erreur système. Nous regrettons ce désagrément.');
			}	
		} 
                else 
                { // L'adresse e-mail et le type existe déjà !
			$reg_errors['email'] = 'Ce mail avec ce type existe déjà !';			
		} 		
	}
} // Fin de la condition d'envoi du formulaire principal.

// Nécessite le script de fonction du formulaire, qui définit create_form_input() :
?><h3>Inscription</h3>

<form action="inscription.php" method="post" accept-charset="utf-8" style="padding-left:100px">
    <p><label for="first_name"><strong>Prénom</strong></label><br /><?php create_form_input('first_name', 'text', $reg_errors,""); ?></p>
    <p><label for="last_name"><strong>Nom</strong></label><br /><?php create_form_input('last_name', 'text', $reg_errors,""); ?></p>
    <p><label for="username"><strong>Nom d'utilisateur souhaité</strong></label><br /><?php create_form_input('username', 'text', $reg_errors,""); ?> <small>Uniquement des lettres et des chiffres.</small></p>
    <p><label for="type_user"><strong>Type</strong></label><br /><?php create_form_input('type_user', 'select', $reg_errors, array('photographe'=>'photographe','client'=>'client')); ?></p>		
    <p><label for="email"><strong>Adresse e-mail</strong></label><br /><?php create_form_input('email', 'text', $reg_errors,""); ?></p>
    <p><label for="pass1"><strong>Mot de passe</strong></label><br /><?php create_form_input('pass1', 'password', $reg_errors, ""); ?> <small>Entre 6 et 20 caractères, avec au moins une minuscule, une majuscule et un chiffre.</small></p>
    <p><label for="pass2"><strong>Confirmer le mot de passe</strong></label><br /><?php create_form_input('pass2', 'password', $reg_errors,""); ?></p>
    <input type="submit" name="submit_button" value="Suite &rarr;" id="submit_button" class="formbutton" />	
</form>

<?php 
include ('./include/pieddepage.php');
?>
<?php

// Ce script affiche le formulaire d'identification.
// Il est inclus par pieddepage.php si l'utilisateur n'est pas identifié.

// Créer un tableau d'erreur vide s'il n'existe pas encore :
if (!isset($login_errors)) $login_errors = array();

// Nécessite le script des fonctions de formulaire, qui définit create_form_input() :
// Le fichier a peut-être déjà été inclus (par ex. s'il s'agit de register.php ou de forgot_password.php).
require_once ('./include/form_functions.inc.php');
?><div class="title">
	<h4>Identification</h4>
</div>
<form action="index.php" method="post" accept-charset="utf-8">
<p>
    <?php if (array_key_exists('login', $login_errors)) 
        {
	echo '<span class="error">' . $login_errors['login'] . '</span><br />';
	}?><label for="email"><strong>Adresse e-mail</strong></label><br /><?php create_form_input('email', 'text', $login_errors, ''); ?><br /><label for="pass"><strong>Mot de passe</strong></label><br /><?php create_form_input('pass', 'password', $login_errors, ''); ?> <a href="forgot_password.php" align="right">Mot de passe oublié ?</a><br /><input type="submit" value="Login &rarr;"></p>
</form>
<?php 

// Ceci est la page d'identification pour le site.

// Tableau pour enregistrer les erreurs :
$login_errors = array();

// Valider l'adresse e-mail :
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
	$e = mysqli_real_escape_string ($dbc, $_POST['email']);
    } 
    else 
    {
	$login_errors['email'] = 'Veuillez entrer une adresse e-mail valable !';
    }

// Valider le mot de passe :
if (!empty($_POST['pass'])) 
        {
            $p = mysqli_real_escape_string ($dbc, $_POST['pass']);
        } 
        else 
        {
            $login_errors['pass'] = 'Veuillez entrer votre mot de passe !';
        }
	
if (empty($login_errors)) { // OK pour continuer !

	// Interroger la base de données :
	$q = "SELECT email, type, motdepasse, pseudo  FROM users WHERE (email='$e' AND motdepasse='"  .  get_password_hash($p) .  "')";		
	$r = mysqli_query ($dbc, $q);
	
	if (mysqli_num_rows($r) == 1) 
       { // Une correspondance a été trouvée.
		
		// Récupérer les données :
		$row = mysqli_fetch_array ($r, MYSQLI_NUM); 
		
		// Si l'utilisateur est un administrateur, créer un nouvel identifiant de session pour être sûr :
		if ($row[1] == 'admin') 
                {
			session_regenerate_id(true);
			$_SESSION['user_admin'] = true;
		}
		
		// Stocker les données dans une session :
		$_SESSION['user_id'] = $row[0];
		$_SESSION['username'] = $row[3];
		
		// Indiquer uniquement si le compte de l'utilisateur n'a pas expiré:
		if ($row[3] == 1) $_SESSION['user_not_expired'] = true;
			
	} else { // Aucune correspondance n'a été trouvée.
		$login_errors['login'] = 'L\'adresse e-mail et le mot de passe ne correspondent pas à ceux en mémoire.';
	}
	
} // Fin de $login_errors IF.

// Omettre la balise PHP fermante pour éviter les erreurs de type "en-têtes déjà envoyés" !
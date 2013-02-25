
		<div class="sidebar">	
			
			<!-- CADRE LATERAL -->
			
<?php 
    // Afficher les infos utilisateur ou le formulaire d'identification :
 if (isset($_SESSION['user_id'])) 
        {
           //
	
	}
					
     else 
        { // Afficher le formulaire d'identification :
	
	require ('include/login_form.inc.php');
	
        }
?>

		</div>
		
		<div class="footer">
			<p><a href="site_map.php" title="Plan du site">Plan du site</a> | <a href="policies.php" title="Politique du site">Politique</a> &nbsp; - &nbsp; &copy; Savoir c'est pouvoir &nbsp; - &nbsp; Conception par <a href="http://www.spyka.net">spyka webmaster</a></p> 
	<h4>Connecté en tant que :  
	<?php 
        if (isset($_SESSION['username'])) 
        {
		echo $_SESSION['username']; 
                echo "<p><a href='deconnexion.php'>Deconnexion</a></p>";
        }
		else echo 'visiteur anonyme'; 
       ?> 
	</h4>

		</div>	
	</div>
</div>
</body>
</html>
<?php
require('./include/mysql.inc.php');
require('./include/config.inc.php');
include('./include/entete.php');
?>
    <div id="body">
	<div id="content">
      
        </div>
        
        
    <?php
    if (isset($_POST['email']) && isset($_POST['pass'])) 
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        unset($_SESSION['user']);
        if ($email=="toto@toto.fr" and $pass=="toto")
        {
            $_SESSION['user']=10;
      
        }
    }
    include('./include/cotedroit.php');
    include('./include/pieddepage.php');
   
    ?>
</div>
</body>
</html>

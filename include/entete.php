<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sworm - Free CSS Template by spyka Webmaster</title>
<link rel="stylesheet" href="./css/styles.css" type="text/css" />
<!--
sworm, a free CSS web template by spyka Webmaster (www.spyka.net)

Download: http://www.spyka.net/web-templates/sworm/

License: Creative Commons Attribution
//-->
<!--  connection PHP à la base de données //-->
</head>
<body>
<div id="container">
	<div id="header">
    	<h1><a href="./index.php">PhotoForYou</a></h1>
        <h2>Des photos de pros pour les pros</h2>
        <div class="clear"></div>
    </div>
    <div id="nav">
    	<ul>
            <?php
               // connection à la base données
               $q='SELECT * FROM Menu WHERE NomMenu is not null;';
               $r=mysqli_query($dbc,$q);
               $pageactive=basename($_SERVER['PHP_SELF']);
               
               while(list($id,$nom,$url)=mysqli_fetch_array($r,MYSQLI_NUM))
               {   
                   echo '<li';
                   if ($pageactive == $url) echo ' class="selected"';
                   echo '><a href='.$url.'>'.$nom.'</a></li>';
               }
            ?>
        </ul>
    </div>
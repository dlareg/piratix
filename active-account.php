<?php
// Redirige l'utilisateur s'il est déjà identifié
session_start();
if (isset($_SESSION['login'])) {
   header ('Location: index.php');
   exit();
}
else
{
require("include/settings.php");
require("include/config.php");
require("include/functions.php");

    
     // Vérifie que de bonnes valeurs sont passées en paramètres
     if(!ereg("^[0-9]+$", $_GET["id"]) || !ereg("^[a-f0-9]{8}$", strtolower($_GET["clef"])))
     {
          header("Location: index.php");
     }
     else
     {
         // Connexion à la base de données
	  $base = mysql_connect ($serveurdb, $logindb, $passworddb);
	  mysql_select_db ($basedb, $base);

         // Sélection de l'utilisateur concerné
          $result = mysql_query("SELECT iduser, activeuser, activeuserkey FROM users WHERE iduser = '" . $_GET["id"] . "' AND activeuserkey = '" . strtolower($_GET["clef"]) . "'");

         // Si une erreur survient
          if(!$result)
          {
               $message = "Une erreur est survenue lors de l'activation de votre compte utilisateur...";
          }
          else
          {
               
               // Si aucun enregistrement n'est trouvé
               if(mysql_num_rows($result) == 0)
               {
                    header("Location: index.php");
               }
               else
               {
                   
               // Récupération du tableau de données retourné
               $row = mysql_fetch_array($result);
                    
               // Vérification que le compte ne soit pas déjà activé
               if($row["activeuser"] != 0)
                    {
                         $message = "<span style=\"color: red; font-weight: bold; font-size: 11pt;\">Votre compte utilisateur a déjà été activé !</span><br /><br /><br />";
                    }
                    else
                    {
                        // Activation du compte utilisateur
                         $result = mysql_query(" UPDATE users SET activeuser = '1' WHERE iduser = '" . $_GET["id"] . "' AND activeuserkey = '" . strtolower($_GET["clef"]) . "'");
                         
                         // Si une erreur survient
                         if(!$result)
                         {
                              $message = "Une erreur est survenue lors de l'activation de votre compte utilisateur.";
                         }
                         else
                         {
                              $message = "<span style=\"color: green; font-weight: bold; font-size: 11pt;\">Votre compte utilisateur a correctement été activé !<br />
				Vous pouvez vous connecter dès maintenant sur le site avec vos identifiants.</span><br /><br />";
                         }
                         
                    }
                    
               }
               
          }
          
          // Fermeture de la connexion à la base de données
          mysql_close();
          
     }
     
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?php echo $DEFAULTLANGUAGE; ?>" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
        <title><?php echo $SITENAME; ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=<?php echo $DEFAULTCHARSET; ?>" />
        <link rel="stylesheet" href="<?php echo $DEFAULTSTYLE; ?>" type="text/css" media="all" />
        <!--[if IE 6]>
                <link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-func.js"></script>
</head>
<body>

<!-- Shell -->
<div id="shell">

        <!-- Header -->
        <div id="header">
                <!-- Logo -->
                <h1 id="logo"><a href="index.php"><?php echo $SITENAME; ?></a></h1>
                <!-- /Logo -->
                <div class="top-bar">
                        <!-- Header Links -->
                        <div class="links">
                                <?php
                                   include("header-links.php");
                                ?>
                        </div>
                        <!-- /Header Links -->

                        <div class="cl">&nbsp;</div>

                        <!-- Search -->
                        <div id="search">
                                <form action="recherche.php" method="post">
                                        <!--<label for="search-string">IM LOOKING FOR</label>-->
                                        <div class="fields">
                                                <input type="text" value="Rechercher ..." title="Rechercher ..." id="search-string" name="requete" class="field" />
                                                <input type="submit" value="" class="submit" />
                                        </div>
                                </form>
                        </div>
                        <!-- /Search -->
                </div>
        </div>
        <!-- /Header -->

<!-- Navigation -->
        <div id="navigation">
           <ul>
              <li><a href="index.php">ACCUEIL</a></li>
              <li><a href="torrents.php">TORRENTS</a></li>
              <li><a href="upload.php">UPLOAD</a></li>
              <li><a href="categories.php">CATEGORIES</a></li>
              <li><a href="stats.php" class="active">STATS</a></li>
              <li><a href="forum.php">FORUM</a></li>
			  <li><a href="news.php">NEWS</a></li>
              <li><a href="membres.php">MEMBRES</a></li>
              <li><a href="contact.php">CONTACT</a></li>
              <li><a href="apropos.php">A PROPOS</a></li>
           </ul>
              <div class="cl">&nbsp;</div>
        </div>
<!-- /Navigation -->
	
<!-- Main -->
<div id="main">
	
	<!-- Content -->
	<div id="content">

	<div class="box last">
	<h2><span>Créer un compte sur Piratix</span></h2>
	<br /><br /><br /><br />

	<p><?php echo $message; ?></p>

	<br />
	</div>			
									
		<div class="cl">&nbsp;</div>	
	</div>
	<!-- /Content -->
		
<!-- sidebar -->
	<?php
	   include_once("sidebar.php");
	?>
		
	<div class="cl">&nbsp;</div>
</div>
<!-- /Main -->
	
<!-- bottom et footer -->
<?php
   include_once("bottom.php");
   include_once("footer.php");
?>
	
</div>
<!-- /Shell -->

</body>

</html>

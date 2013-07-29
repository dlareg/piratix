<?php

session_start();
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

else
{
require("include/settings.php");
require("include/config.php");
require("include/functions.php");

     // Formulaire visible par défaut
     $masquer_formulaire = false;

     // Une fois le formulaire envoyé
     if(isset($_POST["inscription"]))
     {
        // Vérification de la validité des champs
          
	if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z=!:#|*$&<>]{6,}/', $_POST["pass"]))
        {
            $message = "<h4 style=\"color:red;\">Votre mot de passe doit comporter au moins 6 caractères !";
	    $message .= "<br/>En outre, il doit comporter au moins un chiffre et une lettre.";
	    $message .= "<br/>Vous pouvez également choisirs les caractères spéciaux suivants : =!:*$&<>#|</h4>";
          }
		  
	elseif($_POST["pass"] != $_POST["pass_confirm"])
        {
            $message = "<h4 style=\"color:red;\">Les deux mots de passe sont différents.</h4>";
        }
          
        else
        {

	// Connexion à la base de données
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);

	$sessionlogin = $_SESSION['login'];
	$sessionid = $_SESSION['id'];

	$result = mysql_query("UPDATE users SET passuser='" . sha1($_POST["pass"]) . "' WHERE iduser='" . $sessionid . "'");

                         if(!$result)
                         {
                           $message = "<h4 style=\"color:red;\">Erreur d'accès à la base de données lors de la création du compte utilisateur.</h4>";
                         }
                         else
                         {
                            // Envoi du mail d'activation
                            $sujet = "Changement de votre mot de passe sur ".$SITENAME;
							  
				$sql = "SELECT * FROM users WHERE iduser='" . $sessionid . "'"; 
				$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				$data = mysql_fetch_assoc($req);
						
				$mailuser = $data['mailuser'];

				$message = "Bonjour,\n";
				$message .= "Vous venez de changer votre mot de passe pour votre compte " . $sessionlogin . " sur http://" . $SITENAME . ".\n";
                            	$message .= "Voici un rappel de vos identifiants :\n";
				$message .= "Login : " . $sessionlogin . " \n";
				$message .= "Mot de passe : " . $_POST['pass'] . " \n\n";
				$message .= "Cordialement,\n\n";
				$message .= "L'equipe de " . $SITENAME;

                            // Si une erreur survient
                            if(!@mail($mailuser, $sujet, $message, "From: contact@piratix.mumbly58.net Admin\r\n"."Reply-To: contact@piratix.mumbly58.net\r\n"))
                            {
                                $message = "<h4 style=\"color:red;\">Une erreur est survenue lors de l'envoi du mail d'activation.<br />\n";
                                $message .= "Veuillez contacter l'administrateur (contact AT piratix.mumbly58.net) afin d'activer votre compte.</h4>";
                            }
                            else
                            {
                            // Message de confirmation
                            $message = "<h4 style=\"color: green; font-size: 10pt; font-weight: bold;\">Votre mot de passe a été changé avec succès !<br />\n";
                            $message .= "Un email vient de vous être envoyé avec vos nouveaux identifiants.</h4>";

                            // On masque le formulaire
                            $masquer_formulaire = true;

                              }

                         }

                    }

               }

          // Fermeture de la connexion à la base de données
          mysql_close();

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
        <?php
           include_once("navigation.php");
        ?>
<!-- /Navigation -->

	
<!-- Main -->
<div id="main">
	
	<!-- Content -->
	<div id="content">

	<div class="box last">
	<h2><span>Modification de votre mot de passe</span></h2>
	<br /><br /><br />

<?php if(isset($message)) { ?>
<p><?php echo $message; ?></p>
<?php } if($masquer_formulaire != true) { ?>

<form action="modif_pass.php" method="post">
      <p>
          Nouveau mot de passe : <input type="password" name="pass" />
     </p><br />
     <p>
          Confirmation du nouveau mot de passe : <input type="password" name="pass_confirm" />
     </p><br />
      <p>
          <input type="submit" name="inscription" value="Envoyer" />  <input type="reset" value="Annuler" />
     </p><br />
</form>

<?php } ?>

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

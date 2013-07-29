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

     // Formulaire visible par défaut
     $masquer_formulaire = false;

     // Une fois le formulaire envoyé
     if(isset($_POST["inscription"]))
     {

          // Vérification de la validité des champs
          if(!preg_match('/^[A-Za-z0-9_]{4,20}$/', $_POST["login"]))
          {
               $message = "<h4 style=\"color:red;\">Votre nom d'utilisateur doit comporter entre 4 et 20 caractères<br />\n";
               $message .= "Seule l'utilisation du caractère underscore ( _ ) est autorisée</h4>";
          }
          //elseif(!preg_match('/^[A-Za-z0-9]{6,}$/', $_POST["pass"]))
	  elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z=!:#|*$&<>]{6,}/', $_POST["pass"]))
          {
               $message = "<h4 style=\"color:red;\">Votre mot de passe doit comporter au moins 6 caractères !";
	       $message .= "<br/>En outre, il doit comporter au moins un chiffre et une lettre.";
	       $message .= "<br/>Vous pouvez également choisirs les caractères spéciaux suivants : =!:*$&<>#|</h4>";
          }
          elseif($_POST["pass"] != $_POST["pass_confirm"])
          {
               $message = "<h4 style=\"color:red;\">Les deux mots de passe sont différents.</h4>";
          }
          elseif(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$/', $_POST["email"]))
          {
               $message = "<h4 style=\"color:red;\">Votre adresse e-mail n'est pas valide.</h4>";
          }
          else
          {

               // Connexion à la base de données
               $base = mysql_connect ($serveurdb, $logindb, $passworddb);
               mysql_select_db ($basedb, $base);


               // Vérification de l'unicité du nom d'utilisateur et de l'adresse e-mail
               $result = mysql_query("SELECT nomuser, mailuser FROM users WHERE nomuser = '" . $_POST["login"] . "' OR mailuser = '" . $_POST["email"] . "'");

               // Si une erreur survient
               if(!$result)
               {
                    $message = "<h4 style=\"color:red;\">Erreur d'accès à la base de données lors de la vérification d'unicité.</h4>";
               }
               else
               {

                    // Si un enregistrement est trouvé
                    if(mysql_num_rows($result) > 0)
                    {

                         while($row = mysql_fetch_array($result))
                         {

                              if($_POST["login"] == $row["nomuser"])
                              {
                                   $message = "<h4 style=\"color:red;\">Le nom d'utilisateur " . $_POST["login"];
                                   $message .= " est déjà utilisé !</h4>";
                              }
                              elseif($_POST["email"] == $row["mailuser"])
                              {
                                   $message = "<h4 style=\"color:red;\">L'adresse e-mail " . $_POST["email"];
                                   $message .= " est déjà utilisée</h4>";
                              }

                         }

                    }
                    else
                    {

                         // Génération de la clef d'activation
                         $caracteres = array("a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
                         $caracteres_aleatoires = array_rand($caracteres, 8);
                         $clef_activation = "";

                         foreach($caracteres_aleatoires as $i)
                         {
                              $clef_activation .= $caracteres[$i];
                         }


                         // Création du compte utilisateur

                         // on calcule le torrent_pass qui nou servira aussi de PID
                         $pid=md5(uniqid(rand(),true));

                         $result = mysql_query("INSERT INTO users(nomuser, passuser, mailuser, dateuser, activeuserkey, pid) VALUES('" . $_POST["login"] . "', '" . sha1($_POST["pass"]) . "', '" . $_POST["email"] . "', '" . time() . "', '" . $clef_activation . "', '" . $pid . "')");

                         $newuid=mysql_insert_id();

                         // On insert aussi dans la base xbt_user du tracker
                         $result2 = mysql_query("INSERT INTO xbt_users (uid, torrent_pass) VALUES ($newuid,'$pid')");

                         // Si une erreur survient
                         if(!$result || !$result2)

                         {
                              $message = "<h4 style=\"color:red;\">Erreur d'accès à la base de données lors de la création du compte utilisateur.</h4>";
                         }
                         else
                         {

                              // Envoi du mail d'activation
                              $sujet = "Activation de votre compte utilisateur sur ".$SITENAME;

			      $headers ='From: "Piratix"<contact@piratix.mumbly58.net>'."\n";
     			      $headers .='Reply-To: contact@piratix.mumbly58.net'."\n";
     			      $headers .='Content-Type: text/html; charset="utf-8"'."\n";
     			      $headers .='Content-Transfer-Encoding: 8bit'; 

			      $message = "Bonjour,\n";
			      $message .= "Vous vous etes inscrit(e) sur le site http://" . $SITENAME . ".\n";
                              $message .= "Pour valider votre inscription, merci de cliquer sur le lien suivant :\n";
                              $message .= "http://" . $_SERVER["SERVER_NAME"];
                              $message .= "/active-account.php?id=" . mysql_insert_id();
                              $message .= "&clef=" . $clef_activation . "\n\n";
			      $message .= "Cordialement,\n\n";
			      $message .= "L'equipe de " . $SITENAME;

                              // Si une erreur survient
                              if(!@mail($_POST["email"], $sujet, $message, $headers))
                              {
                                   $message = "<h4 style=\"color:red;\">Une erreur est survenue lors de l'envoi du mail d'activation.<br />\n";
                                   $message .= "Veuillez contacter l'administrateur (contact AT piratix.mumbly58.net) afin d'activer votre compte.</h4>";
                              }
                              else
                              {

                                   // Message de confirmation
                                                $message = "<h4 style=\"color: green; font-size: 10pt; font-weight: bold;\">Votre compte utilisateur a correctement été créé.<br />\n";
                                                $message .= "Un email vient de vous être envoyé afin d'activer votre compte.</h4>";

                                   // On masque le formulaire
                                   $masquer_formulaire = true;

                              }

                         }

                    }

               }

          // Fermeture de la connexion à la base de données
          mysql_close();

          }

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
        <?php
           include_once("navigation.php");
        ?>
<!-- /Navigation -->

	
<!-- Main -->
<div id="main">
	
	<!-- Content -->
	<div id="content">

	<div class="box last">
	<h2><span>Créer un compte sur Piratix</span></h2>
	<br /><br /><br />

<?php if(isset($message)) { ?>
<p><?php echo $message; ?></p>
<?php } if($masquer_formulaire != true) { ?>

<form action="signup.php" method="post">
     <p>
          Nom d'utilisateur : <input type="text" name="login" />
     </p><br />
     <p>
          Mot de passe : <input type="password" name="pass" /> (6 caractères minimum, 1 lettre et 1 chiffre au moins, caractères spéciaux autorisés : =!:#|*$&<>)
     </p><br />
     <p>
          Confirmation du mot de passe : <input type="password" name="pass_confirm" />
     </p><br />
     <p>
          Adresse e-mail : <input type="text" name="email" />
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

<?php

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

/*
1 - on récupère $_POST['email'] rentré dans le questionnaire
2 - on cherche à qui appartient cet e-mail dans la base sql
3 - si on trouve, on calcule un nouveau mot de passe
4 - on insert le nouveau mot de passe en sha1 dans la base sql
5 - on envoie un e-mail avec le mot de passe non codé
6 - on affiche un message de réussite
7 - si on NE TROUVE PAS l'e-mail
*/


// Une fois le formulaire envoyé
if(isset($_POST["recuperationpass"]))
{

if(!empty($_POST['email'])) {
   $email = $_POST['email'];
}
else {
   $erreur = "Veuillez renseigner votre adresse email";
}

$sql = "SELECT mailuser FROM users WHERE mailuser = '".$email."' ";
$req = mysql_query($sql) or die ('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if(mysql_num_rows($req) != 1) { //si le nombre de lignes retourne par la requete != 1
   $erreur = "Adresse e-mail inconnue.";
}
else
{
$row1 = mysql_fetch_assoc($req);
$retour = mysql_query("SELECT passuser FROM users WHERE mailuser = '".$email."' ");
$row2 = mysql_fetch_assoc($retour); //contient le mot de passe que l'on a perdu (ancien mot de passe)
$new_password = fct_passwd(); //création d'un nouveau mot de passe

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Piratix <contact@piratix.mumbly58.net>'."\r\n";
//$headers .= '\r\n';

$objet = 'Votre nouveau mot de passe sur piratix.mumbly58.net';

$message = "Bonjour,<br/>\n";
$message .= "Vous avez demandé un nouveau mot de passe pour votre compte sur http://" . $SITENAME . ".<br/>\n";
$message .= "Votre nouveau mot de passe est : " . $new_password . "<br/>\n\n";
$message .= "Cordialement,<br/>\n\n";
$message .= "L'equipe de " . $SITENAME;


if(!mail($row1['mailuser'], $objet, $message, $headers)) {
   $erreur = "Problème lors de l'envoi du mail.";
}
else {
//mise à jour de la base de données de l'utilisateur
   $req = "UPDATE users SET passuser = '".sha1($new_password)."' WHERE mailuser = '".$email."' ";
   mysql_query($req);
   $cok = "Un mail contenant votre nouveau mot de passe vous a été envoyé.<br/>
    Veuillez le consulter avant de vous reconnecter sur " . $SITENAME;
}

}

//mysql_close($conn);
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
           <h2><span>Vous avez oublié votre mot de passe ?</span></h2>
           <br /><br /><br />

	<!-- formulaire -->
<form action="recup_pass.php" method="post">
     <p>
     <h4>Vous aller faire une demande de nouveau mot de passe. Ce nouveau mot de passe vous sera envoyé par e-mail.<br/>
     Une fois connecté avec vos identifiants, vous pourrez éventuellement redéfinir un mot de passe à partir de la page de votre profil.<br/>
     Veuillez donc entrer ci-dessous l'adresse e-mail correspondant à votre compte :</h4>
	 </p><br/><br/>
	
     <p>
          Entrez votre adresse e-mail : <input type="text" name="email" />
     </p><br />
     <p>
          <input type="submit" name="recuperationpass" value="Envoyer" />  <input type="reset" value="Annuler" />
     </p><br />
</form>	
	
	
	<?php
	   if (isset($erreur)) echo '<br /><br /><h4 style="color: red;">ERREUR : ' . $erreur . '</h4>';
	   elseif (isset($cok)) echo '<br /><br /><h4 style="color: green;">' . $cok . '</h4>';
	?>

	   <br/><br/>

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

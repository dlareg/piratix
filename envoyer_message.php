<?php
session_start();
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

// on teste si le formulaire a bien été soumis
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') {
	if (empty($_POST['destinataire']) || empty($_POST['titre']) || empty($_POST['message'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	else {
		$base = mysql_connect ($serveurdb, $logindb, $passworddb);
		mysql_select_db ($basedb, $base);

		// si tout a été bien rempli, on insère le message dans notre table SQL
		$sql = 'INSERT INTO messages VALUES("", "'.$_SESSION['id'].'", "'.$_POST['destinataire'].'", "'.date("Y-m-d H:i:s").'", "'.mysql_escape_string($_POST['titre']).'", "'.mysql_escape_string($_POST['message']).'")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		mysql_close();

		header('Location: index.php');
		exit();
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
	<h2><span>Envoyer un message privé</span></h2>
	<br /><br /><br />

	<?php
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);

	// on prépare une requete SQL selectionnant tous les login des membres du site en prenant soin de ne pas selectionner notre propre login,
	// le tout, servant à alimenter le menu déroulant spécifiant le destinataire du message
	$sql = 'SELECT users.nomuser as nom_destinataire, users.iduser as id_destinataire, users.activeuser FROM users WHERE iduser <> "'.$_SESSION['id'].'" AND iduser = "'.mysql_real_escape_string($_GET['idexp']).'" AND activeuser > "0" AND iduser > "1"';
// on lance notre requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows ($req);

if ($nb == 0) {
	// si aucun membre n'a été trouvé, on affiche tout simplement aucun formulaire
	echo 'Hey ! Vous ne pouvez pas vous écrire à vous même !?!';
}
else {
	// si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
	?>
	<form action="envoyer_message.php" method="post">
	Pour : <select name="destinataire">
	<?php
	// on alimente le menu déroulant avec les login des différents membres du site
	while ($data = mysql_fetch_array($req)) {
		echo '<option value="' , $data['id_destinataire'] , '">' , stripslashes(htmlentities(trim($data['nom_destinataire']))) , '</option>';
	}
	?>
	</select><br /><br />

	<?php
	$sql1 = 'SELECT * FROM messages WHERE id_message="'.mysql_real_escape_string($_GET['idmessage']).'"';
	$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
	$result1 = mysql_fetch_assoc ($req1);

	if (empty($result1['titre_message'])) {
	?>
	   Titre : <input type="text" size="80" name="titre" value="<?php if (isset($_POST['titre'])) echo stripslashes(htmlentities(trim($_POST['titre']))); ?>"><br /><br />
	<?php
	}
	else {
	?>
	   Titre : <input type="text" size="80" name="titre" value="RE: <?php echo stripslashes(trim(htmlentities($result1['titre_message'], ENT_QUOTES, 'UTF-8'))); ?>"><br /><br />
	<?php
	}
	?>
	Message : <textarea rows="10" cols="82" name="message"><?php if (isset($_POST['message'])) echo stripslashes(trim(htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'))); ?></textarea><br /><br />
	<input type="submit" name="go" value="Envoyer">  <input type="reset" value="annuler">
	</form>

	<?php
	}

	mysql_free_result($req);
	mysql_close();
	?>
</select>

<?php
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;
?>

	<br /><br />
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

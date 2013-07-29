<?php
session_start();
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

require("include/settings.php");
require("include/config.php");
require("include/functions.php");
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
	<h2><span>Messagerie interne</span></h2>
	<br /><br /><br />

	<h4><a href="envoyer_message.php"><img src="images/repondre.png" alt="" />Envoyer un nouveau message privé</a></h4><br />

	<?php
	// on teste si notre paramètre existe bien et qu'il n'est pas vide
	//if (!isset($_GET['id_message']) || empty($_GET['id_message'])) {
	//   echo 'Aucun message reconnu.';
	//}

	//else {
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);

	// on prépare une requete SQL selectionnant la date, le titre et l'expediteur du message que l'on souhaite lire, tout en prenant soin de vérifier que le message appartient bien au membre connecté
	//$sql = 'SELECT titre_message, date_message, message, users.nomuser as expediteur FROM messages, users WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=users.iduser AND messages.id_message="'.$_GET['id_message'].'"';
	$sql = 'SELECT id_message, titre_message, date_message, message, users.iduser, users.nomuser as expediteur FROM messages, users WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=users.iduser';

	// on lance cette requete SQL à MySQL
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);

	if ($nb == 0) {
		echo '<br /><div style="border: 1px coral solid; padding: 7px 10px 0 10px; text-align: center;"><h4>Vous n\'avez aucun message privé.</h4></div>';
		//echo '<br /><h4><a href="envoyer_message.php">Envoyer un message</a></h4>';
	}
	else {
		// si le message a été trouvé, on l'affiche
		while ($data = mysql_fetch_array($req)) {
                echo '<div style="border: 1px coral solid; padding: 7px 10px 0 10px;">';
                echo '<div style="background: #FFFECC;">';
		echo '<span style="font-weight: bold;">Expéditeur :</span> ' , stripslashes(htmlentities(trim($data['expediteur']))) , '<br/>';
		echo '<span style="font-weight: bold;">Date :</span> ' . $data['date_message'] , '<br/>';
		echo '<span style="font-weight: bold;">Titre :</span> ' . stripslashes(trim(htmlentities($data['titre_message'], ENT_QUOTES, 'UTF-8'))) . '';
		echo '</div>';
		echo '<p style="text-align: justify; font-size: 12px; padding: 5px 5px 5px 5px;">' . nl2br(stripslashes(trim(htmlentities($data['message'], ENT_QUOTES, 'UTF-8')))) . '</p>';

		// on ajoute la possibilité de répondre à l'auteur du message privé
		// on affiche également un lien permettant de supprimer ce message de la boite de réception
		echo '<p style="text-align: right;"><a href="envoyer_message.php?idexp=' . $data['iduser'] . '&idmessage=' . $data['id_message'] . '"><img src="images/edit.png" alt="" /> Répondre à ce message</a> <a href="supprimer_message.php?id_message=' . $data['id_message'] . '"><img src="images/delete.jpg" alt="" /> Supprimer ce message</a></p>';
		echo '<br /></div><br />';
		}
	}
	mysql_free_result($req);
	mysql_close();
//}
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

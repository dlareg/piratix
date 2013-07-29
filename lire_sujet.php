<?php

/*
session_start();
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}
*/

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
        <div id="navigation">
           <ul>
              <li><a href="index.php">ACCUEIL</a></li>
              <li><a href="torrents.php">TORRENTS</a></li>
              <li><a href="upload.php">UPLOAD</a></li>
              <li><a href="categories.php">CATEGORIES</a></li>
              <li><a href="stats.php">STATS</a></li>
              <li><a href="forum.php" class="active">FORUM</a></li>
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
	<h2><span>Forum</span></h2>

	<br /><br /><br />

<?php
if (!isset($_GET['id_sujet_a_lire'])) {
	echo 'Sujet non défini.';
}
else {
?>
	<table style="width: 100%;">
	   <tr class="tableTitle">
	      <td><h4>Auteur</h4></td>
	      <td><h4>Messages</h4></td>
	   </tr>
	   
	<?php
	// on se connecte à notre base de données
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base) ;

	// on prépare notre requête
	$sql = 'SELECT auteur_forum_reponse, message_forum_reponse, date_reponse FROM forum_reponses WHERE correspondance_sujet="'.$_GET['id_sujet_a_lire'].'" ORDER BY date_reponse ASC';

	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	// on va scanner tous les tuples un par un
	while ($data = mysql_fetch_array($req)) {

		// on décompose la date
		sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

		// on affiche les résultats
		echo '<tr>';
		echo '<td class="tableRow2" style="width: 20%;">';

		// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
		echo 'Par ' . htmlentities(trim($data['auteur_forum_reponse']));
		echo '<br />le ';
		echo $jour , '-' , $mois , '-' , $annee , ' à ' , $heure , ':' , $minute;
		echo '<br /><br />';
		echo '</td><td class="tableRow1">';

		// on affiche le message
		echo '<p style="text-align: justify; font-size: 12px; padding: 5px 5px 5px 5px;">';
		//echo nl2br(htmlentities(trim($data['message_forum_reponse'])));
		echo nl2br(htmlentities($data['message_forum_reponse'], ENT_QUOTES, 'UTF-8'));
		echo '</p></td></tr>';
	}

	// on libère l'espace mémoire alloué pour cette reqête
	mysql_free_result ($req);
	// on ferme la connection à la base de données.
	mysql_close ();
	?>

	<!-- on ferme notre table html -->
	</table>
	<br /><br />
	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
	<a href="./insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>"><img src="images/button_topic_reply.gif" alt="" /></a>
	<?php
	   }
	?>

<br /><br />

<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<br /><br />
   <a href="forum.php">Retour au forum</a>
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

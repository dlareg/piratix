<?php
session_start();
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
	<h2><span>Toutes les news</span></h2>
	<br /><br /><br />

<?php
// on se connecte à notre base
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db($basedb, $base);

// lancement de la requête. on sélectionne les news que l'on va ordonner suivant l'ordre "inverse" des dates (de la plus récente à la plus vieille : DESC) tout en ne sélectionnant que le nombre voulu de news à afficher (LIMIT)
$sql = 'SELECT auteur_news, titre_news, date_news, texte_news FROM news ORDER BY date_news DESC;';

// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on compte le nombre de news stockées dans la base de données
$nb_news = mysql_num_rows($req);

if ($nb_news == 0) {
	echo '<br /><br /><br />Aucune news enregistrée.<br /><br /><br />';
}
else {
		if (!empty($_SESSION['login'])) {
                $sql2 = 'SELECT * FROM users WHERE nomuser = "' . $_SESSION['login'] . '"';
                $req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
                $result2 = mysql_fetch_array($req2);

                if ($result2['isadmin'] == 1) {
                   echo '<tr><h4><a href="insert-news.php">Nouvelle news</a></h4></tr>';
                }
		}
	// si on a au moins une news, on l'affiche
	while ($data = mysql_fetch_array($req)) {

		// on décompose la date
		sscanf($data['date_news'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);

		// on affiche les résultats
		echo '<table style="width: 100%;"';
		   echo '<tr class="tableTitle">';
		      echo '<td><h5>News de : ' , htmlspecialchars(trim($data['auteur_news'])) , '</h5></td>';
		      echo '<td><h4>Titre : ' , htmlspecialchars(trim($data['titre_news'])) , '</h4></td>';
		      echo '<td colspan="2"><span style="font-style: italic; font-size: 12px;">Postée le : ' , $jour , '/' , $mois , '/' , $an , ' à ' , $heure , ':' , $min , ':' , $sec , '</span></td>';
		   echo '</tr>';
		   echo '<tr class="tableRow2">';
		      echo '<td colspan="4" style="padding: 5px 5px 5px 5px;"><p style="text-align: justify; font-size: 12px;">' , nl2br(htmlspecialchars(trim($data['texte_news']))) , '</p></td>';
		   echo '</tr><br />';
		echo '</table>';
	}
}
// on libère l'espace mémoire alloué à cette requête
mysql_free_result ($req);

// on ferme la connexion à la base de données
mysql_close ();
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

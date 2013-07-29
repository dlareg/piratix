<?php


session_start();

/*
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}
*/

require_once("include/settings.php");
require_once("include/config.php");
require_once("include/functions.php");
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
	<h2><span>Forum</span></h2>

	<!-- on place un lien permettant d'accéder à la page contenant le formulaire d'insertion d'un nouveau sujet -->
	<br /><br /><br /><a href="./insert_sujet.php"><img src="images/button_topic_new.gif" alt="" style="" /></a>

	<br /><br />

	<?php
	// on se connecte à notre base de données
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base) ;

	// préparation de la requete
	$sql = 'SELECT * FROM forum_sujets ORDER BY date_derniere_reponse DESC';

	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	// on compte le nombre de sujets du forum
	$nb_sujets = mysql_num_rows ($req);

	if ($nb_sujets == 0) {
	echo '<br />Aucun sujet<br /><br />';
	}
	else {
	?>

	<table style="width: 100%;">
	   <tr class="tableTitle">
	      <td>&nbsp;Auteur</td>
	      <td>&nbsp;Titre du sujet</td>
	      <td>&nbsp;Date dernière réponse</td>
	   </tr>
	<?php
	// on va scanner tous les tuples un par un
	while ($data = mysql_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date_derniere_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

	// on affiche les résultats
	echo '<tr style="font-size: 12px;">';
	echo '<td class="tableRow2">';

	// on affiche le nom de l'auteur de sujet
	echo htmlentities(trim($data['auteur_forum']));
	echo '</td><td class="tableRow1">';

	// on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
	echo '<a href="./lire_sujet.php?id_sujet_a_lire=' , $data['id_forum'] , '">' , htmlentities(trim($data['titre_forum'])) , '</a>';

	echo '</td><td class="tableRow1">';

	// on affiche la date de la dernière réponse de ce sujet
	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
	}
	?>
	</td></tr></table>
	<?php
	}

	// on libère l'espace mémoire alloué pour cette requête
	mysql_free_result ($req);

	// on ferme la connexion à la base de données.
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

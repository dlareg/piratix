<?php
session_start();
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste le contenu de la variable $auteur
	if (!isset($_POST['auteur']) || !isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
		$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
		if (empty($_POST['auteur']) || empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
			$erreur = 'Au moins un des champs est vide.';
		}
		// si tout est bon, on peut commencer l'insertion dans la base
		else {
			// on se connecte à notre base de données
			$base = mysql_connect ($serveurdb, $logindb, $passworddb);
			mysql_select_db ($basedb, $base) ;

			// on recupere la date de l'instant présent
			$date = date("Y-m-d H:i:s");

			// préparation de la requête d'insertion (table forum_reponses)
			$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysql_escape_string($_POST['auteur']).'", "'.mysql_escape_string($_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'")';

			// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

			// préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
			$sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id_forum="'.$_GET['numero_du_sujet'].'"';

			// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

			// on ferme la connexion à la base de données
			mysql_close();

			// on redirige vers la page de lecture du sujet en cours
			header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet']);

			// on termine le script courant
			exit;
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
	<h2><span>Forum</span></h2>

	<br /><br /><br />

<form action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="post">
<table>
<tr><td>
<span class="gras">Auteur :</span>
</td><td>
<input type="text" name="auteur" maxlength="30" size="50" value="<?php echo $_SESSION['login']; ?>">
</td></tr><tr><td>
<span class="gras">Message :</span>
</td><td>
<textarea name="message" cols="80" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
</td></tr><tr><td><td align="right">
<input type="submit" name="go" value="Poster">
</td></tr></table>
</form>
<?php
if (isset($erreur)) echo '<br /><p style="font-weight: bold; color: red;">'.$erreur.'</p><br />';
?>

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

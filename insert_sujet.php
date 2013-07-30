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
	// on teste la déclaration de nos variables
	if (!isset($_POST['auteur']) || !isset($_POST['titre']) || !isset($_POST['message'])) {
		$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
		// on teste si les variables ne sont pas vides
		if (empty($_POST['auteur']) || empty($_POST['titre']) || empty($_POST['message'])) {
			$erreur = 'Au moins un des champs est vide.';
		}

		// si tout est bon, on peut commencer l'insertion dans la base
		else {
			// on se connecte à notre base
			$base = mysql_connect ($serveurdb, $logindb, $passworddb);
			mysql_select_db ($basedb, $base) ;

			// on calcule la date actuelle
			$date = date("Y-m-d H:i:s");

			// préparation de la requête d'insertion (pour la table forum_sujets)
			$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysql_real_escape_string($_POST['auteur']).'", "'.mysql_real_escape_string($_POST['titre']).'", "'.$date.'")';

			// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

			// on recupère l'id qui vient de s'insérer dans la table forum_sujets
			$id_sujet = mysql_insert_id();

			// lancement de la requête d'insertion (pour la table forum_reponses
			$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysql_real_escape_string($_POST['auteur']).'", "'.mysql_real_escape_string($_POST['message']).'", "'.$date.'", "'.$id_sujet.'")';

			// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

			// on ferme la connexion à la base de données
			mysql_close();

			// on redirige vers la page d'accueil
			header('Location: forum.php');

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
	
	<script src="js/tinymce/tinymce.min.js"></script>
        <script>
                tinymce.init({selector:'textarea'});
        </script>

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

<form action="insert_sujet.php" method="post">

<table style="width: 100%;">
  <tr>
    <td><span class="gras">Auteur :</span></td>
    <td><input type="text" name="auteur" maxlength="30" size="50" value="<?php echo $_SESSION['login']; ?>"></td>
  </tr>
  <tr>
    <td><span class="gras">Titre :</span></td>
    <td><input type="text" name="titre" maxlength="80" size="80" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>"></td>
  </tr>
  <tr>
    <td><span class="gras">Message :</span></td>
    <td><textarea name="message" cols="78" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea></td>
  </tr>
  <tr>
    <td align="right"><input type="submit" name="go" value="Poster"></td>
  </tr>
</table>

</form>

<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><p style="color: red; font-weight: bold;">ERREUR : '.$erreur.'</p><br />';
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

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
	<h2><span>Résultat de votre recherche ...</span></h2>
	<br /><br /><br />


<?php
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

// on vérifie d'abord l'existence du POST et aussi si la requete n'est pas vide.
if(isset($_POST['requete']) && $_POST['requete'] != NULL)
{

// on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
$requete = htmlspecialchars($_POST['requete']);

// la requête, que vous devez maintenant comprendre ;)
$query = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM torrents WHERE nom_torr LIKE '%$requete%' ORDER BY id_torr DESC") or die (mysql_error());

// on utilise la fonction mysql_num_rows pour compter les résultats pour vérifier par après
$nb_resultats = mysql_num_rows($query);

// si le nombre de résultats est supérieur à 0, on continue
if($nb_resultats != 0)
{
// maintenant, on va afficher les résultats et la page qui les donne ainsi que leur nombre, avec un peu de code HTML pour faciliter la tâche.
?>

<h4>Résultats de votre recherche :</h4>
<p>Nous avons trouvé

<?php
// on affiche le nombre de résultats
echo '<span style="font-weight: bold;">'.$nb_resultats.'</span>&nbsp;';

// on vérifie le nombre de résultats pour orthographier correctement.
if($nb_resultats > 1) { echo 'résultats'; } else { echo 'résultat'; }
?>
&nbsp;dans notre base de données.<br/>Voici les torrents que nous avons trouvés :

<ul>
<?php
// on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction
while($donnees = mysql_fetch_array($query))
{
?>
  <li class="li"><a href="detail.php?id=<?php echo $donnees['id_torr']; ?>"><?php echo $donnees['nom_torr']; ?></a></li>
<?php
} // fin de la boucle
?>
</ul>


<!-- <a href="recherche.php">Faire une nouvelle recherche</a></p> -->
<?php
} // Fini d'afficher les résultats ! Maintenant, nous allons afficher l'éventuelle erreur en cas d'échec de recherche et le formulaire.
else
{ // de nouveau, un peu de HTML
?>
<h4>Pas de résultat :/</h4>
<p style="font-size: 12px; font-weight: bold;">Nous n'avons trouvé aucun résultat pour votre requête <span style="font-weight: bold;">"<?php echo $_POST['requete']; ?>"</span>.</p>
<?php
}// Fini d'afficher l'erreur ^^
mysql_close(); // on ferme mysql, on n'en a plus besoin
}

/*
else
{ // et voilà le formulaire, en HTML de nouveau !
?>
<p>Vous allez faire une recherche dans notre base de données concernant les fonctions PHP. Tapez une requête pour réaliser une recherche.</p>
<form action="recherche.php" method="Post">
<input type="text" name="requete" size="40">
<input type="submit" value="Ok">
</form>
<?php
}
*/

// et voilà, c'est fini !

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

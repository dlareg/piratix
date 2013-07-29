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

<?php
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$id = $_GET['id']; // id tu torrent

$sql0 = "SELECT * FROM torrents WHERE id_torr='".$id."'";
$req0 = mysql_query($sql0) or die('Erreur SQL !<br>'.$sql0.'<br>'.mysql_error());
$result0 = mysql_fetch_assoc($req0);

?>

	<div class="box last">
	<h2><span>Suppression du torrent <?php echo $result0['nom_torr']; ?></span></h2>
	<br /><br /><br />

<?php
$sql1 = "SELECT * FROM users WHERE nomuser='".$_SESSION["login"]."'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$result1 = mysql_fetch_assoc($req1);

// si le user n'est pas admin OU si l'ID de l'uploader (c'est à dire le propriétaire du torrent) n'est pas le même que celui de la SESSION
// le user n'a pas le droit meodifier le torrent
if ($result1['isadmin'] == 0 || ($result1['isadmin'] == 0 && $result0['pseudo_torr'] != $_SESSION['login'])) {
        echo "<h4 style=\"color: red;\">Désolé : vous n'avez pas le droit de supprimer le torrent !</h4>";
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
<?php
exit();
}

// on vérifie aussi que le visiteur n'utilise pas la page sans id et donc qu'il est bien connecté en tant que membre enregistré
if (!isset($_SESSION['id']) || !$_SESSION['id']) {
        echo "<h4 style=\"color: red;\">Erreur : vous ne pouvez pas accéder à cette page directement ou mauvais ID : $id</h4>";
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

<?php
exit();
}

// ****************************
// REQUETE SQL
// ****************************

$id = $_GET['id'];

// On supprime le torrent dans la table torrents
$sql0 = "DELETE FROM torrents WHERE id_torr = {$id}";

// On supprime le torrent dans la table xbt_files_users
$sql1 = "DELETE FROM xbt_files_users WHERE fid = {$id}";

// on met la valeur 1 au champ flags de la table xbt_files pour que XBT supprime le torrent
$sql2 = "UPDATE xbt_files SET flags=1 WHERE fid = {$id}";

// On supprime aussi les commentaires du torrent
$sql3 = "DELETE FROM comments WHERE cid_torrent = {$id}";

// on envoie les requêtes SQL
mysql_query($sql0) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
mysql_query($sql2) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
mysql_query($sql3) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());



/*
// on supprime aussi le fichier .torrent
$sql4 = "SELECT * FROM torrents WHERE id_torr={$id};";
$result = mysql_query($sql4) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
unlink("{$CHEMINSITE}/torrents/{$result['fichier_torr']}");

// On supprime aussi l'image du torrent (s'il y a en a une !)
if (empty($imagetorrent)) {
// On ne fait rien s'il n'y a pas d'image associée au torrent à supprimer
}
else {
unlink("{$CHEMINSITE}/images/imgtorrents/{$result['image_torr']}");
}
*/



	echo '<h4 style="color: green;">Torrent supprimé.<br /><br />Retour sur la page <a href="torrents.php">torrents</a></h4>';
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

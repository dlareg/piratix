<?php

session_start();

if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

require_once "include/settings.php";
require_once "include/config.php";
require_once "include/functions.php";

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

/*
// on vérifie aussi que l'utilisateur n'utilise pas la page sans id
if (!isset($_GET['id']) || !$_GET['id'] || !is_numeric($_GET['id'])) {
	//$erreur = "Erreur : problème d'accès à la page.";
	header('Location: login.php');
	exit();
}
*/

// On vérifie que l'utilisateur a le droit d'afficher la page
$sql1 = "SELECT * FROM torrents WHERE id_torr='".mysql_real_escape_string($id)."'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$result = mysql_fetch_assoc($req1);

$sql2 = "SELECT * FROM users WHERE nomuser='".mysql_real_escape_string($_SESSION['login'])."'";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$result2 = mysql_fetch_assoc($req2);

// Si le torrent appartient au user OU si le user est Admin : c'est bon, on y va !
if ($result['pseudo_torr'] == $_SESSION['login'] || $result2['isadmin'] == '1')
{

// On met à jour les données
if (!empty($_POST)) {
	extract($_POST);
	$sql = "UPDATE torrents SET nom_torr='".addslashes($nomtorrent)."', description_torr='".addslashes($descriptiontorrent)."', url_torr='".$urltorrent."', cat_torr='".addslashes($categorietorrent)."', licence_torr='".addslashes($licencetorrent)."' WHERE id_torr='".mysql_real_escape_string($id)."'";
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$ok = 'La modification a bien été effectuée !';
	$_GET['id'] = $id;
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
	<h2><span>Modification du torrent</span></h2>
	<br /><br /><br />

<?php
   $sql = 'SELECT * FROM torrents WHERE id_torr="'.mysql_real_escape_string($_GET['id']).'"' ;
   $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
   $result2 = mysql_fetch_assoc($req);
?>

<form enctype="multipart/form-data" name="modiftorrent" action="modif_torrent.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $result2['id_torr']; ?>">
  <table>
    <tr>
      <td width="25%">Nom du torrent</td>
      <td colspan="2"><input type="text" size="57" name="nomtorrent" value="<?php echo $result2['nom_torr']; ?>"><br /><br /></td>
    </tr>
    <tr>
      <td>Description</td>
      <td colspan="2"><textarea rows="20" cols="60" name="descriptiontorrent"><?php echo $result2['description_torr']; ?></textarea><br /><br /></td>
    </tr>
    <tr>
      <td>URL du fichier</td>
      <td colspan="2"><input type="text" size="60" name="urltorrent" value="<?php echo $result2['url_torr']; ?>"><br /><br /></td>
    </tr>
    <tr>
      <td>Catégorie</td>
      <td>

	<?php
	categories($result2['cat_torr']);
	/*
	<SELECT name="categorietorrent">
	     	<?php
		$sql = "SELECT * FROM categories";
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		while($data = mysql_fetch_assoc($req))
    		{ ?>
	<OPTION value="<?php echo $result2['cat_torr']; ?>"><?php echo $data['nomcat']; ?></OPTION>
		<?php } ?>
        </SELECT>
	*/
	?>
	<br /><br />
      </td>
    </tr>
    <tr>
      <td>Licence</td>
      <td>
	<?php
	licences($result2['licence_torr']);
	/*
	<SELECT name="licencetorrent">
		<?php
		$sql1 = "SELECT * FROM licences";
		$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
		while($data1 = mysql_fetch_assoc($req1))
    		{ ?>
	<OPTION VALUE="<?php echo $data1['lnom']; ?>"><?php echo $data1['lnom']; ?></OPTION>
		<?php } ?>
	</SELECT>
	*/
	?>
	<br /><br />
      </td>
    </tr>
    <tr>
      <td>Image</td>
      <td>
	  <img style="border:0px; max-width: 300px; max-height: 300px;" alt="<?php echo $result2['image_torr']; ?>" title="<?php echo $result2['image_torr']; ?>" src="images/imgtorrents/<?php echo $result2['image_torr']; ?>" />	
	  <input type="hidden" name="fichierold" value="<?php echo $result2['image_torr']; ?>">
          <br /><br /><input type="file" name="fichier" size="20" value="<?php echo $result2['image_torr']; ?>"><br /><br />
      </td>
    </tr>
    <tr>
      <td colspan="3"><input type="submit" name="modif" value="Modifier le torrent"> <input type="reset" value="Annuler"></td>
    </tr>
  </table>
</form>

<?php
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) {
	echo '<br/><br/><h4 style="color: red;">ERREUR : ' . $erreur . '</h4>';
}
if (isset($ok)) {
	echo '<br/><br/><h4 style="color: green;">' . $ok . '</h4>';
}

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
}

else {
   header ('Location: login.php');
   exit();
}
?>

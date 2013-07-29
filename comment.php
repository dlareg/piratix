<?php
session_start();
require("include/settings.php");
require("include/config.php");
require("include/functions.php");

// traitement du formulaire
if($_POST) {
   $idcomm_torr = $_POST['idcommtorr'];
   $commentaire = addslashes($_POST['zonecomm']);
   $usercomment = addslashes($_POST['utilisateurcomm']);
   //$titrecomm = addslashes($_POST['titrecomm']);

   $base = mysql_connect ($serveurdb, $logindb, $passworddb);
   mysql_select_db ($basedb, $base);

   //$commande="INSERT INTO comments (cid_torrent,cadded,ctitre,ctext,cuser) VALUES ('".$idcomm_torr."',NOW(),'".$titrecomm."','".$commentaire."','".$usercomment."')";
     $commande="INSERT INTO comments (cid_torrent,cadded,ctext,cuser) VALUES ('".$idcomm_torr."',NOW(),'".$commentaire."','".$usercomment."')";
   $result=mysql_query($commande) or die('Erreur SQL !<br>'.$result.'<br>'.mysql_error());
   //echo '<span style="color: green; font-weight: bold;">Commentaire posté !</span>';
   header("Location: detail.php?id=$idcomm_torr");
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

<?php
// on recupere l'id et le user
$id = $_GET['id'];
$user = addslashes($_SESSION['login']);

$insert="SELECT * FROM torrents WHERE id_torr='" . $id . "'";
$result=mysql_query($insert) or die('Erreur SQL !<br>'.$result.'<br>'.mysql_error());
?>

	<div class="box last">
	<h2><span>Proposer un commentaire pour <?php echo $result['nom_torr']; ?></span></h2>
	<br /><br /><br />

<FORM action="comment.php" METHOD="POST">
  <table border="0" cellpadding="10">
     <tr>
        <td width="130">Nom d'utilisateur</td><td><INPUT TYPE="TEXT" name="utilisateurcomm" value="<?php echo $user; ?>" size="20" maxlength="100" disabled; readonly></td>
     </tr>

     <!-- <tr>
	<td>Le titre de votre commentaire</td><td><INPUT TYPE="TEXT" name="titrecomm" size="50" maxlength="200"></td>
     </tr> -->

     <tr>
        <td>Votre commentaire :</td><td><TEXTAREA name="zonecomm" rows="10" cols="60"></TEXTAREA></td></tr>
     <tr>
        <td colspan="2" align="right"><input type="submit" value="Envoyer" />&nbsp;&nbsp;&nbsp;<input type="reset" value="Annuler" /></td>
     </tr>
  </table>
<input type="hidden" name="idcommtorr" value="<?php echo $id; ?>" />
</FORM>

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

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
	<h2><span>Proposer un torrent sur Piratix</span></h2>
	<br /><br />

	<?php
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);
	?>

<br />

<form method="post" enctype="multipart/form-data" action="upload2.php">

<table style="width: 100%;">
   <tr>
	<td colspan="2" style="padding: 0 5px 15px 25px; background-color: #EAEEF2;">
	   <?php echo $DISCLAIMERUPLOAD;?>
	</td>
   </tr>

   <tr><td>&nbsp;</td></tr>

   <tr>
	<td colspan="2">
	   <span style="font-size: 16px; font-weight: bold; color: blue; text-align:center;">
	   <fieldset>
	      <br />URL d'annonce :<br /><br /><?php echo $ANNOUNCEURL; ?><br /><br />
	   </fieldset>
	   </span>
	</td>
   </tr>

   <tr><td>&nbsp;</td></tr>

   <tr>
      <td class="tableTitle">
	<span style="color:red; font-weight:bold;">*</span> Fichier torrent :
      </td>
      <td>
   	<!-- <input type="hidden" name="MAX_FILE_SIZE" value="150000"> -->
   	<input type="file" name="fichier" size="20">
      </td>
   </tr>
   <tr>
      <td class="tableTitle">
	Nom du torrent :
      </td>
      <td>
        <INPUT type="text" name="nomtorr" size="40">
      </td>
   </tr>
      <td class="tableTitle">
	<span style="color:red; font-weight:bold;">*</span> Votre pseudo :
      </td>
      <td>
	<INPUT type="text" name="pseudo" size="40" value="<?php echo $_SESSION['login']; ?>" disabled; readonly>
      </td>
   </tr>
      <td class="tableTitle">
	<span style="color:red; font-weight:bold;">*</span> URL d'origine :
      </td>
      <td>
	<INPUT type="text" name="urltorr" size="40">
      </td>
   </tr>
   <tr>
      <td class="tableTitle">
	<span style="color:red; font-weight:bold;">*</span> Catégorie :
      </td>
      <td>
        <SELECT name="categorie">
		<?php
		$sql = "SELECT * FROM categories";
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		while($data = mysql_fetch_assoc($req))
    		{ ?>
	<OPTION VALUE="<?php echo $data['nomcat']; ?>"><?php echo $data['nomcat']; ?></OPTION>
		<?php } ?>
        </SELECT>
      </td>
   </tr>
   <tr>
      <td class="tableTitle">
	<span style="color:red; font-weight:bold;">*</span> Licence :
      </td>
      <td>
	<SELECT name="licence">
		<?php
		$sql1 = "SELECT * FROM licences ORDER BY lnom";
		$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
		while($data1 = mysql_fetch_assoc($req1))
    		{ ?>
	  <OPTION VALUE="<?php echo $data1['lnom']; ?>"><?php echo $data1['lnom']; ?></OPTION>
		<?php } ?>
		<?php mysql_close(); ?>
	</SELECT>
      </td>
   </tr>
   <tr>
      <td class="tableTitle">
	Image :
      </td>
      <td>
	<!-- <input type="hidden" name="MAX_FILE_SIZE" value="100000"> -->
	<input type="hidden" name="posted" value="1" />
	<input type="file" name="imagetorrent" size="20">
      </td>
   </tr>
   <tr>
      <td class="tableTitle">
	<br /><span style="color:red; font-weight:bold;">*</span> Description :
      </td>
      <td>
	<TEXTAREA rows="15" cols="58" name="description"></TEXTAREA>
      </td>
   </tr>
   <tr>
      <td colspan="2">
	<br /><span style="color: red; font-size: 9pt; font-style: italic;">- Tous les champs marqués d'un * sont obligatoires -</span>
      </td>
   </tr>
   <tr>
      <td colspan="2" style="text-align:right;">
	<br /><input type="submit" name="upload" value="Valider">&nbsp;&nbsp;&nbsp;<input type="reset" value="Annuler" />
	<br /><br />
      </td>
   </tr>
</table>

</form>

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

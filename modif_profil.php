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
	<h2><span>Modification de votre profil</span></h2>
	<br /><br /><br />

<?php
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);

  	//récupération de la variable d'URL, qui va nous permettre de savoir quel enregistrement modifier
  	$id  = $_GET["id"] ;

// *******************************************************************
// SECURITE DE LA PAGE
// *******************************************************************
$sql1 = "SELECT * FROM users WHERE iduser='".$_SESSION["id"]."'";
$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$result = mysql_fetch_assoc($req1);

// on vérifie aussi que n'utilise pas la page sans id
if (!isset($id) || !$id)
        die("Erreur : vous ne pouvez pas accéder à cette page directement ou mauvais ID : $id");

if ($id !== $_SESSION["id"] && $result['isadmin'] == 0)
        die("Erreur : vous ne pouvez pas modifier le profil d'un autre user ! Petit vilain ! ;o)");
 
  //requête SQL:
  $sql = "SELECT * FROM users WHERE iduser = ".$id ;
	    
  //exécution de la requête:
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());  

  //affichage des données:
  if( $result = mysql_fetch_object( $req ) )
  {
  ?>
<h4>Les informations de votre profil :</h4>

<form enctype="multipart/form-data" name="insertion" action="modif2_profil.php" method="POST">
  <input type="hidden" name="id" value="<?php echo($id) ;?>">
  <table style="width: 100%;">
    <tr>
      <td class="tableTitle">Pseudo</td>
      <td colspan="3" class="tableRow2"><input type="text" size="30" name="pseudo" value="<?php echo(stripslashes($result->nomuser)) ;?>"></td>
    </tr>
    <tr>
      <td class="tableTitle">E-Mail</td>
      <td colspan="2" class="tableRow2"><input type="text" size="30" name="email" value="<?php echo($result->mailuser) ;?>"></td>
    </tr>
    <tr>
      <td class="tableTitle">Inscription</td>
      <td colspan="2" class="tableRow2">Le <?php echo(gmdate('d-m-Y',$result->dateuser)) ;?>, à <?php echo(gmdate('H:i:s',$result->dateuser)) ;?></td>
    </tr>
    <tr>
      <td class="tableTitle">Avatar<br>(max. 100 ko)</td>
      <td class="tableRow2"><img border="0" alt="" src="images/avatar/<?php echo($result->avatar) ;?>"</td>
      <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input type="file" name="fichier" size="20"></td>
    </tr>
    <tr>
      <td class="tableTitle">Signature<br>forum<br>&nbsp;</td>
      <td colspan="2" class="tableRow2"><input type="text" size="70" name="signature" value="<?php echo(stripslashes($result->signature)) ;?>"></td>
    </tr>
    <tr>
      <td colspan="3"><input type="submit" name="modif" value="Modifier mon profil"></td>
    </tr>
  </table>
</form>

<?php
  }//fin if 
?>

<br>















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

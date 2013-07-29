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
	<h2><span>Pour contacter l'équipe de <?php echo $SITENAME; ?>...</span></h2>

	<br /><br /><br />

<?php

/* Nous testons que la variable existe et qu'elle a bien la longueur souhaitée */
if(!isset($_SESSION['code']) OR strlen($_SESSION['code']) !=5) exit("Erreur !");
 
/* Comparaison entre les deux valeurs si elles sont différentes on arrete tout sinon on continue et on envoie le mail */
if($_SESSION['code'] != $_POST['verif']) exit("Erreur les valeurs sont différentes !");
 
/* On récupère le mail de la personne qui envoie le mail. Si elle l'a saisi, on peut envisager de vérifier que ce champ est rempli avec une adresse valide */
$exp = $_POST['mail'];

/*On formate les chaines d'objet et de corps du mail */
$objet = stripslashes($_POST['objet']);
$msg = stripslashes($_POST['msg']);

/* On envoie le mail */
$envoi=mail("contact@piratix.mumbly58.net", $objet, $msg, "From: $exp\r\n"."Reply-To: $exp\r\n");
if($envoi) echo "<h4 style=\"color: green;\">Le mail a bien été envoyé !</h4>";
else echo "<h4 style=\"color: red;\">L'envoi a échoué, veuillez recommencer !</h4>";

/* on efface et détruit les varaibles de sessions */
//session_unset();
//session_destroy();

?>
	<br /><br /><br />

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

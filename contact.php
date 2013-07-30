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
	<h2><span>Pour contacter l'équipe de Piratix...</span></h2>

	<br /><br /><br />

	<form action="contactmail.php" method="post" name="contactmail" id="contactmail">
<p>
<label for="mail">Votre adresse mail :</label><br />
<input type="text" id="mail" name="mail" size="30" maxlength="100"/><br /><br />
<label for="objet">Objet du mail :</label><br />
<input name="objet" type="text" size="80" maxlength="199" /><br /><br />
<label for="msg">Texte du mail :</label><br />
<textarea name="msg" cols="80" rows="10"></textarea><br /><br />
<img src="cryptimage.php" alt="image de securisation du formulaire" title="image de securisation du formulaire" /><br />
<label for="verif">Veuillez recopier le code anti-spam dans le champ qui suit :</label><br />
<input type="text" name="verif" size="10" maxlength="5" />
</p><br />
<p>
<input type="submit" value="Envoyer le mail" /> <input type="reset" value="Annuler" />
</p>
</form>

<br>


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

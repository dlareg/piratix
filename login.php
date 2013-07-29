<?php

session_start();

if (isset($_SESSION['login'])) {
   header ('Location: index.php');
   exit();
}

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

		$base = mysql_connect ($serveurdb, $logindb, $passworddb);
		mysql_select_db ($basedb, $base);

		// on insert l'heure de la derniere connexion
                $sqlinsert = 'UPDATE users SET lastconnect=NOW() WHERE nomuser="'.$_POST['login'].'"';
                mysql_query($sqlinsert) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


		$sql = 'SELECT iduser FROM users WHERE nomuser="'.mysql_escape_string($_POST['login']).'" AND passuser="'.sha1(mysql_escape_string($_POST['pass'])).'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nb = mysql_num_rows($req);

		if ($nb == 1) {
			$data = mysql_fetch_array($req);

			//session_start();
			$_SESSION['login'] = $_POST['login'];

			// on enregistre en plus l'id du membre dans une variable de session
			$_SESSION['id'] = $data['iduser'];

			mysql_free_result($req);
			mysql_close();

			header('Location: index.php');
			exit();
		}
		elseif ($nb == 0) {
			$erreur = 'Mauvais identifiants !';
		}
		else {
			$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
		}
		mysql_free_result($req);
		mysql_close();
	}
	else {
		$erreur = 'Au moins un des champs est vide.';
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
           <h2><span>Connexion membres</span></h2>
           <br /><br /><br />

	<!-- formulaire de connexion -->
	<form action="login.php" method="post">
		Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" /><br /><br />
		Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>" /><br /><br />
		<input type="submit" name="connexion" value="Connexion" />  <input type="reset" value="Annuler" />
	</form>

	<?php
	   if (isset($erreur)) echo '<br /><br /><h4 style="color: red;">ERREUR : ' . $erreur . '</h4>';  
	?>

           <br /><br />

	   <a href="recup_pass.php">Mot de passe oublié ?</a>

	   <br/><br/>

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

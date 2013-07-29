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
// connexion SQL
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);


//récupération des valeurs des champs
$pseudo = htmlspecialchars(addslashes($_POST['pseudo'])) ;
$email = $_POST['email'] ;
$id = $_POST['id'] ;
$signature = htmlspecialchars(addslashes($_POST['signature'])) ;
$avatarimg = $_FILES['fichier']['name'];

// on précise dans quel rep le fichier va se trouver
$chemin_destination = '/var/www/piratix.mumbly58.net/web/images/avatar/';


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


// ******************************************************************
// Affichage des éventuelles erreurs propres à l'upload du fichier
// ******************************************************************

// on vérifie l'extension du fichier : que du jpg, png ou gif
$nomOrigine = $_FILES['fichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("png", "jpg", "gif");

if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "Votre avatar n'a pas l'extension attendue. Choisissez une image avec l'une des extensions suivantes : png, jpg ou gif.";
} // fin if

// puis, on vérifie les erreurs liées à $_FILES['fichier']['error'] :
// la taille du fichier (max 100 ko), la taille dans le formulaire, une erreur de transfert
// ou une valeur nulle pour la taille du fichier
else if ($_FILES['fichier']['error']) {
          switch ($_FILES['fichier']['error']){
                   case 1: // UPLOAD_ERR_INI_SIZE
                   echo"Le fichier dépasse la limite de taille autorisée !";
                   break;
                   case 2: // UPLOAD_ERR_FORM_SIZE
                   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                   break;
                   case 3: // UPLOAD_ERR_PARTIAL
                   echo "L'envoi du fichier a été interrompu pendant le transfert !";
                   break;
                   case 4: // UPLOAD_ERR_NO_FILE
                   echo "Le fichier que vous avez envoyé a une taille nulle !";
                   break;
         } // fin switch
} // fin else if

else if
// on vérifie que le nom a été soumis (preuve que le formulaire a été envoyé ... et qu'il n'y a pas d'erreur
((isset($_FILES['fichier']['name'])&&($_FILES['fichier']['error'] == UPLOAD_ERR_OK))) {

// on upload le fichier ...
move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_destination.$_FILES['fichier']['name']);

// Il n'y a aucune erreur ? On affiche le résultat !
  echo("<span style=color:green;>La modification a été correctement effectuée.</span><br>") ;

} // fin else if

else echo ("Il y a un Schmilblik quelque part ...");

// ****************************
// REQUETE SQL
// ****************************

//création de la requête SQL pour mettre à jour les infos du pseudo, de l'e-mail et du nom de l'avatar
$sql = "UPDATE users SET nomuser = '$pseudo', mailuser = '$email', avatar = '$avatarimg', signature = '$signature' WHERE iduser = '$id' " ;

// on envoie la requête SQL
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

// on coupe la connexion SQL
mysql_close();

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

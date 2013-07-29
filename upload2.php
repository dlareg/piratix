<?php

session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: login.php'); 
   exit();  
}

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

//require_once("File/Bittorrent2/Encode.php");
require("File/Bittorrent2/Decode.php");

require("include/BDecode.php");


if( isset($_POST['upload']) ) // si formulaire soumis
{

// *****************************************
// image torrent upload
// *****************************************
function get_extension($nom) {
    $nom = explode(".", $nom);
    $nb = count($nom);
    return strtolower($nom[$nb-1]);
}

// Extensions images autorisées
$extensions_ok = array('jpg', 'jpeg', 'png', 'gif');

// MimeType autorisé
/* 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF (Ordre des octets Intel), 8 = TIFF (Ordre des octets Motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF */

$typeimages_ok = array('1', '2', '3');

$taille_ko = 500; // Taille en kilo octect (ko)
$taille_max = $taille_ko*1024; // En octects
$dest_dossier = 'images/imgtorrents/';
$imagetorrent = $_FILES['imagetorrent']['name'];


    if(isset($_FILES['imagetorrent'])) // Formulaire envoyé
    {
        // Les erreurs que PHP renvoie
        if($_FILES['imagetorrent']['error'] !== "0") {
                switch ($_FILES['imagetorrent']['error']) {
                case 1:
                    $erreurs[] = "Votre image doit faire moins de $taille_ko Ko !";
                    break;
                case 2:
                    $erreurs[] = "Votre image doit faire moins de $taille_ko Ko !";
                    break;
                case 3:
                    $erreurs[] = "L'image n'a été que partiellement téléchargée.";
                    break;
                case 4:
                    $erreurs[] = "Aucun fichier n'a été téléchargé.";
                    break; // Pas de 5 (voir doc PHP)
                case 6:
                    $erreur[] = "Un dossier temporaire est manquant.";
                    break;
                case 7:
                    $erreurs[] = "Échec de l'écriture du fichier sur le disque.";
                    break;
            }
        }

        // getimagesize arrive à traiter le fichier ?
        if(!$getimagesize = getimagesize($_FILES['imagetorrent']['tmp_name'])) {
            $erreurs[] = "Le fichier n'est pas une image valide.";
        }

        // on vérifie le type de l'image
        if( (!in_array( get_extension($_FILES['imagetorrent']['name']), $extensions_ok ))
           or (!in_array($getimagesize[2], $typeimages_ok )))
        {
            foreach($extensions_ok as $text) { $extensions_string .= $text.', '; }
            $erreurs[] = "Veuillez sélectionner un fichier de type ".substr($extensions_string, 0, -2)." !";
        }

        // on vérifie le poids de l'image
        if( file_exists($_FILES['imagetorrent']['tmp_name']) 
                  and filesize($_FILES['imagetorrent']['tmp_name']) > $taille_max)
        {
            $erreurs[] = "Votre fichier doit faire moins de $taille_ko Ko !";
        }

        // copie du fichier si aucune erreur !
        if(!isset($erreurs) or empty($erreurs))
        {
            $dest_fichier = basename($_FILES['imagetorrent']['name']);
            $dest_fichier = strtr($dest_fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            // un ch'tit regex pour remplacer tous ce qui n'est ni chiffre ni lettre par "-"
            //$dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $dest_fichier);

            // pour ne pas ecraser un fichier existant
            while(file_exists($dest_dossier . $dest_fichier)) {
                $dest_fichier = rand().$dest_fichier;
            }

            // copie du fichier
            if(move_uploaded_file($_FILES['imagetorrent']['tmp_name'], $dest_dossier . $dest_fichier)) {
                $valid[] = "Image uploadée avec succés (<a href='".$dest_dossier . $dest_fichier."'>Voir</a>)";
            } else {
                $erreurs[] = "Impossible d'uploader le fichier.<br />Veuillez vérifier que le dossier ".$dest_dossier." existe avec un chmod 755 (ou 777).";
            }
        }
    }
// ***************************************
// fin image torrent upload
// ***************************************

// ***************************************
// upload fichier torrent
// ***************************************
    $content_dir = 'torrents/'; // dossier où sera déplacé le fichier
    $tmp_file = $_FILES['fichier']['tmp_name'];
    //$length=filesize($_FILES["fichier"]["tmp_name"]);

    if( !is_uploaded_file($tmp_file) )
    {
        $erreur = "Le fichier est introuvable.";
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['fichier']['type'];

    if( !strstr($type_file, 'torrent') )
    {
        $erreur = "Le fichier n'est pas un fichier .torrent !";
    }

    // On vérifie si le pseudo n'est pas vide
    if (empty($_POST['pseudo'])) {
        $erreur = "Vous devez fournir un pseudo !";
    }

    // On vérifie si l'url d'origine n'est pas vide
    if (empty($_POST['urltorr'])) {
        $erreur = "Vous devez fournir une URL pour ce torrent ! Soit l'URL d'origine soit une URL qui présente le média ...";
    }

     // connexion SQL
     $base = mysql_connect ($serveurdb, $logindb, $passworddb);
     mysql_select_db ($basedb, $base);

     // il faudrait vérifier le hash du torrent pour savoir si'il n'y a pas déjà un torrent avec le même hash 
     //$verifhash=mysql_fetch_array(mysql_query("SELECT info_hash FROM xbt_files WHERE info_hash='".$fid."'"));

	$dec=new File_Bittorrent2_Decode;
        $info=$dec->decodeFile($tmp_file);

    // On vérifie si le torrent n'existe pas déjà en cherchant son info_hash
    $exists=mysql_fetch_row(mysql_query("SELECT * FROM xbt_files WHERE LOWER(hex('info_hash'))='".$info['info_hash']."'"));
    if(!empty($exists))
        $erreur = "Désolé, ce torrent existe déjà sur le site !";

    // On vérifie enfin si la description n'est pas vide
    if (empty($_POST['description'])) {
        $erreur = "Vous devez fournir une description pour ce torrent !";
    }

    // on vérifie le nom du fichier
    $name_file = $_FILES['fichier']['name'];

    // on vérifie l'url d'announce
    //$dec=new File_Bittorrent2_Decode;
    //$info=$dec->decodeFile($tmp_file);

    if($info['announce']!=$ANNOUNCEURL) {
        $erreur = "<br/>ATTENTION : Vous n'avez pas fournit la bonne adresse d'announce dans votre torrent : l'url d'announce doit etre ".$ANNOUNCEURL;
	}

    // on récupère le nom public du fichier
    if (empty($_POST['nomtorr']))
    {
    // on calcule le nom du fichier SANS .torrent à la fin
    $file = $_FILES['fichier']['name'];
    $var = explode(".",$file);
    $nb = count($var)-1;
    $nomtorr = substr($file, 0, strlen($file)-strlen($var[$nb])-1);
    }
    else
    {
    // sinon on prend le nom fournit dans le formulaire d'upload
    $nomtorr = $_POST['nomtorr'];
    }

    // on vérifie si le nom du fichier ne presente pas de soucis au niveau HACK ...
    if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
    {
       $erreur = "Nom de fichier non valide";
    }

    else if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
    {
        $erreur = "Impossible de copier le .torrent dans $content_dir";
    }
// ***********************************************
// fin upload fichier torrent
// ***********************************************

    //echo "<p><br /><br /><br /><span style=\"font-size: 14pt; font-weight: bold; color: green;\">Le torrent a bien été uploadé. MERCI.</span><br /><br /><a href=\"index.php\">Retour sur la page d'accueil</a><br /></p>";
}

     $taille = $info['size'];

/*
     $sql = 'INSERT INTO torrents VALUES("", NOW(), "'.$nomtorr.'", "'.$name_file.'", "'.mysql_escape_string($_POST['description']).'", "'.mysql_escape_string($_POST['pseudo']).'", "'.mysql_escape_string($_POST['urltorr']).'",  "'.mysql_escape_string($_POST['categorie']).'",  "'.mysql_escape_string($_POST['licence']).'", "'.$imagetorrent.'", "'.$taille.'")';
     mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

// On insert aussi les données dans la table xbt_files avec un le hash au format binaire (X)
     if(!mysql_query("INSERT INTO xbt_files (info_hash,mtime,ctime) VALUES(X'".$info['info_hash']."',UNIX_TIMESTAMP(),UNIX_TIMESTAMP())"))
     {
          $erreur='Il y a eu une erreur lors de l\'ajout de votre torrent dans la table xbt_files.';
	}


	// On précise enfin que le torrent a bien été uploadé
	//$okupload='<p><br /><br /><br /><span style="font-size: 14pt; font-weight: bold; color: green;">Le torrent a bien été uploadé. MERCI.</span><br /><br /><a href="index.php">Retour sur la page d\'accueil</a><br /></p>';
*/

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
	<h2><span>Proposer un torrent</span></h2>

<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) {
	echo '<br/><br/><br/><br/><h4 style="color: red;">ERREUR : ' . $erreur . '<h4>';
	echo '<br/><h4><a href="javascript:history.back()">Retouner sur la page précédente</a></h4>';
}
else {
	echo '<p><br /><br /><br /><span style="font-size: 14pt; font-weight: bold; color: green;">Le torrent a bien été uploadé. MERCI.</span><br /><br /><a href="index.php">Retour sur la page d\'accueil</a><br /></p>';

     $sql = 'INSERT INTO torrents VALUES("", NOW(), "'.$nomtorr.'", "'.$name_file.'", "'.mysql_escape_string($_POST['description']).'", "'.mysql_escape_string($_POST['pseudo']).'", "'.mysql_escape_string($_POST['urltorr']).'",  "'.mysql_escape_string($_POST['categorie']).'",  "'.mysql_escape_string($_POST['licence']).'", "'.$imagetorrent.'", "'.$taille.'")';
     mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

// On insert aussi les données dans la table xbt_files avec un le hash au format binaire (X)
     if(!mysql_query("INSERT INTO xbt_files (info_hash,mtime,ctime) VALUES(X'".$info['info_hash']."',UNIX_TIMESTAMP(),UNIX_TIMESTAMP())"))
     {
          $erreur='Il y a eu une erreur lors de l\'ajout de votre torrent dans la table xbt_files.';
        }


}

?>

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

<?php

session_start();

/*
if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}
*/

require_once("include/settings.php");
require_once("include/config.php");
require_once("include/functions.php");

require("File/Bittorrent2/Decode.php");
//require("include/BDecode.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?php echo $DEFAULTLANGUAGE; ?>" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
        <title><?php echo $SITENAME; ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=<?php echo $DEFAULTCHARSET; ?>" />
        <link rel="stylesheet" href="<?php echo $DEFAULTSTYLE; ?>" type="text/css" media="all" />
	<link href="css/lightbox.css" rel="stylesheet" />
        <!--[if IE 6]>
                <link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-func.js"></script>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/lightbox-2.6.min.js"></script>
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

<?php
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

// *******************************************************
// affichage du tableau liste des torrents
// *******************************************************
// on crée la requête SQL

$id = $_GET['id'];

if (!isset($id) || !$id || !is_numeric($id))
    $erreur="<br /><p style=\"font-weight: bold; fon-size: 11pt; color: red;\">Erreur : vous ne pouvez pas accéder à cette page directement ou mauvais ID : $id<br />Retour à la <a href=\"torrents.php\">page des torrents</a>.</p><br /><br />";

// petite vérification de l'id
$sql = "SELECT id_torr FROM torrents ORDER BY id_torr DESC LIMIT 0,1";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$row = mysql_fetch_array($req);

	$idtorrent = $row['id_torr'];

	if ($id > $idtorrent) {
	$erreur="<h2>Ce torrent avec l'id $id n'existe pas !</h2>Retour à la <a href=\"torrents.php\">page des torrents</a>.";
	}

$sql = "SELECT * FROM torrents LEFT JOIN categories ON categories.nomcat=torrents.cat_torr LEFT JOIN licences ON licences.lnom = torrents.licence_torr LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid WHERE id_torr='". mysql_real_escape_string($id) ."'";

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
//while($data = mysql_fetch_assoc($req))
//    {
$data = mysql_fetch_assoc($req);

    // on affiche les informations de l'enregistrement en cours
    echo '<h2><span>[ '.stripslashes($data['cat_torr']).' ]';
    echo ' : '.stripslashes($data['nom_torr']).'</span></h2>';

    // Recherche si le user est admin ou si le user est le propriétaire du torrent ...
    $sql1 = "SELECT * FROM users LEFT JOIN torrents ON torrents.pseudo_torr = users.nomuser WHERE nomuser='" . mysql_real_escape_string($_SESSION['login']) . "'";
    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
    $result = mysql_fetch_assoc($req1);

    $pseudo = $data['pseudo_torr'];

	// si le user est le propriétaire du torrent ou si le user est admin, on permet l'édition et la suppression
        if ($result['isadmin'] == 1 || $_SESSION["login"] == $pseudo) {
               	echo '<br /><span style="font-size: 8pt; font-family: verdana;">[&nbsp;<a href="modif_torrent.php?id='.$id.'">Editer <img src="images/edit.png" alt="" /></a>&nbsp;|&nbsp;<a href="supprimer_torrent.php?id='.$id.'">Supp. <img src="images/delete.jpg" alt="" /></a>&nbsp;]</span><br />';
    	}

    echo '</h1>';
    echo '<br/>';

    echo '<table style="width: 100%;"><tbody>';
    echo '<tr>';

	if (empty($data['image_torr'])) {
	   echo '<td style="vertical-align: top;"><img style="width: 200px; height: 200px; border:0px; float: left; margin-right: 8px;" src="images/noimage.png" alt="'.stripslashes($data['nom_torr']).'" title="'.stripslashes($data['nom_torr']).'" /><p style="text-align: justify; margin-right: 10px;">'.nl2br(stripslashes($data['description_torr'])).'</p>';
	}
	else {
           echo '<td style="vertical-align: top;"><a href="images/imgtorrents/'.$data['image_torr'].'" data-lightbox="'.stripslashes($data['image_torr']).'" title="'.stripslashes($data['nom_torr']).'"><img src="images/imgtorrents/'.$data['image_torr'].'" alt="'.$data['image_torr'].'" style="max-width: 200px; max-height: 200px; border:0px; float: left; margin-right: 8px;" /></a><p style="text-align: justify; margin-right: 10px;">'.nl2br(stripslashes($data['description_torr'])).'</p>';
	}

    echo '</td>';

    echo '<td id="comments2" style="width: 28%;">';
    echo '<span style="font-weight: bold;">Télécharger ce média :</span>';
    echo '<br/><a href="download.php?id='.$id.'"><img src="images/download_button.png" style="border:0px;" alt="Télécharger" title="Télécharger '.stripslashes($data['nom_torr']).'" /></a><br/><br/>';

    echo '<span style="font-weight: bold;">Partagez cet article !</span><br/>';
    echo '<a href="http://twitter.com/home?status='.$data['nom_torr'].' http://piratix.mumbly58.net/detail.php?id='.$data['id_torr'].'" target="_blank"><img style="border: 0px;" src="images/social/twitter-48x48.png" alt="Twitter cet article !" /></a>&nbsp;';
    //echo '<a href="http://identi.ca/index.php?action=newnotice&status_textarea='.$data['nom_torr'].' http://piratix.mumbly58.net/detail.php?id='.$data['id_torr'].'" target="_blank"><img style="border: 0px;" src="images/social/identica-48x48.png" alt="Partagez cet article sur identi.ca !" /></a>&nbsp;';

    echo '
<!-- Placez cette balise où vous souhaitez faire apparaître le gadget bouton "Partager". -->
<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60"></div>

<!-- Placez cette ballise après la dernière balise Partager. -->
<script type="text/javascript">
  window.___gcfg = {lang: \'fr\'};

  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
';

    echo '<br/><br/>';

   echo 'Seeders : ';
        if ($data['seeders'] == 0) {
          echo '<span style="color:red;">&#8593&nbsp;'.stripslashes($data['seeders']).'</span>';
          }
        else {
          echo '<span style="color:green;">&#8593&nbsp;'.stripslashes($data['seeders']).'</span>';
          }
        echo ' | Leechers : <span style="color:red;">&#8595&nbsp;'.stripslashes($data['leechers']).'</span><br/><br/>';

    echo 'Téléchargé : '.stripslashes($data['completed']).' fois<br/><br/>';
    echo '<b>Taille : </b>'.makesize($data['taille_torr']).'<br/><br/>';
    echo '<b>Proposé par : </b>'.stripslashes($data['pseudo_torr']).'<br/><br/>';

    // on décompose la date
    sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
    echo '<b>Proposé le : </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/><br/>';

    echo '<b>Url du media : </b><a style="text-decoration:none;" title="'.stripslashes($data['url_torr']).'" href="'.stripslashes($data['url_torr']).'">'.stripslashes($data['url_torr']).'</a><br/><br/>';
    echo '<b>Licence : </b><a style="text-decoration:none;" href="'.stripslashes($data['lurl']).'">'.stripslashes($data['licence_torr']).'</a><br/><br/>';
    echo '<b>Catégorie : </b><a style="text-decoration:none;" href="categorie-detail.php?idcat=' . $data['idcat'] . '">'.stripslashes($data['cat_torr']).'</a><br/><br/>';

	// on récupère les infos du torrent grâce à File_Bittorrent2 (Pear): 
	// on veut afficher les fichiers du torrents :
	$filetorrent = $CHEMINSITE . '/torrents/'.$data['fichier_torr'];
	$dec = new File_Bittorrent2_Decode;
	$info = $dec->decodeFile($filetorrent);

    //echo '<b>Info hash :</b> ' . $info['info_hash'] . '<br /><br />';

    //echo buildTreeArray($filetorrent);

	$torrentfiles =  $info['files'];
	//print_r($torrentfiles);

	
    echo '<b>Fichier(s) du torrent :</b> ' . count($info['files']);
	echo outputTree($torrentfiles);
	echo '<br />';

/*
    echo '<UL style="margin-left: 5px;">';
	//echo '<li>' . $info['files'] . '</li>';
	echo '<li>' . $buildtreearray . '</li>';
	//echo print_r($info);
    echo '</UL><br />';
*/

    echo '<b>Téléchargé par : </b>';
$mysql = 'SELECT * FROM xbt_files_users LEFT JOIN users ON xbt_files_users.uid = users.iduser WHERE fid="'. $id .'" AND xbt_files_users.completed = 1 AND xbt_files_users.downloaded != 0';
$requete = mysql_query($mysql) or die('Erreur SQL !<br>'.$mysql.'<br>'.mysql_error());
while($resultat = mysql_fetch_assoc($requete))
                {
                echo stripslashes($resultat['nomuser']).', ';
                        }
    echo '<br/><br/>';
    echo '</td>';
    echo '</tbody></table>';

    //echo '<img style="border:0px;" src="images/imgtorrents/'.$data['image_torr'].'" alt="'.stripslashes($data['image_torr']).'" title="'.stripslashes($data['nom_torr']).'" />';
    echo '<br/><br/>';

    	//echo '<a name="comments"></a>';
	echo '<h2><span><a style="color: white;" name="commentaires">Les commentaires pour ce torrent : </a></span></h2>';
	echo '<br /><br /><br />';

$sql2 = 'SELECT * FROM comments LEFT JOIN users ON comments.cuser = users.nomuser WHERE cid_torrent="'. $id .'"';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data2 = mysql_fetch_assoc($req2))
    {
	echo '<div id="comments2">';
	echo '<p style="text-decoration: underline; font-size: 12px;">#'.$data2['cid'].'&nbsp;<span style="font-weight: bold;">' .$data2['ctitre']. '</span> - Par <a style="color: black;" href="membre-detail.php?id='.$data2['iduser'].'">'.stripslashes($data2['nomuser']).'</a>, 
	le ' . $data2['cadded'] . '</p><p style="margin-left: 25px; text-align: justify;">'.stripslashes($data2['ctext']).'</p></p>';
	//echo '<p style="text-align: right;">Le ' . $data2['cadded'] . '</p>';
	echo '</div><br/>';
    } // fin while $data2
	echo '<br /><p style="font-weight:bold; text-align: center;"><a href="comment.php?id='.$id.'&user='.stripslashes($data['pseudo_torr']).'">Laissez un commentaire pour "<span style="font-size:9pt; color:blue; font-weight:bold; font-style:italic;">'.stripslashes($data['nom_torr']).'</span>"</a></p><br /><br />';

//	} // fin while $data

// on ferme la connexion à mysql
mysql_close();

?>

<?php
	if(isset($erreur)) {
	  echo "<p>" . $erreur . "</p>";
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

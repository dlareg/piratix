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
	<h2><span>Liste des torrents</span></h2>

	<?php
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);

// *******************************************************
// affichage du tableau liste des torrents
// ********************************************************

// on prépare la pagination
$sql= "SELECT COUNT(id_torr) as nbArt FROM torrents";
$req = mysql_query($sql) or die(mysql_error());
$data = mysql_fetch_assoc($req);
$nbArt = $data['nbArt'];

// nb de torrents sur la page torrents.php
$perPage = $TORRENTLISTLIMIT;

$nbPage = ceil($nbArt/$perPage);
//echo $nbPage;
$cPage = 1;
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPage) {
	$cPage = $_GET['p'];
	}
	else {
	$cPage = 1;
	}

// on crée la requête SQL
$sql = "SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat ORDER BY xbt_files.ctime DESC LIMIT ".(($cPage-1)*$perPage).",$perPage";

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

echo '<br /><br />';

echo '<table style="width: 100%;">';

    echo '<tr class="tableTitle">';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Cat.</b></td>';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Nom du torrent</b></td>';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Taille</b></td>';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Ajouté par</b></td>';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Ajouté le</b></td>';
        echo '<td style="padding: 3px 3px 3px 3px;"><b>Licence</b></td>';
        echo '<td style="text-align: center; padding: 3px 3px 3px 3px;"><b><span style="color:green;">S</span></b></td>';
        echo '<td style="text-align: center; padding: 3px 3px 3px 3px;"><b><span style="color:red;">L</span></b></td>';
        echo '<td style="text-align: center; padding: 3px 3px 3px 3px;"><b>C</b></td>';
    echo '</tr>';

// on fait une boucle qui va faire un tour pour chaque enregistrement
// on en profite aussi pour afficher des couleurs de lignes alternée pour el tableau

$i = 0;

while($data = mysql_fetch_assoc($req))
    {
    // on affiche les informations de l'enregistrement en cours
    // on affiche un tableau avec couleur de row alternée

    $tablerow = ++$i % 2 ? 'tableRow1':'tableRow2';

    echo '<tr class="' . $tablerow . '">';
    echo '<td style="vertical-align: top; text-align: center; padding: 3px 3px 3px 3px;"><img style="width:28px; height:26px; border: 0px;" src="images/categories/'.$data['imagecat'].'" alt="'.$data['nomcat'].'" title="'.$data['nomcat'].'" /></td>';

    // Recherche les commentaires pour un torrent ...
    $commentres = mysql_query('SELECT COUNT(*) as commentaires FROM comments WHERE cid_torrent="'.$data['id_torr'].'"');
    $commentdata = mysql_fetch_assoc($commentres);

   if ($commentdata['commentaires']>0) {
	echo '<td style="padding: 3px 3px 3px 3px; font-size: 8pt;"><b><a style="text-decoration:none;" href="detail.php?id='.$data['id_torr'].'">'.stripslashes($data['nom_torr']).'</a></b>
	<a style="text-decoration:none;" href="detail.php?id='.$data['id_torr'].'#comments">&nbsp;<img src="images/com.gif" style="border: 0px;" title="'.$commentdata['commentaires'].' commentaire(s) pour ce torrent" alt="Commentaires pour ce torrent" /></a></td>';
    }
    else {
	//echo '<td class="servBodL"><a href="http://www.freenet.fr.nf/torrents/'.$data['fichier_torrent'].'"><img src="images/down.png" border="0" title="Télécharger le torrent" alt="Télécharger le torrent" /></a>
	echo '<td class="tabcol" style="font-size: 8pt;"><b><a style="text-decoration:none;" href="detail.php?id='.$data['id_torr'].'">'.stripslashes($data['nom_torr']).'</a></b></td>';
   	 }
        echo '<td class="tabcol" style="font-size: 8pt; width: 9%;"">'.makesize($data['taille_torr']).'</td>';
    	echo '<td class="tabcol" style="font-size: 8pt; width: 13%;"">'.stripslashes($data['pseudo_torr']).'</td>';
    	echo '<td class="tabcol" style="font-size: 7pt; width: 13%;">'.gmdate('d-m-Y à H:i', $data['ctime']).'</td>';

    // Recherche de l'url de la licence du torrent
    $sql1 = "SELECT * FROM torrents LEFT JOIN licences ON torrents.licence_torr = licences.lnom WHERE torrents.id_torr='".$data['id_torr']."'";
    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
    $result = mysql_fetch_assoc($req1);

    	echo '<td class="tabcol" style="font-size: 7pt; width: 12%;"><a style="text-decoration:none;" href="'.stripslashes($result['lurl']).'">'.stripslashes($data['licence_torr']).'</a></td>';
    	echo '<td class="tabcol">'.stripslashes($data['seeders']).'</td>';
    	echo '<td class="tabcol">'.stripslashes($data['leechers']).'</td>';
    	echo '<td class="tabcol">'.stripslashes($data['completed']).'</td>';
    	echo '</tr>';
    }
	echo '</tbody>';
	echo '</table>';

//on affiche la pagination
echo "<div style=\"text-align: center; padding-top: 10px;\"><span style=\"font-size: 12px;\">Page ";
for($i=1;$i<=$nbPage;$i++) {
	if($i==$cPage) {
	echo " $i ";
	}
	else {
	echo "<a href=\"torrents.php?p=$i\">$i</a> ";
	}
}
echo "</span></div>";
//fin pagination

echo '<br><br>';

// on ferme la connexion à mysql
mysql_close();

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

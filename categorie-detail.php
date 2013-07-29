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

<?php

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$sql = 'SELECT * FROM categories LEFT JOIN torrents ON torrents.cat_torr=categories.nomcat LEFT JOIN xbt_files ON xbt_files.fid=torrents.id_torr WHERE idcat="' . mysql_real_escape_string($_GET['idcat']) . '" ORDER BY date_torr DESC';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$result = mysql_fetch_assoc($req);

  echo '<div class="box last">';
        echo '<h2><span>Torrents dans la catégorie : ' . $result['nomcat'] . '</span></h2><br /><br /><br />';

        echo '<table style="width: 100%; padding: 5px 5px 5px 5px;">';
           echo '<tr class="tableTitle">';
	      echo '<td style="padding: 5px 5px 5px 5px;">Cat.</td>';
              echo '<td style="padding: 5px 5px 5px 5px;">Nom du torrent</td>';
	      echo '<td style="padding: 5px 5px 5px 5px;">Taille</td>';
	      echo '<td style="padding: 5px 5px 5px 5px;">Ajouté par</td>';
	      echo '<td style="padding: 5px 5px 5px 5px;">Ajouté le</td>';
	      echo '<td style="padding: 5px 5px 5px 5px;">Licence</td>';
	      echo '<td style="text-align: center; padding: 5px 5px 5px 5px;">S</td>';
	      echo '<td style="text-align: center; padding: 5px 5px 5px 5px;">L</td>';
	      echo '<td style="text-align: center; padding: 5px 5px 5px 5px;">C</td>';
           echo '</tr>';

$i = 0;

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
	$tablerow = ++$i % 2 ? 'tableRow1':'tableRow2';

	   echo '<tr class="' . $tablerow . '">';
	      echo '<td class="tabcol" style="text-align: center;"><img src="images/categories/' . $data['imagecat'] . '" alt="' .  $data['nomcat'] . '" title="' .  $data['nomcat'] . '" /></td>';
	      echo '<td class="tabcol"><a href="detail.php?id=' .  $data['id_torr'] . '">' . $data['nom_torr'] . '</a></td>';
              echo '<td class="tabcol">' . makesize($data['taille_torr']) . '</td>';
              echo '<td class="tabcol">' . $data['pseudo_torr'] . '</td>';
              echo '<td class="tabcol" style="font-size: 10px;">' . $data['date_torr'] . '</td>';
              echo '<td class="tabcol">' . $data['licence_torr'] . '</td>';
              echo '<td class="tabcol" style="text-align: center;" >' . $data['seeders'] . '</td>';
              echo '<td class="tabcol" style="text-align: center;">' . $data['leechers'] . '</td>';
              echo '<td class="tabcol" style="text-align: center;" >' . $data['completed'] . '</td>';
	   echo '</tr>';
}

	echo '</table>';
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

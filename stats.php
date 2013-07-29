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
	<h2><span>Statistiques des torrents</span></h2>
	<br /><br /><br />


<table style="width: 100%; border: thin solid #000000;">
   <tr class="tableTitle">
      <td colspan="4"><h5>&nbsp;&nbsp;TOP 5 Uploaders</h5></td>
   </tr>
   <tr>
      <td class="tableRow2"><h5>Pseudo</h5></td>
      <td class="tableRow2"><h5>Envoyé</h5></td>
      <td class="tableRow2"><h5>Chargé</h5></td>
   </tr>

<?php

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$sql = 'SELECT * FROM users LEFT JOIN xbt_users ON xbt_users.uid = users.iduser WHERE xbt_users.uploaded>0 AND iduser > 1 ORDER BY xbt_users.uploaded DESC LIMIT 5';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
	echo '<tr>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['nomuser'] . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . makesize($data['uploaded']) . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . makesize($data['downloaded']) . '</td>';
	echo '</tr>';
}
?>
</table>

<br /><br />

<table style="width: 100%; border: thin solid #000000;">
   <tr class="tableTitle">
      <td colspan="4"><h5>&nbsp;&nbsp;TOP 5 Downloaders</h5></td>
   </tr>
   <tr>
      <td class="tableRow2"><h5>Pseudo</h5></td>
      <td class="tableRow2"><h5>Envoyé</h5></td>
      <td class="tableRow2"><h5>Chargé</h5></td>
   </tr>

<?php

$sql = 'SELECT * FROM users LEFT JOIN xbt_users ON xbt_users.uid = users.iduser WHERE xbt_users.downloaded>0 AND iduser > 1 ORDER BY xbt_users.downloaded DESC LIMIT 5';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
        echo '<tr>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['nomuser'] . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . makesize($data['uploaded']) . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . makesize($data['downloaded']) . '</td>';
        echo '</tr>';
}
?>
</table>

<br /><br />

<table style="width: 100%; border: thin solid #000000;">
   <tr class="tableTitle">
      <td colspan="6"><h5>&nbsp;&nbsp;TOP 10 torrents les plus chargés</h5></td>
   </tr>
   <tr>
      <td class="tableRow2"><h5>Nom</h5></td>
      <td class="tableRow2"><h5>Licence</h5></td>
      <td class="tableRow2"><h5>Catégorie</h5></td>
      <td class="tableRow2"><h5>Ajouté le</h5></td>
      <td class="tableRow2"><h5>Taille</h5></td>
      <td class="tableRow2"><h5>C</h5></td>
   </tr>

<?php

$sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON xbt_files.fid = torrents.id_torr ORDER BY xbt_files.completed DESC LIMIT 10';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
        echo '<tr>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['nom_torr'] . '</td>';
	   echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['licence_torr'] . '</td>';
	   echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['cat_torr'] . '</td>';

    	   // on décompose la date
    	   sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
    	   echo '<td class="tableRow1" style="font-size: 8pt;">'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'</td>';
	   //echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['date_torr'] . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . makesize($data['taille_torr']) . '</td>';
           echo '<td class="tableRow1" style="font-size: 8pt;">' . $data['completed'] . '</td>';
        echo '</tr>';
}

?>
</table>

<br /><br />









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

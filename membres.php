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
	<h2><span>Liste des membres actifs sur <?php echo $SITENAME; ?></span></h2>
	<br /><br /><br />

<?php
	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
	mysql_select_db ($basedb, $base);


	echo '<table style="width: 100%;">';

	echo '<h4>Membres inscrits : ';

	$sql1 = 'SELECT COUNT(nomuser) AS count FROM users WHERE iduser > "1"';
	$req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());

while($data1 = mysql_fetch_assoc($req1))
	{
	echo $data1['count'];
	}

        echo ' - Membres inscrits actifs : ';

        $sql1 = 'SELECT COUNT(nomuser) AS count FROM users WHERE activeuser="1" AND iduser > "1"';
        $req1 = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());

while($data1 = mysql_fetch_assoc($req1))
        {
        echo $data1['count'];
        }
        echo '</h4>';


	echo '<tr class="tableTitle" style="text-align: center;">';
	echo '<td style="width:35%; padding: 3px 3px 3px 3px;"><b>Pseudo</b></td>';
	echo '<td style="width:25%; padding: 3px 3px 3px 3px;"><b>Inscrit(e) le</b></td>';
	echo '<td style="width:25%; padding: 3px 3px 3px 3px;"><b>Dernière connexion le</b></td>';

	if (!empty($_SESSION['login'])) {
	   echo '<td style="width:15%; padding: 3px 3px 3px 3px;"><b>Message</b></td>';
	}
	echo '</tr>';

        $sql = 'SELECT * FROM users WHERE iduser > 1';
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_assoc($req))
{
	if ($data['activeuser'] == 1) {
	   echo '<tr class="tableRow1" style="font-size: 8pt;">';
           echo '<td class="tabcol" style="padding:5px 0 5px 5px;"><a style="text-decoration:none;" href="membre-detail.php?id='.$data['iduser'].'">'.$data['nomuser'].'</a>';
		if ($data['isadmin']==1) {
		echo '<span style="font-size:6pt; color:red; font-weight:bold; font-style:italic;">&nbsp;[Admin]</span>';
		}
	   echo '</td>';
	   echo '<td class="tabcol" style="text-align: center;">'.gmdate('d.m.Y à H:i:s', $data['dateuser']).'</td>';

	   // on décompose la date
	   sscanf($data['lastconnect'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
	   echo '<td class="tabcol" style="text-align: center;">' . $jour.'.'.$mois.'.'.$annee.' à '.$heure.':'.$minute.':'.$seconde . '</td>';

	   if (!empty($_SESSION['login'])) {
	      // on n'affiche pas sa propre icone de PM !
	      if ($data['nomuser'] == $_SESSION['login']) {
		  echo '<td class="tabcol" style="text-align: center;"></td>';
	      }
	      else {
	          echo '<td class="tabcol" style="text-align: center;"><a href="envoyer_message.php?iduser=' . $data['iduser'] . '"><img src="images/icon_contact_pm.gif" alt="MP" /></a></td>';
	      }
	   }
	   echo '</tr>';
	   } //compte_active
} //while

// Fermeture de la connexion à la base de données
mysql_close();

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

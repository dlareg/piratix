<?php
session_start();

if (!isset($_SESSION['login'])) {
   header ('Location: login.php');
   exit();
}

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

<?php
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$id = $_GET['id'];

$results = mysql_query("SELECT * FROM users LEFT JOIN torrents ON torrents.pseudo_torr = users.nomuser WHERE iduser = '$id'");
$result = mysql_fetch_assoc($results);
?>

	<h2><span>Profil de <?php echo $result['nomuser']; ?></span></h2>
	<br /><br /><br />

<?php
        echo '<table style="width: 100%; text-align: center;">';
        echo '<tr>';
        if (empty($result['avatar'])) {
              echo '<td><img style="border:0px;" alt="Pas d\'avatar" title="" src="images/avatar/000.jpg" /></td>';
           }
           else {
              echo '<td><img style="border:0px; width:150px; height:150px;" alt="'.stripslashes($result['nomuser']).'" title="'.stripslashes($result['nomuser']).'" src="images/avatar/'.$result['avatar'].'" /></td>';
           }
        echo '<td><p style="text-align:center; font-size:10pt; font-weight:bold;">'.stripslashes($result['nomuser']).'&nbsp;';

        if ($result['isadmin']==1) {
        echo '<span style="color:red; font-size:7pt;">[Admin]</span>';
        }

        echo '</p></td>';
        //echo '<td><a style="text-decoration:none;" href="messages.php?user=#">Envoyer MP</a></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td class="tableTitle">Inscrit le</td><td class="tableRow1" colspan="2"><p style="text-align:center;">'.gmdate('d-m-Y',$result['dateuser']).' à '.gmdate('H:i:s',$result['dateuser']).'</p></td>';
        echo '</tr>';

        echo '<tr>';

	sscanf($result['lastconnect'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
        echo '<td class="tableTitle">Dernière connexion le</td><td class="tableRow2" colspan="2"><p style="text-align:center;">' . $jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde . '</p></td>';
        echo '</tr>';


        $sql = "SELECT * FROM xbt_users WHERE uid = '".$result['iduser']."' ";
        $req = mysql_query($sql) or die('Erreur dans <em>"'.$sql.'"</em>:<br/>'.mysql_query());
        $user = mysql_fetch_assoc($req);

        echo '<tr>';
        echo '<td class="tableTitle">Upload</td><td class="tableRow1" colspan="2"><p style="text-align:center;">'.makesize($user['uploaded']).'</p></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td class="tableTitle">Download</td><td class="tableRow2" colspan="2"><p style="text-align:center;">'.makesize($user['downloaded']).'</p></td>';
        echo '</tr>';

       echo '<tr>';
                $sql = "SELECT COUNT(*) AS nbtorrents FROM torrents WHERE pseudo_torr = '".$result['nomuser']."' ";
                $req = mysql_query($sql) or die('Erreur dans <em>"'.$sql.'"</em>:<br/>'.mysql_query());
                $data = mysql_fetch_assoc($req);
                $nbtorrents = $data['nbtorrents'];
        echo '<td class="tableTitle">Nb de torrents uploadés</td><td class="tableRow1" colspan="2"><p style="text-align:center; font-weight:bold; font-size:10pt;">'.$nbtorrents.'</p></td>';
        echo '</tr>';

        if ($nbtorrents == 0) {
        // si pas de torrent proposé par le membre, on n'affiche pas la liste des torrents proposés ! :D bien sur !!! Il est con lui ;)
        }

        else {
                echo '<tr><td class="tableTitle">10 derniers torrents uploadés</td><td class="tableRow2" colspan="2">';
                $sql2 = "SELECT * FROM torrents WHERE pseudo_torr = '".$result['nomuser']."' ORDER BY date_torr DESC LIMIT 10 ";
                $req2 = mysql_query($sql2) or die('Erreur dans <em>"'.$sql2.'"</em>:<br/>'.mysql_query());
                while($data2 = mysql_fetch_assoc($req2)) {
                echo '<ul><li><b>['.stripslashes($data2['cat_torr']).']</b>&nbsp;<a style="color: black; text-decoration:none;" href="detail.php?id='.$data2['id_torr'].'">'.stripslashes($data2['nom_torr']).'</a></li></ul>';
                }
        }
        echo '</td></tr>';

       echo '<tr>';
                $sql = "SELECT COUNT(*) AS downtorr FROM xbt_files_users WHERE uid = '".$result['iduser']."' AND downloaded > '0' ";
                $req = mysql_query($sql) or die('Erreur dans <em>"'.$sql.'"</em>:<br/>'.mysql_query());
                $data = mysql_fetch_assoc($req);
                $downtorr = $data['downtorr'];
        echo '<td class="tableTitle">Nb de torrents téléchargés</td><td class="tableRow1" colspan="2"><p style="text-align:center; font-weight:bold; font-size:10pt;">'.$downtorr.'</p></td>';
        echo '</tr>';

        if ($downtorr == 0) {
        // si pas de torrent téléchargé par le membre, on n'affiche pas la liste des torrents proposés ! :D bien sur !!! Il est vraiment con lui ;)
        }

        else {
        echo '<tr><td class="tableTitle">10 derniers torrents téléchargés</td><td class="tableRow2" colspan="2">';
        $sql3 = "SELECT * FROM xbt_files_users LEFT JOIN torrents ON torrents.id_torr = xbt_files_users.fid WHERE uid = '".$result['iduser']."' AND downloaded > '0' ORDER BY date_torr DESC LIMIT 10 ";
        $req3 = mysql_query($sql3) or die('Erreur dans <em>"'.$sql3.'"</em>:<br/>'.mysql_query());
        while($data3 = mysql_fetch_assoc($req3)) {
        echo '<ul><li><b>['.stripslashes($data3['cat_torr']).']</b>&nbsp;<a style="color: black; text-decoration:none;" href="detail.php?id='.$data3['id_torr'].'">'.stripslashes($data3['nom_torr']).'</a></li></ul>';
                }
        }

        echo '</td></tr>';

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

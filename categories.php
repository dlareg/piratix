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
        <div id="navigation">
           <ul>
              <li><a href="index.php">ACCUEIL</a></li>
              <li><a href="torrents.php">TORRENTS</a></li>
              <li><a href="upload.php">UPLOAD</a></li>
              <li><a href="categories.php" class="active">CATEGORIES</a></li>
              <li><a href="stats.php">STATS</a></li>
              <li><a href="forum.php">FORUM</a></li>
	      <li><a href="news.php">NEWS</a></li>
              <li><a href="membres.php">MEMBRES</a></li>
              <li><a href="contact.php">CONTACT</a></li>
              <li><a href="apropos.php">A PROPOS</a></li>
           </ul>
        <div class="cl">&nbsp;</div>
        </div>
<!-- /Navigation -->
	
<!-- Main -->
<div id="main">
	
	<!-- Content -->
	<div id="content">

	<div class="box last">
	<h2><span>Catégories des torrents</span></h2>
	<br /><br />

<?php

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$sql = 'SELECT * FROM categories LEFT JOIN torrents ON categories.nomcat = torrents.cat_torr ORDER BY nomcat ASC';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
    // on affiche les informations de l'enregistrement en cours
    echo '<br /><br />';
    echo '<img src="images/categories/'.$data['imagecat'].'" style="border:0px; float:left; width: 24px; height: 24px;" alt="'.stripslashes($data['nomcat']).'" title="'.stripslashes($data['nomcat']).'" />
	&nbsp;<h4><a style="text-decoration:none;" href="categorie-detail.php?id='.$data['idcat'].'">'.stripslashes($data['nomcat']).'</a></h4>';

    if (!empty($data['nom_torr'])) {
    echo '<ul>';
    echo '<li><a href="detail.php?id='.$data['id_torr'].'">'.stripslashes($data['nom_torr']).'</a></li>';
    echo '</ul>';
    }
    else {
    // on affiche rien si pas de torrent dans la catégorie
    }

    //echo '<br />';

} // fin while

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

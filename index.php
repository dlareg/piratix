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
                                                <input type="text" value="Rechercher un torrent ..." title="Rechercher un torrent ..." id="search-string" name="requete" class="field" />
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

			<!-- Edito -->			
			<div class="edito">
				<h2><span>PIRATIX : SITE DE TELECHARGEMENT DE MEDIAS LIBRES</span></h2>
				<br /><br /><br />
				<p style="font-size: 11pt;">sous <span style="font-weight: bold;">Licences Libres</span> ou sous <span style="font-weight: bold;">Licences de Libre Diffusion (LLD)</span></p>
				
				<!-- <img src="<?php echo $LOGOSITEFT; ?>" alt="<?php echo $SITENAME; ?>" style="float: left; margin-right: 5px;" title="<?php echo $SITENAME; ?>" />
				<p style="line-height: 16px; font-size: 11pt;">Freetorrent est un projet basé sur le partage et la promotion des logiciels libres et des contenus libres sous licence libre ET sous Licence de Libre Diffusion (LLD) (pour tout système : Microsoft Windows™, Gnu/Linux, Mac OS, xBSD, ...).<br />
				Freetorrent propose de rassembler et de rendre ces médias disponibles par l'intermédiaire du réseau Peer to peer en utilisant le protocole Bittorrent et souhaite ainsi créer une dynamique communautaire culturelle libre, pour tous, par tous.<br />
				<span style="font-style: italic;">
				Vous trouverez notamment <a href="http://www.gnu.org/licenses/license-list.fr.html">une liste de licences libres compatibles GNU ici</a> ainsi qu'<a href="http://www.opensource.org/licenses/">une liste de licences compatibles Opensource ici</a>.<br />
				Vous trouverez <a href="http://www.covertprestige.net/textes/la-libre-diffusion.html">une présentation des Licences de Libre Diffusion ici</a>. 
				Vous trouverez <a href="http://www.dogmazic.net/static.php?op=tableau_licences.php">une liste de licences libres applicables à la musique ici</a>.
				</span><br /> -->
			</div>

			<div class="edito">
			<h2><span>EDITO ...</span></h2>
			<p style="text-align: justify;">
		  	<span style="font-size: 10pt; font-weight: bold;">ATTENTION : site en beta-test !!!</span><br />
			Piratix est un "YAPFXFE" (Yet Another Project For Xbtt Front-End), un projet visant à créer un front-end au tracker bittorrent XBT d'<a href="http://xbtt.sourceforge.net/tracker/">Olaf Van Der Spek</a>. Ecrit en C++, ce tracker offre de très bonnes performances et consomme peu de ressources. XBT stocke ses données dans une base MySQL.
			XBT Tracker est un tracker "pure" qui n'offre pas de "frontend". Le but du projet Piratix est donc de proposer un "frontend" en PHP + MySQL. C'est un très bon exercice pour qui veut apprendre ou revoir "le monde du php" ainsi que celui du protocole Bittorrent ...<br/>
			Certaines fonctionnalités ne fonctionnent pas où ne sont pas encore implémentées. Mais le système de tracker en lui-même fonctionne. Vous pourrez uploader et télécharger les torrents après inscription.<br/>
			Merci de faire remonter tout disfonctionnement... et vos remarques/critiques constructives.<br />
			Voir rubrique "Les news" pour les dernières infos du site.
			<br /></p>
			</div>


			<!-- News -->
			<div class="box">
				<h2><span>Les dernières news ...</span></h2>
				<a href="news.php" class="see-all">Voir toutes les news</a>
				<div class="cl">&nbsp;</div>
				<div class="posts">
				    <!-- Post -->
				 <div class="post">
				 <fieldset style="padding: 5px 5px 5px 5px;">
				    	<div class="data2">
                                <?php
                                   $base = mysql_connect ($serveurdb, $logindb, $passworddb);
                                   mysql_select_db ($basedb, $base);

                                   $sql = 'SELECT * FROM news ORDER BY date_news DESC LIMIT 0,1';

                                   // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
                                  $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                  // on compte le nombre de news stockées dans la base de données
                                  $nb_news = mysql_num_rows($req);

                                  // si on a au moins une news, on l'affiche
                                  while ($data = mysql_fetch_array($req)) {
                                        echo '<h4 style="background-color: #FFFCCF;"><img src="images/seed1.png" style="float: left; margin-right: 5px;" alt="" /><a href="news.php">' . $data['titre_news'] . '</a></h4>';
                                        echo '<p style="font-style: italic;">Le ' . $data['date_news'] . ', par ' . $data['auteur_news'] . '</p>';

					$max = 150;
					$chaine = stripslashes($data['texte_news']);
					   if (strlen($chaine) >= $max) {
					     $chaine = substr($chaine, 0, $max);
					     $espace = strrpos($chaine, " ");
					     $chaine = substr($chaine, 0, $espace)."<span style=\"font-size: 10px;\"><a href=\"news.php\">... [ Lire la suite ]</a></span>";
					   }

                                        echo '<p style="text-align: justify; font-size: 12px;">' . $chaine . '</p>';
                                }

                                ?>
				    	</div>
				 </fieldset>
				 </div>
				 <!-- /Post -->

				 <!-- Post -->
				 <div class="post last">
				 <fieldset style="padding: 5px 5px 5px 5px;">
				    	<div class="data2">
                                <?php
                                   $base = mysql_connect ($serveurdb, $logindb, $passworddb);
                                   mysql_select_db ($basedb, $base);

                                   $sql = 'SELECT * FROM news ORDER BY date_news DESC LIMIT 1,1';

                                   // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
                                  $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                  // on compte le nombre de news stockées dans la base de données
                                  $nb_news = mysql_num_rows($req);

                                  // si on a au moins une news, on l'affiche
                                  while ($data = mysql_fetch_array($req)) {
                                        echo '<h4 style="background-color: #FFFCCF;"><img src="images/seed1.png" style="float: left; margin-right: 5px;" alt="" /><a href="news.php">' . $data['titre_news'] . '</a></h4>';
                                        echo '<p style="font-style: italic;">Le ' . $data['date_news'] . ', par ' . $data['auteur_news'] . '</p>';

                                        $max = 150;
                                        $chaine = stripslashes($data['texte_news']);
                                           if (strlen($chaine) >= $max) {
                                             $chaine = substr($chaine, 0, $max);
                                             $espace = strrpos($chaine, " ");
                                             $chaine = substr($chaine, 0, $espace)."<span style=\"font-size: 10px;\"><a href=\"news.php\">... [ Lire la suite ]</a></span>";
                                           }

                                        echo '<p style="text-align: justify; font-size: 12px;">' . $chaine . '</p>';
                                }

                                ?>
				    	</div>
				    </fieldset>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /News -->

			<!-- Box -->
			<div class="box last">
				<h2><span>Les 10 derniers torrents</span></h2>
				<a href="torrents.php" class="see-all">Voir tous les torrents</a>
				<div class="cl">&nbsp;</div>

				<div class="posts">


				<!-- Post ligne 1 : 1er torrent -->
				<?php
				$sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 0,1';
				$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				while($data = mysql_fetch_assoc($req))
    				{
				?>
				    <div class="post">
				    	<div class="image">
						<?php
						if (empty($data['image_torr'])) {
						   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
						}
						else {
						?>
				    		<a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
						<?php } // fin if noimage ?> 
				    	</div>
				    	<div class="data">
				    		<h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
						<p style="font-size: 7pt; background: #fffcce;">
							Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> | 
							Par <?php echo $data['pseudo_torr']; ?> | 
							<?php
							  sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
							  echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
							?>
							Taille : <?php echo makesize($data['taille_torr']); ?> | 
							Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> | 
							Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> | 
							Complet. : <?php echo $data['completed']; ?></p>
				    		<p style="text-align: justify;">
						<?php
						$max = 200;
						$chaine = stripslashes($data['description_torr']);
						if (strlen($chaine) >= $max) {
						$chaine = substr($chaine, 0, $max);
						$espace = strrpos($chaine, " ");
						$chaine = substr($chaine, 0, $espace)."... ";
						}
						echo '<p style="text-align: justify;">' . $chaine;
      						echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
						?>
						</p>
				    	</div>
				    </div>
					<?php 
					} // fin while
					?>
				    <!-- /Post -->

				    <!-- Post ligne 1 : 2ème torrent -->
                                <?php
                                // affichage des torrents
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 1,1';
                                // on envoie la requête
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                // on fait une boucle qui va faire un tour pour chaque enregistrement
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <!-- Post -->
                                    <div class="post last">
                                        <div class="image">
					        <?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
				    <!-- /Post -->

                                <!-- Post ligne 2 : 3ème torrent -->
                                <?php
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 2,1';
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <div class="post">
                                        <div class="image">
					        <?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->

									
                                    <!-- Post ligne 2 : 4ème torrent -->
                                <?php
                                // affichage des torrents
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 3,1';
                                // on envoie la requête
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                // on fait une boucle qui va faire un tour pour chaque enregistrement
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <!-- Post -->
                                    <div class="post last">
                                        <div class="image">
					        <?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->

				<!-- Post ligne 3 : 5ème torrent -->
                                <?php
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 4,1';
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <div class="post">
                                        <div class="image">
					        <?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->
		
                                    <!-- Post ligne 3 : 6ème torrent -->
                                <?php
                                // affichage des torrents
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 5,1';
                                // on envoie la requête
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                // on fait une boucle qui va faire un tour pour chaque enregistrement
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <!-- Post -->
                                    <div class="post last">
                                        <div class="image">
					        <?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->

			            <!-- Post ligne 4 : 7ème torrent -->
                                <?php
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 6,1';
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <div class="post">
                                        <div class="image">
					<?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->

                                <!-- Post ligne 4 : 8ème torrent -->
                                <?php
                                // affichage des torrents
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 7,1';
                                // on envoie la requête
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                // on fait une boucle qui va faire un tour pour chaque enregistrement
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <!-- Post -->
                                    <div class="post last">
                                        <div class="image">
					<?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->
									
					<!-- Post ligne 5 : 9ème torrent -->
                                <?php
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 8,1';
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <div class="post">
                                        <div class="image">
					<?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->

									
                                <!-- Post ligne 5 : 10ème torrent -->
                                <?php
                                // affichage des torrents
                                $sql = 'SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid LEFT JOIN categories ON torrents.cat_torr = categories.nomcat LEFT JOIN licences ON torrents.licence_torr = licences.lnom ORDER BY xbt_files.ctime DESC LIMIT 9,1';
                                // on envoie la requête
                                $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

                                // on fait une boucle qui va faire un tour pour chaque enregistrement
                                while($data = mysql_fetch_assoc($req))
                                {
                                ?>
                                    <!-- Post -->
                                    <div class="post last">
                                        <div class="image">
					<?php
                                                if (empty($data['image_torr'])) {
                                                   echo '<a href="detail.php?id=' . $data['id_torr'] . '"><img style="width: 72px; height: 72px;" src="/images/noimage.png" alt="' . $data['nom_torr'] . '" /></a>';
                                                }
                                                else {
                                                ?>
                                                <a href="detail.php?id=<?php echo $data['id_torr']; ?>"><img style="width: 72px; height: 72px;" src="/images/imgtorrents/<?php echo $data['image_torr']; ?>" alt="<?php echo $data['nom_torr']; ?>" /></a>
                                                <?php } // fin if noimage ?>
                                        </div>
                                        <div class="data">
                                                <h4><a href="detail.php?id=<?php echo $data['id_torr']; ?>">[<?php echo $data['cat_torr']; ?>] <?php echo $data['nom_torr']; ?></a></h4>
                                                <p style="font-size: 7pt; background: #fffcce;">
                                                        Licence : <a href="licences.php?id=<?php echo $data['lid']; ?>"><?php echo $data['licence_torr']; ?></a> |
                                                        Par <?php echo $data['pseudo_torr']; ?> |
                                                        <?php
                                                          sscanf($data['date_torr'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
                                                          echo '<b>le </b>'.$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde.'<br/>';
                                                        ?>
                                                        Taille : <?php echo makesize($data['taille_torr']); ?> |
                                                        Seeders : <span style="color: green;"><?php echo $data['seeders']; ?></span> |
                                                        Leechers : <span style="color: red;"><?php echo $data['leechers']; ?></span> |
                                                        Complet. : <?php echo $data['completed']; ?></p>
                                                <p style="text-align: justify;">
                                                <?php
                                                $max = 200;
                                                $chaine = stripslashes($data['description_torr']);
                                                if (strlen($chaine) >= $max) {
                                                $chaine = substr($chaine, 0, $max);
                                                $espace = strrpos($chaine, " ");
                                                $chaine = substr($chaine, 0, $espace)."... ";
                                                }
                                                echo '<p style="text-align: justify;">' . $chaine;
                                                echo '[ <a style="text-decoration: none;" href="detail.php?id=' . $data['id_torr'] . '">Lire la suite</a> ]</p>';
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                        <?php
                                        } // fin while
                                        ?>
                                    <!-- /Post -->


				    <div class="cl">&nbsp;</div>

				</div>
			</div>
			<!-- /Box -->






									
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

<?php
	require_once("include/config.php");
	require_once("include/settings.php");
	require_once("include/functions.php");
?>
<!-- decoupage sidebar -->		
		<!-- Sidebar -->
		<div id="sidebar">

                        <div class="nav-box">
                           <h2><span>A SUIVRE ...</span></h2>
				&nbsp;&nbsp;<a href="http://piratix.mumbly58.net/rss.php"><img src="images/social/feed.png" alt="Feed : flux RSS" style="width: 36px; height: 36px;" /></a>&nbsp;&nbsp;
				<!-- <a href="http://www.twitter.fr"><img src="images/social/twitter.png" alt="Twitter" style="width: 36px; height: 36px;" /></a>&nbsp;&nbsp;
				<a href="http://identi.ca"><img src="images/social/identica.png" alt="Identica" style="width: 36px; height: 36px;" /></a> -->
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr" data-size="large" data-count="none">Tweeter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				<br/><br/>
			</div>
			<br/>

			<div class="nav-box">
				<h2><span>EN LIGNE</span></h2>
				   <p style="font-size: 10pt; text-align: center;"><?php include("connectes.php"); ?></p>
				   <p style="font-size: 10pt; text-align: center;"><?php include("connectes-membres.php"); ?></p><br/>
			</div>
			<br />

                        <div class="nav-box">
                                <h2><span>DERNIER INSCRIT</span></h2>
					<?php
                                	$base = mysql_connect ($serveurdb, $logindb, $passworddb);
                                	mysql_select_db ($basedb, $base);

					$sql=mysql_query("SELECT * FROM users ORDER BY dateuser DESC LIMIT 1");
					$result = mysql_fetch_assoc($sql);
				      	   echo '<p style="font-size: 10pt; text-align: center;">' . $result['nomuser'];
					      if ($result['activeuser'] == 0) {
					         echo "&nbsp;<span style=\"color: red; font-size: 8pt;\">[V]</span>";
					      }
					      else {
					         echo "&nbsp;<span style=\"color: green; font-size: 8pt;\">[M]</span>";
					      }
					   echo '</p><br/>';
					?>
                        </div>

                <br />
	
			<!-- Categories -->
			<div class="nav-box">
				<h2><span>CATEGORIES</span></h2>				

	                    <?php
                        	//$sql=mysql_query("SELECT categories.nomcat, categories.imagecat, categories.idcat, torrents.categorie, COUNT(torrents.categorie) AS count from categories, torrents WHERE torrents.categorie = categories.nomcat GROUP BY categories.nomcat ORDER BY categories.nomcat");
				$sql=mysql_query("SELECT * FROM categories ORDER BY nomcat");

                        	print("<ul>");
                                while($list=mysql_fetch_assoc($sql))
                                        {
				 	echo "<li><a href=\"categorie-detail.php?idcat=".$list['idcat']."\">".stripslashes($list['nomcat'])."</a></li>";
                                        //print("(".$list['count'].")</OPTION>");
                                        }
                        	print("</ul>");
				//print("<br /><br />");
                    	?>
			</div>
			<!-- /Categories -->			

			<br />
			
			<!-- Licences -->
			<?php
			/*
			<div class="nav-box">
				<h2><span>LICENCES</span></h2>
				<?php
					$sql=mysql_query("SELECT * FROM licences ORDER BY lnom ASC");
					print("<SELECT>");
					while($list=mysql_fetch_assoc($sql))
						{
						   print("<OPTION><a href=\"" . $list['lurl'] . "\">" . $list['lnom'] . "</a></OPTION>");
						}
					print("</SELECT>");
				?>
			<br /><br />
			</div>
			<!-- /licences -->			

			<br />
			*/
			?>
		

			<div class="nav-box">
			<h2><span>Besoin de seed</span></h2>
			<?php
			   $sql = mysql_query("SELECT * FROM xbt_files LEFT JOIN torrents ON torrents.id_torr=xbt_files.fid WHERE seeders = '0' AND leechers > '0'");

			   echo '<ul>';
			   while($data=mysql_fetch_assoc($sql)) 
			      {
				echo '<li><a href="detail.php?id=' . $data['id_torr'] . '">' . $data['nom_torr'] . '</a></li>';	
			      }
			   echo '</ul>';
			?>

			</div>
			<br />
	
			
			<!-- Stats -->
			<div class="nav-box">
				<h2><span>Stats tracker</span></h2>
				<?php				   
				   $base = mysql_connect ($serveurdb, $logindb, $passworddb);
				   mysql_select_db ($basedb, $base);
				
				        $results = mysql_query("select info_hash, sum(completed) completed, sum(leechers) leechers, sum(seeders) seeders, sum(leechers or seeders) torrents from xbt_files");
        				$result = mysql_fetch_assoc($results);
        				$result['peers'] = $result['leechers'] + $result['seeders'];

        				print('<table style="text-align: left;">');
        				printf('<tr><th>Torrents chargés : <td>%d</td><td>', $result['completed'], '</td></tr>');
        				printf('<tr><th>Clients : <td>%d</td>', $result['peers'], '</td></tr>');

        				if ($result['peers'])
        				{
                			printf('<tr><th>Leechs : <td>%d <span style="font-size:7pt;">(%d %%)</span>', $result['leechers'], $result['leechers'] * 100 / $result['peers'], '</td></tr>');
                			printf('<tr><th>Seeds : <td>%d <span style="font-size:7pt;">(%d %%)</span>', $result['seeders'], $result['seeders'] * 100 / $result['peers'], '</td></tr>');
        				}

        				printf('<tr><th>Torrents actifs : <td>%d</td><td>', $result['torrents'], '</td></tr>');

                			$nbr = mysql_query("SELECT id_torr FROM torrents");
                			$nbrtorrents = mysql_num_rows($nbr);

        				printf('<tr><th>Total torrents : <td>%d</td>', $nbrtorrents ,'<td></td></tr>');

        				$res = mysql_query("select sum(downloaded) as down, sum(uploaded) as up from xbt_users");
        				$row = mysql_fetch_array($res);

        				$dled=makesize($row['down']);
        				$upld=makesize($row['up']);
        				$traffic=makesize($row['down'] + $row['up']);

        				printf('<tr><th>Total Down : <td>'. $dled. '</td></tr>');
        				printf('<tr><th>Total Up : <td>'. $upld. '</td></tr>');
        				printf('<tr><th>Trafic total : <td>'. $traffic. '</td></tr>');
				
					//printf('<tr><th><br />Visites totales : <td><br />');
						
						/**** compteur de visites ***/
						
						// Connexion à MySQL
						mysql_connect($serveurdb, $logindb, $passworddb);
						mysql_select_db($basedb);

						// ETAPE 1 : on vérifie si l'IP se trouve déjà dans la table
						// Pour faire ça, on n'a qu'à compter le nombre d'entrées dont le champ "ip" est l'adresse ip du visiteur
						$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM compteur WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
						$donnees = mysql_fetch_array($retour);
 
						if ($donnees['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
						{
    							mysql_query('INSERT INTO compteur VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
						}
						else // L'ip se trouve déjà dans la table, on met juste à jour le timestamp
						{
    							mysql_query('UPDATE compteur SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
						}

						/* 
						$timestamp_5min = time() - (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes
						$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE timestamp>\'' . $timestamp_5min . '\'');
						$donnees = mysql_fetch_array($retour);
 
						if ($donnees['nbre_entrees'] == 1)// respect du singulier
						{
  							echo '<strong>' . $donnees['nbre_entrees'] . '</strong> visiteur connecté<br />';
						}
						else
						{
  							echo '<strong>' . $donnees['nbre_entrees'] . '</strong> visiteurs connectés<br />';
						}
						*/ 

						$jour = date('d');
						$mois = date('m');
						$annee = date('Y');
						$aujourd_hui = mktime(0, 0, 0, $mois, $jour, $annee);
						$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM compteur WHERE timestamp>\'' . $aujourd_hui . '\'');
						$donnees = mysql_fetch_array($retour);
 
						//if ($donnees['nbre_entrees'] == 1)// respect du singulier
						//{
							printf('<tr><th>Visites aujourd\'hui&nbsp;:&nbsp;<td>' . $donnees['nbre_entrees']) . '</td></tr>';
  							//echo '<strong>' . $donnees['nbre_entrees'] . '</strong> visiteur aujourd\'hui<br />';
						//}
						//else
						//{
							//echo '<strong>' . $donnees['nbre_entrees'] . '</strong> visiteurs aujourd\'hui<br />';
						//} 	 
 
						$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM compteur');
						$donnees = mysql_fetch_array($retour);
 
						//echo '<strong>' . $donnees['nbre_entrees'] . '</strong> visites au total<br />';
						printf('<tr><th>Visites totales : <td>' . $donnees['nbre_entrees'] . '</td></tr>');

						/**** Fin compteur de visites ****/

					printf('</td></tr>');

					$membres = mysql_query('SELECT COUNT(*) AS nbmembres FROM users WHERE iduser > "1" AND activeuser = "1"');
					$donneesmembres = mysql_fetch_array($membres);
					printf('<tr><th>Nb de membres : <td>' . $donneesmembres['nbmembres'] . '</td></tr>');


        				printf('</table><br />');

					//include("startCamembert.php");	
				?>
			</div>
<br />

		</div>

		<!-- /Sidebar -->

<!-- fin découpage sidebar -->

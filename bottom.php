<!-- Bottom -->
	<div id="bottom">
		<div class="bg-top">
			<div class="bg-bottom">
				<!-- Box - Popular Posts -->
				<div class="box">
					<h3 class="star"><span>TOP 5 TORRENTS</span></h3>
					
					<div class="popular-posts">
						<ul>
<?php
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);


$sql = 'SELECT * FROM xbt_files LEFT JOIN torrents ON torrents.id_torr=xbt_files.fid ORDER BY completed DESC LIMIT '.$MOSTSEEDTORRLIMIT.'';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
while($data = mysql_fetch_assoc($req))
    {
?>
		<!-- Post -->
		<li>
		     <div class="data">
		    	<h6><img src="images/seed1.png" alt="" style="float: left; margin-right: 5px;" /><a href="detail.php?id=<?php echo $data['id_torr']; ?>"><?php echo $data['nom_torr']; ?></a><br /><p>Licence : <?php echo $data['licence_torr']; ?> | 
			S : <span style="color: green;"><?php echo $data['seeders']; ?></span> | L : <span style="color: red;"><?php echo $data['leechers']; ?></span> | C : <span style="color: white;"><?php echo $data['completed']; ?></span></p></h6>
		     </div>
		     <div class="cl">&nbsp;</div>
		</li>
		<!-- /Post -->
<?php
} // fin du while $data
?>				    
		</ul>
	</div>								
	<div class="cl">&nbsp;</div>
</div>
<!-- /Box -->
				
<!-- Box - Latest Comments -->
				<div class="box">
					<h3 class="bubble"><span>3 DERNIERS COMMENTAIRES</span></h3>
					
					<div class="latest-comments">
						<ul>
							<!--  Comment -->
							<?php
							$sql = 'SELECT * FROM comments LEFT JOIN torrents ON torrents.id_torr = comments.cid_torrent ORDER BY cadded DESC LIMIT '.$LASTCOMMENTLIMIT.'';
							$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
							while($data = mysql_fetch_assoc($req))
    							   {
								// on limite à 100 caractèrse le texte du commentaire
								$max = 100;
								$chaine = stripslashes($data['ctext']);
    								if (strlen($chaine) >= $max) {
    									$chaine = substr($chaine, 0, $max);
    									$espace = strrpos($chaine, " ");
    									$chaine = substr($chaine, 0, $espace)." [...]";
    								}

								echo '<li>';
								echo '<img src ="images/commenticon.png" alt="" style="float: left; margin-right: 5px;" />';
								echo '<h6><a href="detail.php?id=' . $data['cid_torrent'] . '#comments' . $data['cid'] . '">[' .  $data['nom_torr'] . ']</a></h6>';

								// on décompose la date
								sscanf($data['cadded'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
								echo '<p style="font-style: italic; font-size: 11px;">Le ' . $jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde . ', par ' . $data['cuser'] . '</p>';
								echo '<br/><p style="text-align: justify;">' . $chaine . '</p>';
								echo '</li>';
							   }
							?>
						    <!--  /Comment -->
						</ul>
					</div>
				</div>
				<!-- /Box -->
				

				<div class="box last">
					<h3 class="star"><span>DERNIERS POSTS DU FORUM</span></h3>
					
					<div class="latest-comments">
						<ul>
						<!-- Derniers commentaires du forum -->
						<?php
						 $sql = 'SELECT * FROM forum_sujets LEFT JOIN forum_reponses ON forum_reponses.correspondance_sujet = forum_sujets.id_forum ORDER BY date_reponse DESC LIMIT 5';
                                                        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
                                                        while($data = mysql_fetch_assoc($req))
							{
							echo '<img src ="images/com.gif" alt="" style="float: left; margin-right: 5px;" />';
						
							// on décompose la date
                                                        sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
						  	echo '<li><h6><a href="'.$SITEURL.'/lire_sujet.php?id_sujet_a_lire=' . $data['id_forum'] . '">'.$data['titre_forum'].'</a></h6>';
							echo '<p style="font-style: italic; font-size: 11px;">Dernier post par ' . $data['auteur_forum_reponse'] . ', ';
							echo 'le ' . $jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute.':'.$seconde;
							echo '</li>';
							}
						?>
						<!-- /Derniers commentaires du forum -->	
						</ul>
					</div>

				</div>
				<!-- /Box -->			
				
				<div class="cl">&nbsp;</div>
			</div>		
		</div>
	</div>
<!-- /Bottom -->

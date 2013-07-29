<?php
if (isset($_SESSION['login'])) {
?>
	<table style="width: 100%;">
	 <tr>
	   <td><a href="#">Bienvenue <?php echo stripslashes(htmlentities(trim($_SESSION['login']))); ?> !</a>
		<span style="font-weight: bold;"><a href="logout.php">Déconnexion</a></span>
	   </td>
	 </tr>

        <?php
        $base = mysql_connect ($serveurdb, $logindb, $passworddb);
        mysql_select_db ($basedb, $base);
	
	// Messagerie : on cherche tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
	$sql = 'SELECT titre_message, date_message, users.nomuser as expediteur, messages.id_message as id_message FROM messages, users WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=users.iduser ORDER BY date_message DESC';  
	// lancement de la requete SQL
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
	$nb = mysql_num_rows($req);

	//if ($nb == 0) { 
   	//echo 'Vous n\'avez aucun message.';
	//echo '<a href="#">Messagerie (<span style="color: orange;">0</span>)</a>';
	//}  
	//else {
	
	echo '<tr><td><a href="lire_message.php">Messagerie ( <span style="color: orange;">' . $nb . '</span> )</a>'; 
   		// si on a des messages, on affiche le nombre de message avec un lien vers la page lire.php
   		//while ($data = mysql_fetch_array($req)) { 
      		   //echo '<a href="lire_message.php?id_message=' . $data['id_message'] . '"><span style="color: orange;">' . $nb . '</span></a>'; 
   		//}
	//}

	//mysql_free_result($req);  
	//mysql_close();

	//print_r($_SESSION);
	?>

	<?php
	$sql0 = "SELECT * FROM users WHERE nomuser='" . $_SESSION['login'] . "'";
	$req0 = mysql_query($sql0) or die('Erreur SQL !<br>'.$sql0.'<br>'.mysql_error());
	$result0 = mysql_fetch_assoc($req0);
	$id = $result0['iduser'];
	?>

		<a href="moncompte.php?id=<?php echo $id; ?>">Mon compte</a>

	<?php
	$sql = "SELECT * FROM xbt_users WHERE uid='" . $id . "'";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$result = mysql_fetch_assoc($req);

	$uploaded = $result['uploaded'];
	$downloaded = $result['downloaded'];

	echo '<a href="#"><span style="color: green; font-weight: bold;">&#8593;&nbsp;</span>Up : ' . makesize($result['uploaded']) . '</a>';
	echo '<a href="#"><span style="color: red; font-weight: bold;">&#8595;&nbsp;</span>Down : ' . makesize($result['downloaded']) . '</a>';

	if ($result['downloaded']>0) {
		$ratio = $result["uploaded"] / $result["downloaded"];
                $ratio = number_format($ratio, 2);
        }
        else 
                $ratio = 'Non défini';
                echo '<a href="#">Ratio : ' . $ratio . '</a></td></tr></table>';
	
}

else {
?>
        <a href="login.php">Connexion</a>
        <a href="signup.php">S'enregistrer</a>
<?php
}
?>

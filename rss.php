<?php
header('Content-type: text/xml'); 
echo '<?xml version="1.0" encoding="UTF-8" ?>'
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">

<?php
$nomsite = "piratix.mumbly58.net";
?>

      <channel>
      	    	<title>piratix.mumbly58.net</title>
		<language>fr</language>
      	    	<link>piratix.mumbly58.net</link>
		<lastBuildDate><?php print date("D, d M Y H:i:s O");?></lastBuildDate>
      	    	<description>piratix.mumbly58.net : Partage par bitorrent de tous médias sous licence libre ou licence libre de diffusion</description>
		<copyright><?php print "(copyleft)". date("Y",time())." " .$nomsite; ?></copyright>
		<atom:link href="http://piratix.mumbly58.net/rss.php" rel="self" type="application/rss+xml" />

      	    	<?php
      	    	require_once("include/config.php");
		require_once("include/settings.php");
		
		$base = mysql_connect ($serveurdb, $logindb, $passworddb);
       		mysql_select_db ($basedb, $base);

      	    	$sql = "SELECT * FROM torrents LEFT JOIN xbt_files ON torrents.id_torr = xbt_files.fid ORDER BY date_torr DESC LIMIT 10";
      	    	$req = mysql_query($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

      	    	while($data=mysql_fetch_assoc($req)) {

			$id=$data['id_torr'];
    			$filename = preg_replace(array('/</', '/>/', '/"/'), array('&lt;', '&gt;', '&quot;'), stripslashes($data['nom_torr']));
    			$cat=stripslashes($data['cat_torr']);
    			$seeders=strip_tags($data['seeders']);
    			$leechers=strip_tags($data['leechers']);
    			$desc=stripslashes($data['description_torr']);
			$torrent=stripslashes($data['fichier_torr']);
    			//$f=rawurlencode($data['nom']);
		    	$taille=strip_tags($data['taille_torr']);

    			// output to browser
      	    		echo "<item>\n";
      	    		echo "<title><![CDATA[[$cat] $filename [seeders ($seeders)/leechers ($leechers)]]]></title>\n";
      	    		echo "<link>http://piratix.mumbly58.net/detail.php?id=$id</link>\n";
			echo "<guid>http://piratix.mumbly58.net/detail.php?id=$id</guid>\n";
                        echo "<category>".$cat."</category>\n";
      	    		echo "<description><![CDATA[".$desc."]]></description>\n";
			echo "<enclosure url=\"http://piratix.mumbly58.net/torrents/".$torrent."\" length=\"".$taille."\" type=\"application/x-bittorrent\" />";
      	    		echo "<pubDate>".date("D, d M Y H:i:s",$data["ctime"])." GMT</pubDate>\n";
      	    		echo "</item>\n";
      	    	}	    	
      	    	?>
      </channel>
</rss>

<?php

session_start();

require("include/functions-torrent.php");
require("include/config.php");
require("include/settings.php");


// Connexion SQL
$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

$fid = $_GET['id'];
//$uid = $_SESSION["login"];

$sql0 = "SELECT * FROM users WHERE nomuser='" . $_SESSION["login"] . "'";
$req0 = mysql_query($sql0) or die('Erreur SQL !<br>'.$sql0.'<br>'.mysql_error());
$result0 = mysql_fetch_assoc($req0);

if (!isset($_SESSION["login"])) {
	$uid = '1';
}
else {
	$uid = $result0['iduser'];
}

// on recherche le hash dans la base xbt_files
$sql = "SELECT * FROM xbt_files WHERE fid='".$fid."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$result = mysql_fetch_assoc($req);
$info_hash = bin2hex($result['info_hash']);

// On recherche le torrent dans la base torrents
$sql = "SELECT * FROM torrents WHERE id_torr='".$fid."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$row = mysql_fetch_assoc($req);

$torrent = $row['fichier_torr'];
$torrentfile = 'http://piratix.mumbly58.net/torrents/'.$torrent;

// On décode le fichier torrent
$data = bdec(file_get_contents($torrentfile));

$user=mysql_fetch_row(mysql_query("SELECT torrent_pass_version FROM xbt_users WHERE uid='".$uid."'"));
$torrent_pass_version=$user[0];

$config=mysql_fetch_row(mysql_query("SELECT value FROM xbt_config WHERE name='torrent_pass_private_key'"));
$torrent_pass_private_key=$config[0];

//$passkey=sprintf('%08x%s', $uid, substr(sha1(sprintf('%s %d %d %s', $torrent_pass_private_key, $torrent_pass_version, $uid, pack('H*', $info_hash))), 0, 24));
$sql = "SELECT * FROM users WHERE iduser='".$uid."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$result = mysql_fetch_assoc($req);

if ($result['pid'] == '00000000000000000000000000000000') {
	$pid = '00000000000000000000000000000000';
}
else {
	$pid = $result['pid'];
}

// On construit la nouvelle announce avec le pid (passkey ...)
$announce_url=parse_url("http://piratix.mumbly58.net:9005/announce");
$announce_url=sprintf('http://%s:%d/%s/announce', $announce_url['host'], $announce_url['port'], $pid);

// info key (http://wiki.theory.org/BitTorrentSpecification)
$decoded = $data['info'];

// On construit le nouveau fichier torrent
$new_data=sprintf('d8:announce%d:%s4:info%se', strlen($announce_url), $announce_url, benc($decoded));
$new_size=strlen($new_data);

header('Content-Description: File Transfer');
header("Content-Type: application/x-bittorrent");
header('Content-Disposition: attachment; filename="[piratix]'.$torrent.'"');
header("Cache-Control: public, must-revalidate, max-age=0");
header("Pragma: public");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $new_size);

print($new_data);

?>

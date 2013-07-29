<?php
session_start();

require("include/settings.php");
require("include/config.php");
require("include/functions.php");

$base = mysql_connect ($serveurdb, $logindb, $passworddb);
mysql_select_db ($basedb, $base);

mysql_query('delete from cpt_connectes where pseudo="'.$_SESSION['login'].'"');
session_unset(); 
session_destroy();
header("Location:index.php");
exit();
?>

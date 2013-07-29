<?php

if(isset($_SESSION['login']))
{
        $dnns = mysql_fetch_array(mysql_query('SELECT COUNT(pseudo) AS nb FROM cpt_connectes WHERE pseudo="'.$_SESSION['login'].'"'));
        if($dnns['nb']>0)
        {
            mysql_query('UPDATE cpt_connectes SET timestamp="'.time().'" WHERE pseudo="'.$_SESSION['login'].'"');
        }
        else
        {
            mysql_query('INSERT INTO cpt_connectes (pseudo, timestamp) VALUES ("'.$_SESSION['login'].'", "'.time().'")');
        }
}

$times_m_3mins = time()-(60*3); // 3 minutes
mysql_query('DELETE FROM cpt_connectes WHERE timestamp < "'.$times_m_3mins.'"');

$dnns2 = mysql_query('SELECT pseudo FROM cpt_connectes');
$num = mysql_num_rows($dnns2);

if($dnns['nb']>0)
{
	if ($num < 2) {
	   echo '<span style="font-size: 8pt;">dont<br/>' . $num . '</strong> membre connect&eacute;';
	}

	else {
	   echo '<span style="font-size: 8pt;">dont<br/>' . $num . '</strong> membres connect&eacute;s';
	}

        echo ' :<br />';
        $i=0;
        while($dn2 = mysql_fetch_array($dnns2))
        {
           $i++;
           echo $dn2['pseudo'];
           if($i<$num)
           {
              echo ',';
           }
        }
}
echo '</span>';
?>

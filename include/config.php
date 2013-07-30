<?php

//Paramètres du site
    $SITENAME = "piratix.mumbly58.net";
    $SITEURL = "http://piratix.mumbly58.net";

    $LOGOSITEFT = "/images/logoFT.png";

    $PORTANNOUNCE = "9005";
    $ANNOUNCEURL = $SITEURL . ":" . $PORTANNOUNCE . "/announce";

    $MAILSITE="contact@piratix.mumbly58.net";
    $SITEVERSION="0.1.24-b";
    $SITEVERSIONDATE="30/07/13";

//Répertoires
    $CHEMINSITE="/var/www/piratix.mumbly58.net/web";
    $TORRENTSDIR="/torrents";
    $FORUMURL="/forum";

//Langue et charset
    $DEFAULTLANGUAGE="fr_FR";
    $DEFAULTCHARSET="utf-8";

//Styles
    $DEFAULTSTYLE="/css/style.css";

//Limites d'affichages
    $TORRENTLISTLIMIT="15";
    $NEWSLIMIT="2"; // les news (page index haut)
    $LASTFORUMLIMIT="10"; // les derniers posts du forum (bottom)
    $MOSTSEEDTORRLIMIT="5"; // les torrents les + seedés (bottom)
    $LASTCOMMENTLIMIT="3"; // les derniers commentaires (bottom)

// Disclaimer upload
    $DISCLAIMERUPLOAD="
<p style=\"text-align:justify;\">
Veuillez dans un premier temps lire <a href=\"apropos.php\">le règlement du site</a>.
</p>

<br />

<h4>Pour uploader les torrents, vous devez :</h4>
<p style=\"text-align:justify;\">
<ol>
    <li>Créez votre torrent avec l'adresse d'annonce du tracker (avec uTorrent, Transmission, etc.)</li>
    <li>Chargez le torrent sur le tracker grâce au formulaire ci-dessous.</li>
    <li>Une fois le formulaire validé, un lien vous sera donné afin de DOWNLOADER le torrent.</li>
    <li>Vous indiquerez à votre client bittorrent que vous voulez enregistrer le fichier dans l'emplacement où il se trouve concrètement sur votre ordinateur.</li>
    <li>Comme vous posséder déjà le fichier, votre client bittorrent se mettra automatiquement en SOURCE (seed).</li>
</ol>    
Vous devez procéder dans cet ordre sinon la verification par PID ne fonctionnera pas !<br />
Veuillez mettre une image avec votre torrent (cela aide à la présentation).
</p>

<br />

<h4>Choix de licence :</h4>
<p style=\"text-align:justify;\">
Veuillez stipuler une licence !
</p>

<br />

<h4>Responsabilités :</h4>
<p style=\"text-align: justfiy;\">
Vous êtes responsable du choix de la catégorie de la licence.<br />
Si vous uploadez un fichier dont les droits d'auteurs ne sont pas sous licence libre, OpenSource ou de Libre Diffusion, vous êtes sanctionnable au regard de la loi, le fichier sera immédiatement retiré du site !<br />
Si vous persistez dans ce comportement illégal, votre compte sera fermé !
</p>

<br />

<h4>RECOMMANDATION POUR LA CREATION DE VOS TORRENTS :</h4>
<b>Merci de ne pas mettre d'espace ni d'underscore ( _ ) dans le nom de vos torrents ou ceci entrainera une erreur et votre torrent sera injoignable.</b>
</p>
";

?>

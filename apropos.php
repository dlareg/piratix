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
	<?php
	   include_once("navigation.php");
	?>
<!-- /Navigation -->

	
<!-- Main -->
<div id="main">
	
	<!-- Content -->
	<div id="content">

	<div class="box last">
	<h2><span>A propos ...</span></h2>

<br /><br /><br />
<p style="text-align: justify;">
<h4>A propos et Présentation:</h4>
Piratix est un projet basé sur le partage et la promotion des logiciels libres et des contenus libres sous licence libre ET sous Licence Libre de Diffusion (LLD) (pour tout système : Microsoft Windows (&copy;), Gnu/Linux, Mac OS, xBSD, ...).<br />
Piratix propose de rassembler et de rendre ces médias disponibles par l'intermédiaire du réseau Peer to peer en utilisant le protocole Bittorrent et souhaite ainsi créer une dynamique communautaire culturelle libre, pour tous, par tous.<br />
<br />
Piratix entend devenir un espace culturel communautaire pour tous et par tous.<br />
Piratix propose un vaste catalogue en ligne de médias sous licences libres, classés, commentés et régulièrement mis à jour : tutoriels, livres, films, vidéo, revues techniques, supports littéraires (poésie, théâtre, roman, etc.) mais aussi des espaces de discussions, des infos et des articles de fond.<br />
Piratix entend contribuer au développement culturel de ses visiteurs par l'information et le libre échange afin de témoigner de la diversité du monde du Libre et de son dynamisme.<br />
Piratix est soutenu par une équipe de bénévoles et propose à ses visiteurs de devenir ponctuellement ou régulièrement acteurs du site.<br />
<br />
<h4>Conditions d'Utilisation :</h4>
Piratix propose des médias sous licences libres ou licences libres de diffusion EXCLUSIVEMENT.<br />
Tout autre matériel sous une quelconque licence restrictive, commerciale ou propriétaire n'est pas admis sur Piratix.<br />
Tout média "cracké" ou "piraté" (warez, etc.) est strictement interdit sur Piratix et sera irrémédiablement et immédiatement effacé.<br />
Le compte de l'utilisateur responsable de l'upload de torrents interdits sera immédiatement détruit et son adresse IP transmise aux ayant-droits.<br />
<br />
Pour tout upload de torrent vous devrez indiquer la licence d'utilisation.
<br /><br />

<h5>Download / Upload (Proposer des fichiers)</h5>
Pour uploader (proposer) des torrents ou downloader (télécharger), le visiteur devra devenir membre en créant un compte.<br />
<br />
Piratix se réserve le droit de supprimer ou de modifier tout fichier envoyé et mis en partage sur son serveur et ne pourra être tenu responsable des écrits, prises de positions, convictions ou partis-pris exposés ou suggérés dans les fichiers proposés au téléchargement.
<br />
Piratix n'est ainsi pas responsable des fichiers proposés par ses membres.
<br />
Piratix s'engage néanmoins à faire tout ce qui est en son pouvoir pour lutter contre la diffusion de fichiers illégaux et/ou immoraux. Dans les cas les plus graves d'atteinte à la personne humaine notamment, Piratix jouera pleinement son rôle citoyen et responsable en avertissant les autorités compétentes.
<br />
En tant qu'utilisateur et/ou membre de Piratix, vous vous engagez à respecter la loi en général, et la loi sur les droits d'auteur en particulier.
<br />Vous pourrez, à tout moment, avertir les administrateurs de Piratix de la présence de fichiers suspects ou illégaux sur le site en faisant un simple signalement.
<br />Ainsi, Piratix n'incite pas à la délation péjorative mais souhaite de manière communautaire participer à la promotion du "Libre" et se protéger au niveau de la loi.
<br /><br />
Piratix n'accepte pas les fichiers :
<ul>
<li>proposant ou incitant à la propagande politique ou religieuse, sous toutes ses formes. Dans ce domaine, Piratix se réserve le droit de supprimer sans préavis des fichiers et médias jugés "extrêmistes" et/ou incompatibles avec la finalité et les buts de Piratix</li>
<li>en désaccord avec les lois du pays d'origine de l'utilisateur et la législation française en matière du droit de propriété intellectuelle</li>
<li>disposant d'une licence commerciale et/ou propriétaire</li>
<li>portant atteinte à l'ordre public, aux bonnes moeurs ou pouvant heurter la sensibilité des personnes (pornographie, pédophilie, ...)</li>
<li>contenant des propos ou des documents diffamatoires ou injurieux envers une quelconque personne physique ou morale</li>
<li>incitant à la haine raciale, à la violence et/ou reprenant une idéologie contraire aux Droits de l'Homme et du Citoyen</li>
<li>incitant à la discrimination ethnique, religieuse ou sexuelle</li>
<li>incitant au crime, au délit</li>
</ul>

Les contrevenants s'exposent :
<ul>
<li>à des poursuites judiciaires,</li>
<li>à la suppression sans préavis des fichiers incriminés,</li>
<li>à une impossibilité d'accès au site web de Piratix ainsi qu'aux services qu'il propose.</li>
</ul>
<br />
En tant qu'utilisateur ou membre inscrit, la "personne" accepte les conditions générales d'utilisation.
<br /><br />

<h4>Informatique et libertés</h4>
Informations personnelles collectées<br />
En France, les données personnelles sont notamment protégées par la loi n 78-87 du 6 janvier 1978, la loi n 2004-801 du 6 août 2004, l'article L. 226-13 du Code pénal et la Directive Européenne du 24 octobre 1995.<br />
En tout état de cause, Piratix ne collecte des informations personnelles relatives à l'utilisateur (nom, adresse électronique, coordonnées ....) que pour le besoin des services proposés par le site web de Piratix, notamment pour l'inscription à des événements par le biais de formulaires en ligne. L'utilisateur fournit ces informations en toute connaissance de cause, notamment lorsqu'il procède par lui-même à leur saisie. Il est alors précisé à l'utilisateur le caractère obligatoire ou non des informations qu'il serait amené à fournir.<br />
Aucune information personnelle de l'utilisateur du site de Piratix n'est collectée à l'insu de l'utilisateur, publiée à l'insu de l'utilisateur, échangée, transférée, cédée ou vendue sur un support quelconque à des tiers.
<br /><br />

<h4>Rectification des informations nominatives collectées</h4>
Conformément aux dispositions de l'article 34 de la loi n 48-87 du 6 janvier 1978, l'utilisateur dispose d'un droit de modification des données nominatives collectées le concernant.<br />
Pour ce faire, l'utilisateur envoie à Piratix un courrier électronique en utilisant le formulaire de contact en indiquant son nom ou sa raison sociale, ses coordonnées physiques et/ou électroniques, ainsi que le cas échéant la référence dont il disposerait en tant qu'utilisateur du site de Piratix. La modification interviendra dans des délais raisonnables à compter de la réception de la demande de l'utilisateur.<br />
<br />

<h4>Limitation de responsabilité</h4>
Piratix peut comporter des informations mises à disposition par des sociétés externes ou des liens hypertextes vers d'autres sites qui n'ont pas été développés par Piratix. Le contenu mis à disposition sur le site est fourni à titre informatif. L'existence d'un lien de ce site vers un autre site ne constitue pas une validation de ce site ou de son contenu. Il appartient à l'internaute d'utiliser ces informations avec discernement et esprit critique. La responsabilité de Piratix ne saurait être engagée du fait des informations, opinions et recommandations formulées par des tiers. 
<br /><br />
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

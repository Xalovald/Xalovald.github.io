<html>
<head>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
<meta charset="utf-8">
</head>
<body class="body">
<img style="float:right" src="img/logo_GHT.PNG"></img> <!-- Logo du GHT (200px * 80px) -->
<img style="float:left" src="img/Logo_change.PNG"></img> <!-- Logo du change (200px * 200px) -->
<!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px
	 première page à sur laquelle les utilisateur vont arriver quand ils vont vouloir remplir le questionnaire -->
<?php //début du PHP / fin du html
date_default_timezone_set("Europe/Paris");
require 'Connect.php';

$faultLogiciel = $bdd->query('SELECT * FROM fault WHERE `type` = "Logiciel"');
$faultMateriel = $bdd->query('SELECT * FROM fault WHERE `type` = "Materiel"');
if(isset($_GET['id_rep'])){ //Interviens lorsque l'on recommence le questionnaire
	$id_rep = $_GET['id_rep'];
}
if(isset($_GET['confirm'])){ //vérifie si confirm est présent dans l'URL
	$date = date('Y-m-d H:i:s');
	$nom_pc = gethostname();
	$version_pc = php_uname("v");
		$bdd->query("INSERT INTO id_repertoire(`id_rep`) VALUES('".$id_rep."')");
		$bdd->query("INSERT INTO info(`date`,`nom_pc`,`version_pc`,`path`) VALUES('".$date."','".$nom_pc."','".$version_pc."','".$id_rep."')");
}
?> <!-- fin du php/ début du html -->
<h1 class="centre red">Avant toutes opérations veuillez <span class='text-degrade'>redémarrer l'ordinateur</span></br>
Si vous avez fermé la fenêtre avec les écritures <strong>vertes</strong> dedans (script), redémarrez l'ordinateur</h1>
<div style="margin-top:150px">

	<?php //début du PHP / fin du html
	$id_q_suiv = 0;//Variable d'initialisation pour savoir si la question affiché est la dernière ou pas
	echo "<p class='text'>Problèmes liés aux logiciels</p>";
	while($resultatfault = $faultLogiciel->fetch()){
	//Cette boucle affiche les boutons suivant la table ou il doit aller les chercher
	?> <!-- fin du php/ début du html -->
		<a href="<?php echo "Question_FT.php?libelle=".$resultatfault['Libelle']."&id=".$resultatfault['id']."&id_q_suiv=".$id_q_suiv."&id_rep=".$resultatfault['id']."s"; ?>" class="button button1"><?php echo $resultatfault['Libelle']; ?></a></br>
	<?php //début du PHP / fin du html
	//Cette requête affiche des boutons pour chaque énoncé dans la table fault et renvoie dans l'url des informations contenu dans
	//resultatfault (libelle, id)
	}
	echo "<p class='text'>Problèmes liés aux materiels</p>";
	while($resultatfault = $faultMateriel->fetch()){
		//Cette boucle affiche les boutons suivant la table ou il doit aller les chercher
		?> <!-- fin du php/ début du html -->
			<a href="<?php echo "Question_FT.php?libelle=".$resultatfault['Libelle']."&id=".$resultatfault['id']."&id_q_suiv=".$id_q_suiv."&id_rep=".$resultatfault['id']."s"; ?>" class="button button1"><?php echo $resultatfault['Libelle']; ?></a></br>
		<?php //début du PHP / fin du html
		//Cette requête affiche des boutons pour chaque énoncé dans la table fault et renvoie dans l'url des informations contenu dans
		//resultatfault (libelle, id)
		}
	?> <!-- fin du php/ début du html -->
</div>
</body>
</html>

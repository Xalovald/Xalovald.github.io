<html>
<head>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
<meta charset="utf-8">
</head>
<body class="body">
	<img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
  <!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px -->
<?php //début du php / fin du html
require 'Connect.php';

$id_rep = $_GET['id_rep'];

?> <!-- fin du php/ début du html -->
	<div class="centre">
<a href="" class="button button3 centre"><?php echo $_GET['libelle'];  ?></a></br>
</div>
<div style="margin-top:180px">
<?php //début du php / fin du html
//Cette requête récupère le libelle de la question précédente
if($_GET['id_q_suiv'] != 0)
{
	$questions_suivante = $bdd->query("SELECT * FROM questions
WHERE id_q =".$_GET['id_q_suiv']);
if($_GET['id_fin'] == 1){
//Instruction qui permet de récupérer id_fin qui indique si on sort de la boucle ou pas
//(0 on reste dans la boucle; 1 on sort de la boucle en exécutant la methode exit())
?> <!-- fin du php/ début du html -->

	<a <?php echo "href=Interface_utilisateur_FT.php?id_rep=".$id_rep."&confirm=1"; ?>  class="button button1">Votre problème est résolu</a></br>
	<a <?php echo "href='formulaire_mail.php?path=".$id_rep."'"; ?> class="button button1">Votre problème n'est pas résolu</a></br>
	<div class="centre">
		<a href="Interface_utilisateur_FT.php" class="button button2">Retourner au début ?</a></br>
	</div>
	<div class="centre">
		<form>
			<input type = "button" value = "Vous vous êtes trompé ?"  onclick = "history.back()" class="button button2">
		</form>
	</div>
<?php //début du php / fin du html
	exit();
  }
	while($resultatquest = $questions_suivante->fetch())
	{
?> <!-- fin du php/ début du html -->
		<a href="<?php echo "Reponse_FT.php?libelle=".$resultatquest['Libelle']."&id_pb=".$resultatquest['id_pb']."&id_q=".$resultatquest['id_q']."&id_rep=".$id_rep."".$resultatquest['id_q']."s&confirm=1" ?>" class="button button1"><?php echo $resultatquest['Libelle']; ?></a></br>
<?php //début du php / fin du html
	}
	?> <!-- fin du php/ début du html -->
	<div class="centre">
		<form>
			<input type = "button" value = "Vous vous êtes trompé ?"  onclick = "history.back()" class="button button2">
		</form>
	</div>
	<?php //début du php / fin du html
}
else{
	$questions = $bdd->query("SELECT * FROM questions
		WHERE id_pb =".$_GET['id']);
	while($resultatquest = $questions->fetch())
//Cette boucle affiche les boutons suivant la table ou il va les chercher, ici il s'agit de la table questions
	{
?> <!-- fin du php/ début du html -->
	<a href="<?php echo "Reponse_FT.php?libelle=".$resultatquest['Libelle']."&id_pb=".$resultatquest['id_pb']."&id_q=".$resultatquest['id_q']."&id_rep=".$id_rep."".$resultatquest['id_q']."s" ?>" class="button button1"><?php echo $resultatquest['Libelle']; ?></a></br>
<?php //début du php / fin du html
	}
?> <!-- fin du php/ début du html -->
<div class="centre">
	<form>
		<input type = "button" value = "Vous vous êtes trompé ?"  onclick = "history.back()" class="button button2">
		<!-- Cette requête sert à faire apparaître un bouton qui servira à retourner en arrière d'une instruction -->
	</form>
</div>
<?php //début du php / fin du html
}
?> <!-- fin du php/ début du html -->
</div>
</body>
</html>

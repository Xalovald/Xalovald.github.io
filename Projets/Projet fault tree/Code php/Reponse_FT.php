<html>
<head>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
<meta charset="utf-8">
</head>
<body class="body">
	<div class="col-md-12">
		<img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
	  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
	  <!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px -->
</div>
<?php //début du php / fin du html

require 'Connect.php';

$fault = $bdd->query('SELECT * FROM fault'); //selection de la table fault

$id_rep = $_GET['id_rep'];

$questions = $bdd->query("SELECT * FROM questions
INNER JOIN fault ON questions.id_pb = fault.id
WHERE fault.id = questions.id_pb;");

$reponses=$bdd->query("SELECT * FROM reponses
WHERE id_q=".$_GET['id_q']);
//cette requête sql affiche les réponse qui ont un id_q identique à celui renvoyé par la methode $_GET

$questions_suivante=$bdd->query("SELECT * FROM reponses
INNER JOIN questions ON reponses.id_q_suiv = questions.id_q
WHERE reponses.id_q_suiv = questions.id_q");
?> <!-- fin du php/ début du html -->
<div class="centre">
<a href="" class="button button3 centre"><?php echo $_GET['libelle']; ?></a></br>
</div>
<div style="margin-top:180px">
<?php //début du php / fin du html

//Cette requête récupère le libelle de la question précédente
while($resultatrep = $reponses->fetch())
{
if($resultatrep['id_fin'] != 1)
{
?> <!-- fin du php/ début du html -->
	<a href="<?php echo "Question_FT.php?id_q_suiv=".$resultatrep['id_q_suiv']."&libelle=".$resultatrep['libelle']."&id_fin=".$resultatrep['id_fin']."&id_rep=".$id_rep."".$resultatrep['id_r']."s"; ?>" class="button button1"><?php echo $resultatrep['libelle']; ?></a></br>
<?php //début du php / fin du html
}
else{
?> <!-- fin du php/ début du html -->
	<a href="<?php echo "Question_FT.php?id_q_suiv=".$resultatrep['id_q_suiv']."&libelle=".$resultatrep['libelle']."&id_fin=".$resultatrep['id_fin']."&id_rep=".$id_rep."".$resultatrep['id_r']."s&confirm=1"; ?>" class="button button1"><?php echo $resultatrep['libelle']; ?></a></br>
	<!--ça fonctionne est ici ou fin de boucle-->

<?php //début du php / fin du html
}
//cette requête affiche des boutons en fonction de l'id_q qu'elle reçoit dans la page précédente
}
?> <!-- fin du php/ début du html -->
<div class="centre">
	<form>
		<input type = "button" value = "Vous vous êtes trompé ?"  onclick = "history.back()" class="button button2">
	</form>
</div>
</div
</body>
<html>

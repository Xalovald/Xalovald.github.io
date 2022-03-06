<html>
<head>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> <!-- cette ligne sert pour avoir une belle mise en page -->
<meta charset="utf-8">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
</head>
<body>
<div class="col-md-12">
  <img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
  <!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px -->
</div>
<div>
<?php
//Page pour gérer les modifications des champs de la table questions
$idPb_actuel= $_GET['idPb_actuel'];
$libelle_actuel= str_replace("'","&#39;",$_GET['libelle_actuel']);


echo "<form action='update.php?questions_id=".$_GET['questions_id']."' method='POST'>";
echo "<input type='int' value='".$idPb_actuel."' name='questions_id_pb' placeholder='id_pb'></input></br>";
echo "<input type='text' value='".str_replace("'","&#39;",$libelle_actuel)."' name='questions_libelle' placeholder='Libelle'></input></br>";
echo "<input type='submit'></input>";
echo "</form>";
?>
<input type = "button" value = "Vous vous êtes trompé ?"  onclick = "history.back()" class="button button2">
</div>
</body>
</html>

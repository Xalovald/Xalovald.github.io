<html>
<head>
<link rel="stylesheet" href="./css/style.css" type="text/css">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Ne pas mettre à jour pour que ça marche bien, liaison avec jquery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> <!-- Ne pas mettre à jour pour que ça marche bien, liaison bootstrap avec javascript -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> <!-- cette ligne sert pour avoir une belle mise en page -->
</head>
<body class="pro">

  <!-- Cette page sert à afficher la page à laquelle auront accès les professionels pour qu'ils puissent :
  ajouter des problèmes ainsi que les questions et réponses qui vont avec, voir les chemins de clique
  qu'on suivi les utilisateur qui ont réussi à se débrouiller tout seul, dans le cas où ils n'aurait
  pas reussi à résoudre le problème sul, un mail s'envoie automatiquement -->
  <div class="col-md-12">
  <img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
  <!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px -->
</div>
<div>
  <br>
<h3 class="center">Champs pour modifier les informations dans la base de données</h3>
<?php //début du PHP / fin du html
$parts = [];
$audessus = "'Sources/modifier2.png'";
$audessous = "'Sources/modifier.png'";
require 'Connect.php';

echo "<form action='pushFault.php' method='POST'>";
echo "Table fault : ";
echo "<input type='text' name='fault_lbl' placeholder='Libelle'></input>";
echo "<input type='int' name='fault_debut' placeholder='debut'></input>";
echo "<select name='type'>
        <option>Materiel</option>
        <option>Logiciel</option>
</select>";
echo "<input type='submit'></input>";
echo "</form>";

//Crée plusieurs champ à partir d'où, il est possible de remplir les différents champ de la table concernée. Ces changements
//apparaissent dans le tableau ci-dessous juste après changement ou bien faite f5 pour ectualiser la page.
$requete = "SELECT * FROM fault";
$result = $bdd->query($requete);
?> <!-- fin du php/ début du html -->
<table class='table table-bordered'>
  <thead>
    <th>Id</th>
    <th>Libelle</th>
    <th>Début</th>
    <th>Type</th>
	<th> </th>
  </thead>
  <tbody>
<?php //début du PHP / fin du html
while ($ligne = $result -> fetch())
{
  ?> <!-- fin du php/ début du html -->
    <thead>
      <td> <?php echo $ligne['id'] ?></td>
      <td> <?php echo $ligne['Libelle'] ?></td>
      <td> <?php echo $ligne['debut'] ?></td>
      <td> <?php echo $ligne['type'] ?></td>
	  <?php echo "<td><a href='#' onclick='confirmation2(".$ligne['id'].")'><span class='glyphicon glyphicon-trash'></span></a></td>"; ?>
    <?php echo "<td align='center'><a href='update_fault.php?fault_id=".$ligne['id']."&libelle_actuel=".str_replace("'","%27",$ligne['Libelle'])."&debut_actuel=".$ligne['debut']."&type=".$ligne['type']."'><img src='Sources/modifier.png' onmouseover='this.src=".$audessus."' onmouseout='this.src=".$audessous."'></td>\n"; ?>
<!-- création de tableau prenant pour chaque cellule, les valeurs des champs saisit pour chaque lignes-->
	<?php //début du PHP / fin du html
}
	?> <!-- fin du php/ début du html -->
	</tbody>
  </table>
<?php //début du PHP / fin du html

/* Pour fair un nouveau tableau comme ci-dessus il faut :  changer confirmation ici et dans le javascript;
remettre un elseif dans delete_table, celui-ci portera les informations de la table que l'on veut faire;
changer le champ entre crochet pour avoir la clé primaire ou l'INDEX*/
echo "<form action='pushQuestions.php' method='POST'>";
echo "Table questions : ";
echo "<input type='int' name='questions_idPb' placeholder='id_pb'></input>";
echo "<input type='text' name='questions_lbl' placeholder='Libelle'></input>";
echo "<input type='submit'></input>";
echo "</form>";

//Crée plusieurs champ à partir d'où, il est possible de remplir les différents champ de la table concernée. Ces changements
//apparaissent dans le tableau ci-dessous juste après changement ou bien faite f5 pour ectualiser la page.
$requete = "SELECT * FROM questions";
$result = $bdd->query($requete);
?> <!-- fin du php/ début du html -->
<table class='table table-bordered'>
  <thead>
    <th>Id_q</th>
    <th>Id_pb</th>
    <th>Libelle</th>
	<th> </th>
  </thead>
  <tbody>
<?php //début du PHP / fin du html
while ($ligne = $result -> fetch())
{
  ?> <!-- fin du php/ début du html -->
  <tr>
    <td> <?php echo $ligne['id_q'] ?></td>
    <td> <?php echo $ligne['id_pb'] ?></td>
    <td> <?php echo $ligne['Libelle'] ?></td>
    <?php echo "<td><a href='#' onclick='confirmation3(".$ligne['id_q'].")'><span class='glyphicon glyphicon-trash'></span></a></td>"; ?>
    <?php echo "<td align='center'><a href='update_questions.php?questions_id=".$ligne['id_q']."&libelle_actuel=".str_replace("'","%27",$ligne['Libelle'])."&idPb_actuel=".$ligne['id_pb']."'><img src='Sources/modifier.png' onmouseover='this.src=".$audessus."' onmouseout='this.src=".$audessous."'></td>\n"; ?>
<!-- création de tableau prenant pour chaque cellule, les valeurs des champs saisit pour chaque lignes-->
  <?php //début du PHP / fin du html
  }
  ?> <!-- fin du php/ début du html -->
  </tbody>
  </table>
<?php //début du PHP / fin du html

echo "<form action='pushReponses.php' method='POST'>";
echo "Table reponses : ";
echo "<input type='int' name='reponses_idQ' placeholder='id_q'></input>";
echo "<input type='int' name='reponses_idQSuiv' placeholder='id_q_suiv'></input>";
echo "<input type='int' name='reponses_idFin' placeholder='id_fin'></input>"; //0 ou 1, voir la doc
echo "<input type='text' name='reponses_lbl' placeholder='libelle'></input>";
echo "<input type='submit'></input>";
echo "</form>";

//Crée plusieurs champ à partir d'où, il est possible de remplir les différents champ de la table concernée. Ces changements
//apparaissent dans le tableau ci-dessous juste après changement ou bien faite f5 pour ectualiser la page.
$requete = "SELECT * FROM reponses";
$result = $bdd->query($requete);
?> <!-- fin du php/ début du html -->
<table class='table table-bordered'>
  <thead>
    <th>Id_r</th>
    <th>Id_q</th>
    <th>Id_q_suiv</th>
    <th>Id_fin</th>
    <th>Libelle</th>
	<th> </th>
  </thead>
  <tbody>
<?php //début du PHP / fin du html
while ($ligne = $result -> fetch())
{
  ?> <!-- fin du php/ début du html -->
  <tr>
    <td> <?php echo  $ligne['id_r'] ?></td>
    <td> <?php echo  $ligne['id_q'] ?></td>
    <td> <?php echo  $ligne['id_q_suiv'] ?></td>
    <td> <?php echo $ligne['id_fin'] ?></td>
    <td> <?php echo $ligne['libelle'] ?></td>
    <?php echo "<td><a href='#' onclick='confirmation4(".$ligne['id_r'].")'><span class='glyphicon glyphicon-trash'></span></a></td>"; ?>
    <?php echo "<td align='center'><a href='update_reponses.php?reponses_id=".$ligne['id_r']."&idQ_actuel=".$ligne['id_q']."&idQSuiv_actuel=".$ligne['id_q_suiv']."&idFin_actuel=".$ligne['id_fin']."&libelle_actuel=".str_replace("'","%27",$ligne['libelle'])."'><img src='Sources/modifier.png' onmouseover='this.src=".$audessus."' onmouseout='this.src=".$audessous."'></td>\n"; ?>
    <!-- création de tableau prenant pour chaque cellule, les valeurs des champs saisit pour chaque lignes-->
  <?php //début du PHP / fin du html
}
?> <!-- fin du php/ début du html -->
</tbody>
</table>


<hr class="divider">
<h3 class="center">Tableau des erreurs utilisateur</h3>
<p class="warning"> &#9888;&#65039; bien faire attention à ce que les id de info et id_repertoire soit égaux &#9888;&#65039;</p>
</br>
<?php //début du PHP / fin du html

$id_rep = $bdd->query("SELECT * FROM id_repertoire");

/* Cette boucle sert à aller chercher tous les id des tables reponses et questions osur lesquelles
l'utilisateur à cliquer par le biais des boutons */
echo "<table class='table table-light'>";
echo "<thead class='thead-light'>";
echo "</thead>";
echo "<tbody>";
while($row = $id_rep->fetch()){
  $tok = strtok($row['id_rep'], "s");
  while($tok!==false){
  $parts[] = $tok;
  $tok = strtok("s");
  }
	echo "<tr>";
	$compteur = 0;
	$table = 'fault';
	$id = 'id';
  $prefixe = "Problème: ";
	$libelle = 'Libelle';
	for($i=0;$i<count($parts); $i++){
		if($compteur == 1){
			$table = 'questions';
      $prefixe = "Question: ";
			$id = 'id_q';
			$libelle = 'Libelle';
		}
		elseif($compteur == 2){
			$compteur = 0;
      $prefixe = "Réponse: ";
			$table = 'reponses';
			$id = 'id_r';
			$libelle = 'libelle';
		}
		$str = $parts[$i];
		$libelle_str = $bdd->query('SELECT * FROM '.$table.' WHERE '.$id.'='.$str);
		$lbl = $libelle_str->fetch();
		echo "<td>".$prefixe. "".$lbl[$libelle]."</td>";
		$compteur++;
    }
    $parts= [];
    $tok= "";

	$sql = $bdd->query('SELECT * FROM info WHERE `path` ="'.$row['id_rep'].'"');
	$row2 = $sql->fetch();

  $sql2 = $bdd->query('SELECT * FROM id_repertoire WHERE `id`='.$row['id']);
  $row3 = $sql2->fetch();

  $sqlinfo = $bdd->query('SELECT * FROM info WHERE `id`='.$row['id']);
  $rowinfo = $sqlinfo -> fetch();
//selectionne toutes les lignes de info dont l'id est diférrent et les affiche dans le Tableau
	echo "<td>Date d'ajout: ".$rowinfo['date']."</td>";
	echo "<td>Nom du pc utilisateur: ".$rowinfo['nom_pc']."</td>";
	echo "<td>Version du pc utilisateur: ".$rowinfo['version_pc']."</td>";
  echo "<td><a href='#' onclick='confirmation(".$row3['id'].",".$row2['id'].")'><span class='glyphicon glyphicon-trash'></span></a></td>";
//premet de supprimer les lignes du tableau mais aussi de retirer les données des tables id_repertoire et info
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?> <!-- fin du php/ début du html -->
<!-- javascript -->
</div>
<script type="text/javascript" defer>
function confirmation(id_rep,id_info){
	if (confirm('Êtes vous sûre de vouloir supprimer cette entrée?')){
		window.location="delete_table.php?id_rep="+id_rep+"&id_info="+id_info;
	}
}
function confirmation2(id_fault){
	if (confirm('Êtes vous sûre de vouloir supprimer cette entrée?')){
		window.location="delete_table.php?id_fault="+id_fault;
	}
}
function confirmation3(id_questions){
	if (confirm('Êtes vous sûre de vouloir supprimer cette entrée?')){
		window.location="delete_table.php?id_questions="+id_questions;
	}
}
function confirmation4(id_reponses){
	if (confirm('Êtes vous sûre de vouloir supprimer cette entrée?')){
		window.location="delete_table.php?id_reponses="+id_reponses;
	}
}
</script>
</body>
</html>

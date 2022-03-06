<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/style.css" type="text/css">
<title>Auto-depan.info</title> <!-- Titre qui s'affiche dans l'onglet de la nouvelle page -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> <!-- Ne pas mettre à jour pour que ça marche bien, liaison bootstrap avec javascript -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> <!-- cette ligne sert pour avoir une belle mise en page -->
</head>
<body class="body">
	<img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
  <!--les logo sont interchangeables tant que leurs dimensions sont inférieur ou égale à 200px * 200px -->
<?php
/* Ce formulaire sert à mettre en forme un mail qui sera envoyer par mail après que les champs soit rempliee */
require 'Connect.php'; //ligne pour se connecter à la base de données MySQL

date_default_timezone_set("Europe/Paris");

$parts = [];
$i=0;
	if (isset($_GET['path'])) {
$path = $_GET['path'];}//initialisation de la boucle en recupérant path
	else
	{$path='1';}
$verif = false;
$tok = strtok($path, "s");
while($tok!==false){
  $parts[] = $tok;
  $tok = strtok("s");
}

//Boucle qui récupère les différents id et les associent à leur tables réspéctive pour effectuer un envoie des
//variables via le formulaire
//Cette boucle à aussi pour but de ranger les valeurs dans différents tableau, un pour la table fault, un pour la table reponses et un pour la table questions.
while($i<count($parts)){
  $chiffre = $parts[$i];
  //Table fault
  if($i == 0)
  {
    $verif = false;
    $table = 'fault';
    $id = 'id';
  }
	//Table reponses
  elseif($i%2 == 0)
  {
    $verif = true;
    $table = 'reponses';
    $id = 'id_r';
  }
  //Table questions
  else
  {
    $verif = false;
	  $table = 'questions';
	  $id = 'id_q';
  }
	$sql = $bdd->query('SELECT * FROM '.$table.' WHERE '.$id.'='.$chiffre);
	${"row".$i} = $sql->fetch();
  if($verif == true){
    ${'array'.$table}[]=${"row".$i}['libelle'];
  }
  else{
    ${'array'.$table}[]=${"row".$i}['Libelle'];
  }
  $i++;
}

$lbl0 = $row0['Libelle'];//contient le libelle unique de fault

$date = date('Y-m-d H:i:s'); //Contient la date du jour ou le formulaire à été envoyé
$nom_pc = gethostname(); //Contient le nom du pc depuis lequel le formulaire à été envoyé
$version_pc = php_uname("v"); //Contient la version du pc depuis lequel le formulaire à été envoyé
$serializeReponses = implode(",",$arrayreponses); //On transforme le tableau de valeur arrayreponses en chaine de caractère (string)
$serializeQuestions = implode(",",$arrayquestions); //On transforme le tableau de valeur arrayQuestions en chaine de caractère (string)
//form pour envoyer le nom, le prénom et l'adresse mail et la capture d'écran devant contenir la panne
//de l'utilisateur la rencontrant
?>

<div class='voile'>
<FORM method="POST" action="envoie.php?path=<?php echo $path;?>" enctype='multipart/form-data'>
<h1 class="centre">Création de ticket pour la DSI</h1>
<div style="margin-top:150px">
<?php
echo "<input type='hidden' name='lblFault' value='".$lbl0."'></input></br>";
echo "<input type='hidden' name='serializeQuestions' value='".$serializeQuestions."'></input></br>";
echo "<input type='hidden' name='serializeReponses' value='".$serializeReponses."'></input></br>";
echo "<input type='hidden' name='Date' value='".$date."'></input></br>";
echo "<input type='hidden' name='nom_pc' value='".$nom_pc."'></input></br>";
echo "<input type='hidden' name='version_pc' value='".$version_pc."'></input></br>";


echo "<input type='text' placeholder='Nom' name='txtNom' required='required'> <strong>Entrer le nom de l'utilisateur actuel du poste</strong></input></br>";
echo "<input type='text' placeholder='Pr&eacute;nom' name='txtPrenom' required='required'> <strong>Entrer le prénom de l'utilisateur actuel du poste</strong></input></br>";
echo "<input type='text' placeholder='Adresse_mail' name='txtmail' required='required'> <strong>Entrez votre adresse mail du change dans cette zone de texte</strong></input></br>";
echo "</br>";
echo "<p class='commentaire'>Prenez une <strong>capture d'écran</strong> (utiliser l'<strong>outil capture d'écran</strong>) et <strong>cliquez sur le bouton pour l'ajouter</strong></br>
Envoyer le formulaire par mail puis appeler le 63 60 60</p>";

?>
<!-- le champs ci dessous déclare un bouton ou les utilisateur pourront insérer la capture d'écran de leur problème -->
  <input name="image" type="file" >
  <input type="submit" value="Envoyer">
</form>
</div>
</div>
</body>
</html>

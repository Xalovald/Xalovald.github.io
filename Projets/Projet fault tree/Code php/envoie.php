<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/style.css" type="text/css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> <!-- Ne pas mettre à jour pour que ça marche bien, liaison bootstrap avec javascript -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> <!-- cette ligne sert pour avoir une belle mise en page -->
</head>
<body>
  <img style="float:right" src="img/logo_GHT.PNG"></img> <!--Logo du GHT (200px * 80px) -->
  <img style="float:left" src="img/Logo_change.PNG"></img> <!--Logo du change (200px * 200px) -->
  <!--les logo sont interchangeables tant qu'il sont dans la div et que leurs dimensions sont inférieur ou égale à 200px * 200px -->
<?php $boundary = md5(uniqid(microtime(), TRUE)); ?>
<form method="post" enctype="multipart/mixed;boundary=".$boundary."\r\n">
<?php
//cette page effectue l'envoir de formulaire_mail.php en ajoutant la pièce jointe
require 'Connect.php'; //ligne pour se connecter à la base de données MySQL
require 'logs.php';
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur

$txtNom = $_POST['txtNom'];
$txtPrenom = $_POST['txtPrenom'];
$txtmail = $_POST['txtmail'];
$txtNomPc = $_POST['txtNomPc'];
$lblFault = $_POST["lblFault"];
$arrayQuestions = explode(",",$_POST['serializeQuestions']);//On retransforme serializeQuestions en tableau de valeur
$arrayReponses = explode(",",$_POST['serializeReponses']);//On retransforme serializeReponses en tableau de valeur

$date = $_POST["Date"];
$nom_pc = $_POST["nom_pc"];
$version_pc = $_POST["version_pc"];

if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
  echo "<p class='red'>fichier non reçu</p>";
  // Testons si le fichier n'est pas trop gros
  if ($_FILES['image']['size'])
  {
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png','PNG');
	  $fichier_dest="toto".time();

    // On peut valider le fichier et le stocker définitivement
    $error = move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'. $fichier_dest . '.' . $extension_upload);
    echo "<br>résultat upload :" . $error."*<br>";
    // Switch servant simplement à la gestion des erreures
    switch($error){
      case 0:
      echo("<p class'red'>Fichier correctement envoyé.</p>");
      break;
      case 1:
      echo("<p class='red'>Format de fichier incorrect.</p>");
      break;
      case 2:
      echo("<p class='red'>Fichier trop volumineux.</p>");
      break;
      case 3:
      echo("<p class='red'>Fichier déjà existant.</p>");
      break;
    }
    echo $error;
  }
}
else
{echo "pas de variable image récupéré";}
//Affichage des variables
//L'affichage commence cette fois à partir de : [1]
$msg .= "Nom= $txtNom\n";
$msg .= "Prenom= $txtPrenom\n";
$msg .= "E-Mail: $txtmail\n";
$msg .= "Description= Problème: "."$lblFault\n";
$msg .= "Questions: -> Reponses:\n";
$compteur = 1; //Initialisation d'un compteur à 1 pour numéroter les questions, Reponses
for($i=0;$i<count($arrayQuestions) && count($arrayReponses);$i++){
    $msg .= $compteur.'. '.$arrayQuestions[$i].' -> '.$arrayReponses[$i]."\n";
    $msg .= "\n";
    $compteur++;
}
$msg .= "Date: $date\n"; //Affiche la date de l'envoie du mail
$msg .= "Nom de l'ordinateur: $nom_pc\n"; //Affiche le nmo de l'ordinateur qui envoie le mail
$msg .= "Version du système d'exploitation: $version_pc\n"; //Affiche la version du système d'exploitation de l'ordinateur qui envoie le mail
if(isset($fichier_dest)) //Verification de la présence d'une image dans le mail
{
$file_to_send = 'uploads/'.$fichier_dest . '.' . $extension_upload;

  if (file_exists($file_to_send))
  {
    $handle = fopen($file_to_send, 'r') or die('File '.$file_to_send.'can t be open');
	  $file_type = filetype($file_to_send);
	  $file_size = filesize($file_to_send);


	  $content = fread($handle, $file_size);
	  $content = chunk_split(base64_encode($content));
	  $f = fclose($handle);

	  $msg .= '--'.$boundary."\r\n";
	  $msg .= 'Content-type:'.$file_type.';name='.$file_to_send."\r\n";
	  $msg .= 'Content-transfer-encoding:base64'."\r\n";
	  $msg .= $content."\r\n";
  }
}
$msg .= '--'.$boundary."\r\n";
//Pourait continuer ainsi jusqu'à la fin du formulaire

mail($destinataire, $subject, $msg, $headers);//envoie du mail
header("location:Interface_utilisateur_FT.php?id_rep=".$_GET['path']."&confirm=1"); //retour sur la page interface utilisateur pour l'enrengistrement des variables dans interface pro
?>
</form>
</body>
</html>

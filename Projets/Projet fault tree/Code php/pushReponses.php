<?php //début du php / fin du html
require 'Connect.php';
//Page effectuant la création de variable dans la table reponses à partir des modification apporté dans les textBoxs
//de interface_pro_FT.php

if(!empty($_POST['reponses_idQ']) && !empty($_POST['reponses_idQSuiv'])){
$reponses_idQ = $_POST['reponses_idQ'];
$reponses_idQSuiv = $_POST['reponses_idQSuiv'];
$reponses_idFin = $_POST['reponses_idFin'];
$reponses_lbl = str_replace("'","&#39;",$_POST['reponses_lbl']);

//echo $reponses_idQ.", ".$reponses_idQSuiv.", ".$reponses_idFin.", ".$reponses_lbl;
$bdd->query("INSERT INTO reponses(`id_q`, `id_q_suiv`, `id_fin`, `libelle`) VALUES(".$reponses_idQ.", ".$reponses_idQSuiv.", ".$reponses_idFin.", '".$reponses_lbl."')");
}
else{
    echo " Impossible de créer cette réponse car vous n'avez rempli tous les champs demandés";
	echo "<br>Veuillez remplir tous les champs avant dinserer des informations<br>";
    echo '<button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)">Retour</button>';
    exit();
}

header('Location: Interface_pro_FT.php');


?> <!-- fin du php/ début du html -->

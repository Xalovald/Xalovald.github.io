<?php //début du php / fin du html
require 'Connect.php';
//Page effectuant la création de variable dans la table questions à partir des modification apporté dans les textBoxs
//de interface_pro_FT.php

if(!empty($_POST['questions_idPb']) && !empty($_POST['questions_lbl'])){
$questions_idPb = $_POST['questions_idPb'];
$questions_lbl = str_replace("'","&#39;",$_POST['questions_lbl']);

$bdd->query("INSERT INTO questions(`id_pb`, `Libelle`) VALUES(".$questions_idPb.", '".$questions_lbl."')");
}

else{
    echo " Impossible de créer cette question car vous n'avez rempli toutes les cases demandés";
	echo "<br>Veuillez remplir tous les champs avant d'insérer des informations<br>";
    echo '<button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)">Retour</button>';
    exit();
}

header('Location: Interface_pro_FT.php');
?> <!-- fin du php/ début du html -->

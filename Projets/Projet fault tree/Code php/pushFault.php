<?php //début du php / fin du html
require 'Connect.php';
//Page effectuant la création de variable dans la table fault à partir des modification apporté dans les textBoxs
//de interface_pro_FT.php

if(!empty($_POST['fault_lbl']) && !empty($_POST['fault_debut'])){
$fault_lbl = str_replace("'","&#39;",$_POST['fault_lbl']);
$fault_debut = $_POST['fault_debut'];
$type = $_POST['type'];

$bdd->query("INSERT INTO fault(`Libelle`, `debut`, `type`) VALUES('".$fault_lbl."', ".$fault_debut.",'".$type."')");
}

else{
    echo " Impossible de cr&eacute;er ce problème car vous n'avez rempli tous les champs demandés";
	echo "<br>Veuillez remplir tous les champs avant d'insérer des informations<br>";
    echo '<button type="button" class="btn btn-primary" onclick="javascript:history.go(-1)">Retour</button>';
    exit();
}

header('Location: Interface_pro_FT.php');
?> <!-- fin du php/ début du html -->

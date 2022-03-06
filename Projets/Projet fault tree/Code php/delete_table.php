<?php //début du php / fin du html
//page pour déclaré la suppression des variables sous certaines conditions et pour les tables :
// info et id_rep, fault, question et reponses)
require "Connect.php";
if(isset($_GET['id_rep']) && isset($_GET['id_info'])){ //Sert à supprimer des entrer (entrée tables id_rep et tables info) dans le tableau des erreurs utilisateurs
    $id_info = $_GET['id_info'];
    $id_rep = $_GET['id_rep'];
    $bdd->query("DELETE FROM id_repertoire WHERE `id`= ".$id_rep);
    $bdd->query("DELETE FROM info WHERE `id`= ".$id_info);
}
elseif(isset($_GET['id_fault'])){ //Sert à suppprimer des entrées dans la table fault
    $id_fault = $_GET['id_fault'];
    $bdd->query("DELETE FROM fault WHERE `id`= ".$id_fault);
}
elseif(isset($_GET['id_questions'])){ //Sert à suppprimer des entrées dans la table questions
    $id_questions = $_GET['id_questions'];
    $bdd->query("DELETE FROM questions WHERE `id_q`= ".$id_questions);
}
elseif(isset($_GET['id_reponses'])){ //Sert à suppprimer des entrées dans la table reponses
    $id_reponses = $_GET['id_reponses'];
    $bdd->query("DELETE FROM reponses WHERE `id_r`= ".$id_reponses);
}
header('Location: Interface_pro_FT.php');
?> <!-- fin du php/ début du html -->

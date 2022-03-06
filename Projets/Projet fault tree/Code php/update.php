<?php
/*Script php pour signifier et effectuer les modifiactions dans les champs dans les interfaces Update
dédiée au différente tables : fault, questions, reponses*/
require "Connect.php";
if(isset($_GET['fault_id'])){ //Update pour la table fault, concernant les champs debur, libelle et type
    $new_libelle = str_replace("'","&#39;",$_POST['fault_libelle']);
    $new_debut = $_POST['fault_debut'];
    $un_id = $_GET['fault_id'];
    $type = $_POST['type'];
    $bdd->query("UPDATE fault SET Libelle='".$new_libelle."', debut=".$new_debut.", `type`='".$type."' WHERE id=".$un_id);
}
elseif(isset($_GET['questions_id'])){ //Update pour la table questions id_pb et libelle
    $new_libelle = str_replace("'","&#39;",$_POST['questions_libelle']);
    $new_id_pb = $_POST['questions_id_pb'];
    $un_id = $_GET['questions_id'];
    $bdd->query("UPDATE questions SET Libelle='".$new_libelle."', id_pb=".$new_id_pb." WHERE id_q=".$un_id);
}
elseif(isset($_GET['reponses_id'])){ //Update pour la table reponses concernant id_q, id_q_suiv, id_fin et libelle
    $new_id_q = $_POST['reponses_id_q'];
    $new_id_q_suiv = $_POST['reponses_id_q_suiv'];
    $new_id_fin = $_POST['reponses_id_fin'];
    $new_libelle = str_replace("'","&#39;",$_POST['reponses_libelle']);
    $un_id = $_GET['reponses_id'];
    $bdd->query("UPDATE reponses SET id_q=".$new_id_q.",id_q_suiv=".$new_id_q_suiv.",id_fin=".$new_id_fin.",libelle='".$new_libelle."' WHERE id_r=".$un_id);
}
header("Location: Interface_pro_FT.php");
?>

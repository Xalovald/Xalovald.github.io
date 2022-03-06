<?php //début du PHP
//page servant à renseigner les informations pour l'envoie du mail
$headers = "From: gbahno@ch-annecygenevois.fr"; //champ à modifier pour éditer l'adresse mail d'où émànera le mail
$headers .= 'Mime-Version: 1.0'."\r\n";
$headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n"; //indique le contenu qu'est autoriser à avoir le mail
$headers .= "\r\n";

$destinataire = "integration.iws@ch-annecygenevois.fr"; //adresse du destinataire du mail
$subject = "fault_tree"; //titre qu'aura le formulaire en sujet
?><!-- fin du php -->

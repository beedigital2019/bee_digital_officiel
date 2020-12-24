<?php

function isAjax(){
    return ($_SERVER['HTTP_X_REQUESTED_WITH'])  == 'xmlhttprequest';
}
$success = 0;
$msg = "";
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['telephone']) && !empty($_POST['message'])) {
    $prenom = htmlspecialchars(strip_tags($_POST['prenom']));
    $nom = htmlspecialchars(strip_tags($_POST['nom']));
    $telephone = htmlspecialchars(strip_tags($_POST['telephone']));
    $message = htmlspecialchars(strip_tags($_POST['message']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (preg_match('#^(77||78||76||70)[0-9]{7}$#', $telephone)) {
            $success = 1;
            $msg = 'Votre message a été bien envoyé';

        } else {
            $msg = "Le numéro de téléphone n'est pas valide.";
        }
    } else {
        $msg = "L'adresse email n'est pas valide.";
    }
} else {
    $msg = "Veuillez remplir tous les champs .";
}

$resultats =  ["success" => $success, "msg" => $msg];
echo json_encode($resultats);
// if (isAjax()) {
//     echo json_encode($resultats);
//     header('Content-Type: application/json');
//     die();
// }


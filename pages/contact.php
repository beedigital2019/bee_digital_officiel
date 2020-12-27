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
            $to = $email;
            $subject = "Demande de renseignemnt";
            $message = "
                <html>
                    <head>
                    <title>Bienvenue ".$prenom." ".$nom. "</title>
                    </head>
                    <body>
                        <h3>Nom Complet : " . $prenom . " " . $nom . "</h3>
                        <h3>Téléphone : ".$telephone. "</h3>
                        <h3>Message: <br>".$message."</h3>
                    </body>
                </html>"
            ;

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Reply-To: ' . $to . "\r\n";
            // More headers
            $headers .= 'From: \''.$prenom.' '.$nom.'\'<beedigital@beedigitaltech.com>' . "\r\n";
            $headers .= 'Cc: beedigital@beedigitaltech.com' . "\r\n";

            mail($to, $subject, $message, $headers);
            
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

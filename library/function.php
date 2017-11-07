<?php
use resabike\library\php\phpMailer;
function error_404(){
    return '404 ça marche pas';
}

function redirectIfNotConnected() {
    if(!isset($_SESSION['connected']))
        header('Location: '.DS.'resabike'.DS.'login');
}

function redirectByRole($limitRole, $canAccess, $ctr, $action = 'index') {
    // If the user role is lower than the value in parameter, a redirection will be made
    if($_SESSION['user']['idRole'] < $limitRole) {
        // If the user can access to the page, a redirection with a filter to the right page is made
        // Otherwise, a redirection with a filter to the books page is made
        if($canAccess) {
            // If no specified or different zone than the driver zone, redirection in the correct zone
            if (!isset($_GET['zone']) || $_GET['zone'] <> $_SESSION['user']['idZone'])
                header('Location: ' . DS . 'resabike' . DS . $ctr . DS . $action . '?zone=' . $_SESSION['user']['idZone']);
        } else
            header('Location: ' . DS . 'resabike' . DS . 'books' . DS . $action . '?zone=' . $_SESSION['user']['idZone']);
    }
}

function trad($key, $return = false)
{
    // Langue par défaut
    $currentlang = 'en';
    // Si aucune langue n'est sélectionnée, on sélectionne la langue par défaut
    $currentlang = (isset($_SESSION['lang'])) ? strtolower($_SESSION['lang']) : $currentlang;

    // Chemin vers le fichier de langues
    $path = ASSETSPATH . DS . 'languages' . DS . $currentlang . '.json';

    // Récupération du contenu du fichier
    $a = file_get_contents($path);
    $lang = json_decode($a, true);

    // Si le fichier n'existe pas ou que le mot clé n'est pas encore traduit
    if(empty($lang) || !array_key_exists($key, $lang)) {

        // Si la langue actuelle est anglais
        if($currentlang == 'en')
        {
            // Création du mot clé avec la traduction
            $lang[$key] = $key;
            // Ajout dans le fichier
            file_put_contents($path, json_encode($lang));
        }
        else
        {
            // Affichage du mot en anglais entouré de crochets
            return returnOrEcho('[' . $key . ']', $return);
        }
    }
    // Affichage de la traduction
    return returnOrEcho($lang[$key], $return);
}

function returnOrEcho($value, $isReturn)
{
    if($isReturn) {
        return $value;
    }
    else {
        echo $value;
    }
    return '';
}

function phpMailer($from, $to, $object){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 465
    $mail->Username = "bestproject69kevdan@gmail.com";
    $mail->Password = "salutcava";
    $mail->IsHTML(true);
    $mail->From = $from;
    $mail->AddAddress($to);
    $mail->AddReplyTo($from);
    $mail->Subject = 'Resabike: ' . utf8_decode($object);
    $mail->Body = 'Salut, t\'as bien réservé chez les meilleurs du coin, kiss, kiss';

    if (!$mail->Send()) // Teste le return code de la fonction
        echo $mail->ErrorInfo; // Affiche le message d\'erreur
    $mail->SmtpClose();
    unset($mail);
}
<?php
use resabike\library\php\phpMailer;

/**
 * @return string
 */
function error_404(){
    return '404 ça marche pas';
}

/**
 *
 */
function redirectIfNotConnected() {
    if(!isset($_SESSION['connected']))
        header('Location: '.DS.'resabike'.DS.'login');
}

/**
 * @param $limitRole
 * @param $canAccess
 * @param $ctr
 * @param string $action
 */
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

/**
 * @param $key
 * @param bool $return
 * @return string
 */
function trad($key, $return = false)
{
    // Language by default
    $currentlang = 'en';
    // Select the language by default if no language are selected
    $currentlang = (isset($_SESSION['lang'])) ? strtolower($_SESSION['lang']) : $currentlang;

    // path to the json file
    $path = ASSETSPATH . DS . 'languages' . DS . $currentlang . '.json';

    //get the content of the json file
    $a = file_get_contents($path);
    $lang = json_decode($a, true);

    // If the words doesn't exist in the json file
    if(empty($lang) || !array_key_exists($key, $lang)) {


        if($currentlang == 'en')
        {
            // Create the word in the json file
            $lang[$key] = $key;
            file_put_contents($path, json_encode($lang));
        }
        else
        {
            // Set the word with brackets
            return returnOrEcho('[' . $key . ']', $return);
        }
    }
    // Set the translate
    return returnOrEcho($lang[$key], $return);
}

/**
 * @param $value
 * @param $isReturn
 * @return string
 */
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

/**
 * Function to send a mail
 * @param $from
 * @param $to
 * @param $object
 * @param $body
 */
function phpMailer($from, $to, $object, $body){
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
    $mail->Body = $body;

    if (!$mail->Send())
        echo $mail->ErrorInfo;
    $mail->SmtpClose();
    unset($mail);
}
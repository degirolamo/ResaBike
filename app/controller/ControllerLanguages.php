<?php
/**
 * Created by PhpStorm.
 * User: degir
 * Date: 31.10.2017
 * Time: 11:10
 */

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerLanguages extends Controller
//redirection and change the language in the session
{
    public function index() {
        $_SESSION['lang'] = $_GET['lang'];
        header('Location: /resabike/'.$_GET['lastPage']);
    }
}
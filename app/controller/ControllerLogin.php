<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerLogin extends Controller
{
    //Call the action to get all user for checking if the function Login can work
    public function index()
    {

        if (isset($_POST['connect'])) {
            $userList = $this->model->getAllUsers();

            foreach ($userList as $user) {
                if ($_POST['pseudo'] == $user['pseudo']) {

                    $passChecked = $this->model->checkLogin($user['pseudo']);
                    if ($_POST['mdp'] == $passChecked) {
                        $_SESSION['UserConnected'] = $user;
                        header("Location: /resabike/book");
                    }
                }
            }

            echo '<h5 style="text-align: center; background-color:#bf360c; color: #FFFFFF">Mot de passe ou pseudo incorrect ! </h5>';

        }

        return $this->view->RenderPartial();
    }
//Destroy all what you have in session and set userconnected to null
    public function logout(){

        session_destroy();
        $_SESSION['UserConnected'] == null ;
        header("Location: /resabike/index");

    }
}

?>
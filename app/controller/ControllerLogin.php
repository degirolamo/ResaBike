<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerLogin extends Controller
{
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

            echo '<h5 style="text-align: center;color: #bf360c">Mot de passe ou pseudo incorrect sale fdp </h5>';

        }

        return $this->view->RenderPartial();
    }

    public function logout(){

        session_destroy();
        $_SESSION['UserConnected'] == null ;
        header("Location: /resabike/index");

    }
}

?>
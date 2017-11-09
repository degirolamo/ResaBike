<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25.10.2017
 * Time: 18:18
 */


namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerUsers extends Controller
{

    public function index() {

        $UserConnected = $_SESSION['UserConnected'];

        if($UserConnected!=null){

            $users = $this->model->getAllUsers();
            $this->view->Set('users', $users);
            return $this->view->Render();
        }
        else
            header("Location: /resabike/login");
    }

    public function add() {


        $UserConnected = $_SESSION['UserConnected'];

        if($UserConnected!=null){

        if(isset($_POST['submit'])) {
            if ($_POST['idRole'] == 3){
                $this->model->addUser($_POST['idRole'], null, $_POST['pseudo'], "pass", $_POST['email']);
            }
            $this->model->addUser($_POST['idRole'], $_POST['idZone'], $_POST['pseudo'], "pass", $_POST['email']);
            header("Location: /resabike/users");
        }

        $roles = $this->model->getAllRoles();
        $this->view->Set('roles',$roles);

        $zones = $this->model->getAllZones();
        $this->view->Set('zones',$zones);

        return $this->view->Render();
        }
        else
            header("Location: /resabike/login");
    }

    public function delete() {
        $this->model->deleteUser($_GET['id']);
        header("Location: /resabike/users");
    }

    public function edit(){


        // Pour les dropdown
        $roles = $this->model->getAllRoles();
        $this->view->Set('roles',$roles);

        $zones = $this->model->getAllZones();
        $this->view->Set('zones',$zones);

        //user edited

        $userEdited = $this->model->editUser($_GET['id']);

        $this->view->Set('userEdited',$userEdited);

        if(isset($_POST['submit'])) {
            $this->model->updateUser($userEdited['id'],$_POST['idRole'],$_POST['idZone'],$_POST['pseudo'],'pass',$_POST['email']);
            header("Location: /resabike/users");
        }

        return $this->view->Render();

    }
}
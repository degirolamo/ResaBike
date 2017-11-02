<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;


class ControllerZone extends Controller
{

    public function index()
    {

        $zones = $this->model->getAllZones();
        $this->view->Set('zones', $zones);
        return $this->view->Render();


    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $this->model->addZone($_POST['nom']);
            header("Location: /resabike/zone");
        }
        return $this->view->Render();
    }

    public function delete()
    {
        $this->model->deleteZone($_GET['id']);
        header("Location: /resabike/zone");
    }

    public function edit()
    {
        //zone edited

        $zoneEdited = $this->model->editZone($_GET['id']);

        $this->view->Set('zoneEdited', $zoneEdited);

        if (isset($_POST['submit'])) {
            $this->model->updateZone($zoneEdited['id'], $_POST['nom']);
            header("Location: /resabike/zone");
        }

        return $this->view->Render();
    }
}

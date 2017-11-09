<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;


class ControllerZone extends Controller
{
//Call the function to get all zones by user
    public function index()
    {
        $UserConnected = $_SESSION['UserConnected'];

        if ($UserConnected != null) {


            if ($_SESSION['UserConnected']['idRole'] == 3) {
                $zones = $this->model->getAllZones();

            } else {

                $zones = $this->model->getAllGoodZones($UserConnected['idZone']);
            }

            $this->view->Set('zones', $zones);
            return $this->view->Render();
        } else
            header("Location: /resabike/login");
    }
//Call the function to add a zone
    public function add()
    {
        $UserConnected = $_SESSION['UserConnected'];

        if($UserConnected!=null){

        if (isset($_POST['submit'])) {
            $lastInsertId = $this->model->addZone($_POST['nom']);
            header('Location: /resabike/zone/edit?id=' . $lastInsertId);
        }
        return $this->view->Render();
        } else
            header("Location: /resabike/login");
    }
//Call the function to delete a zone and the stations
    public function delete()
    {
        $this->model->deleteStations($_GET['id']);
        $this->model->deleteZone($_GET['id']);
        header("Location: /resabike/zone");
    }
//Call the function to edit a zone
    public function edit()
    {
        if (isset($_POST['submitEdit'])) {
            $this->model->updateZone($_GET['id'], $_POST['nom']);
            header("Location: /resabike/zone");
            exit;
        }

        //zone edited
        $zoneEdited = $this->model->editZone($_GET['id']);
        $this->view->Set('zoneEdited', $zoneEdited);

        return $this->view->Render();
    }
//Call the function to add a station per time
    public function addStation()
    {
        $name = $_GET['name'];
        $zone = $_GET['zone'];

        if ($this->model->addStation($name, $zone))
            return 'Station ajoutée !';
        return 'Cette station existe déjà';
    }
//Call the function to add all stations
    public function addAllStations()
    {
        $stations = explode(';', $_GET['stations']);
        $messages = [];

        foreach ($stations as $station) {
            if ($this->model->addStation($station, $_GET['zone']))
                array_push($messages, 'Station ajoutée !');
            else
                array_push($messages, 'Cette station existe déjà');;
        }

        return json_encode($messages);
    }
}

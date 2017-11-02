<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerIndex extends Controller
{

    public function index()
    {
        if (isset($_POST['submit'])) {
            $_SESSION['date'] = $_POST['date'];
            $_SESSION['from'] = $_POST['from'];
            $_SESSION['to'] = $_POST['to'];
            header('Location: /resabike/index/search');

        }

        return $this->view->Render();
    }

    public function getStations() {
//        return $this->model->getStations($_GET['input']);
        $arrets = $this->model->getStations($_GET['input']);
        return json_encode($arrets);
    }

    public function search()
    {
        $date = $_SESSION['date'];
        $from = $_SESSION['from'];
        $to = $_SESSION['to'];
        $this->view->Set('date', $date);
        $this->view->Set('from', $from);
        $this->view->Set('to', $to);

        if (isset($_POST['reserv'])) {

            header('Location: /resabike/index/confirmReserv');
        }

        return $this->view->Render();
    }

    public function zones()
    {

        if (isset($_POST['zones'])) {

            header('Location: /resabike/zone/showZonesSYSADMIN');
        }

        return $this->view->Render();

    }


    public function confirmReserv()
    {

        header("refresh:3;url=/resabike/index.php");

        return $this->view->Render();
    }


}
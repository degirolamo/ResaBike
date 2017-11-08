<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;
use Resabike\App\mail;

class ControllerIndex extends Controller
{

    public function index()
    {
        if (isset($_POST['btn-searchTime'])) {


            header('Location: /resabike/index/search');

        }

        $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');
        return $this->view->Render();
    }

    public function about()
    {
        if (isset($_SESSION['UserConnected']) == true)
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-main.php');
        else
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');

        return $this->view->Render();


    }

    public function contact()
    {

        if (isset($_SESSION['UserConnected']) == true)
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-main.php');
        else
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');

        return $this->view->Render();

    }

    public function getStations()
    {
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

        echo getcwd();


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
        if(isset($_POST['submit'])) {
            //idStationDepart
            $idStationDep = $this->model->getStationByName($_POST['from'])['id'];
            //idStationFin
            $idStationEnd = $this->model->getStationByName($_POST['to'])['id'];
            //email
            $email = $_POST['mail'];
            //nbVelos
            $nbVelos = $_POST['nbBikes'];
            //dateDepart
            $dateDepart = date('Y-m-d H:i:s', strtotime($_POST['departure']));
            //Ajout dans la base de données
            $this->model->addBook($idStationDep, $idStationEnd, $email, $nbVelos, $dateDepart, 1);
            //Envoi de mail user
            phpMailer('bestproject69kevdan@gmail.com',$email,'Reservation Resabike '.$dateDepart, 'Bonjour, <br/><br/>Vous avez effectué une réservation. <br/><br/> Merci pour votre confiance ! <br/><br/><br/> Team Resabike');
            //Envoi de mail admin'Reservation Resabike '.$dateDepart
            phpMailer('bestproject69kevdan@gmail.com','bestproject69kevdan@gmail.com','Reservation '.$email.' '.$dateDepart, 'Bonjour, <br/><br/>Une reservation a été faite par '.$email.'<br/><br/>Veuillez vérifier avec le ZoneAdmin si nous avons besoin dune remorque. <br/><br/><br/> ResaBike <br/> SysAdmin');
        }

        header("refresh:2;url=/resabike/index.php");


        return $this->view->RenderPartial();
    }



}
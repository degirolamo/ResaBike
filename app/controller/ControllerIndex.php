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
            //Envoi de mail admin
        }

        header("refresh:2;url=/resabike/index.php");


        return $this->view->RenderPartial();
    }


    public function sendMail()
    {


        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->setFrom('kevin_carneiro@hotmail.fr', 'moi');
        $mail->addAddress('kevin_carneiro@hotmail.fr', 'poto');
        $mail->Subject = 'First PHPMailer Message';
        $mail->Body = 'Hi! This is my first e-mail sent through PHPMailer.';
        if (!$mail->send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }
    }
}
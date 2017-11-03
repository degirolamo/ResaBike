<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;
use Resabike\App\mail;

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

        $this->view->SetLayout(APPPATH.DS.'view'.DS.'_shared'.DS.'view-notConnected.php');
        return $this->view->Render();
    }

    public  function about()
    {
        if(isset($_SESSION['UserConnected'])==true)
            $this->view->SetLayout(APPPATH.DS.'view'.DS.'_shared'.DS.'view-main.php');
        else
            $this->view->SetLayout(APPPATH.DS.'view'.DS.'_shared'.DS.'view-notConnected.php');

        return $this->view->Render();


    }

    public function contact()
    {

        if(isset($_SESSION['UserConnected'])==true)
            $this->view->SetLayout(APPPATH.DS.'view'.DS.'_shared'.DS.'view-main.php');
        else
            $this->view->SetLayout(APPPATH.DS.'view'.DS.'_shared'.DS.'view-notConnected.php');

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

        echo getcwd();

        if (isset($_POST['reserv'])) {

        $this->sendMail();

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

        header("refresh:2;url=/resabike/index.php");



        return $this->view->RenderPartial();
    }


    public function sendMail(){


        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->setFrom('kevin_carneiro@hotmail.fr', 'moi');
        $mail->addAddress('kevin_carneiro@hotmail.fr', 'poto');
        $mail->Subject  = 'First PHPMailer Message';
        $mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
        if(!$mail->send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }
    }
}
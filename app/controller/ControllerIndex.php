<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;
use Resabike\App\mail;

class ControllerIndex extends Controller
{

    public function index()
    {


        if (!isset($_SESSION['UserConnected'])) {


            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');
            return $this->view->Render();

        } else
            header("Location: /resabike/book");
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
        if (isset($_POST['submit'])) {

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
            $phone = $_POST['phone'];


            $lastInsertId = $this->model->addBook($idStationDep, $idStationEnd, $email, $phone, $nbVelos, $dateDepart, 1);
            //Envoi de mail user
            phpMailer('bestproject69kevdan@gmail.com', $email, 'Reservation Resabike ' . $dateDepart, 'Bonjour, <br/><br/>Vous avez effectue une reservation. <br/><br/> Merci pour votre confiance ! <br/><br/>Si vous souhaitez supprimer votre reservation, cliquez sur le lien suivant : http://localhost/resabike/index/delete?id=' . $lastInsertId . '<br/><br/><br/> Team Resabike');

            //Envoi de mail admin'Reservation Resabike '.$dateDepart


            phpMailer('bestproject69kevdan@gmail.com', 'bestproject69kevdan@gmail.com', 'Reservation ' . $email . ' ' . $dateDepart, 'Bonjour, <br/><br/>Une reservation a ete faite par ' . $email . '<br/><br/>Veuillez verifier avec le ZoneAdmin si nous avons besoin dune remorque. <br/><br/><br/> ResaBike <br/> SysAdmin');


        }

        header("refresh:2;url=/resabike/index.php");


        return $this->view->RenderPartial();
    }

    public function delete()
    {
        $this->model->deleteBook($_GET['id']);
        header("Location: /resabike/index");

    }

    public function feedback()
    {

        if (isset($_POST['sendFeedback'])) {
            echo 'test';

            $pseudo = $_POST['pseudo'];
            $text = $_POST['text'];
            $mail = $_POST['mail'];


            echo 'debut';
            var_dump($pseudo);
            var_dump($text);
            var_dump($mail);
            echo 'fin';


            phpMailer('bestproject69kevdan@gmail.com', 'bestproject69kevdan@gmail.com', 'Feedback by ' . $pseudo, 'Ci-dessous, un feedback reçu par un client :, <br/><br/> ' . $text . '<br/><br/> <br/><br/><br/> ResaBike <br/> System');

            if (isset($_POST['checkbox'])) {

                phpMailer('bestproject69kevdan@gmail.com', $mail, 'Feedback copy', ' ' . $text . '<br/><br/><br/> ResaBike <br/> System');

            }

            header('Location: /resabike/index');

        }

        $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');
        return $this->view->Render();

    }
}
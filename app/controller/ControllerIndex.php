<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;
use Resabike\App\mail;

class ControllerIndex extends Controller
{

    public function index()
    {

//Check if the user is connected to choose which layout set
        if (!isset($_SESSION['UserConnected'])) {


            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');
            return $this->view->Render();

        } else
            header("Location: /resabike/book");
    }

//Check if the user is connected to choose which layout set

    public function about()
    {
        if (isset($_SESSION['UserConnected']) == true)
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-main.php');
        else
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');

        return $this->view->Render();


    }
//Check if the user is connected to choose which layout set

    public function contact()
    {

        if (isset($_SESSION['UserConnected']) == true)
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-main.php');
        else
            $this->view->SetLayout(APPPATH . DS . 'view' . DS . '_shared' . DS . 'view-notConnected.php');

        return $this->view->Render();

    }
//Call the action to get a list of stations
    public function getStations()
    {
        $arrets = $this->model->getStations($_GET['input']);

        return json_encode($arrets);
    }

    //Call the action to add a new book
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
    //Call the action to delete a book

    public function delete()
    {
        $this->model->deleteBook($_GET['id']);
        header("Location: /resabike/index");

    }
    //Call the action to send a mail with the feedback

    public function feedback()
    {

        if (isset($_POST['sendFeedback'])) {
            echo 'test';

            $pseudo = $_POST['pseudo'];
            $text = $_POST['text'];
            $mail = $_POST['mail'];



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
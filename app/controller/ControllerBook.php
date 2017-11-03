<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerBook extends Controller
{

    public function index()
    {
        $UserConnected = $_SESSION['UserConnected'];

        if ($_SESSION['UserConnected']['idRole'] == 3) {

            $books = $this->model->getAllBooks();
        } else {

            $books = $this->model->getAllGoodBooks($UserConnected['idZone']);
        }
        $this->view->Set('books', $books);
        return $this->view->Render();

    }

    public function delete()
    {
        $this->model->deleteBook($_GET['id']);
        header("Location: /resabike/book");
    }

}
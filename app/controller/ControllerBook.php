<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerBook extends Controller
{
//Call the action to get the list of books by user

    public function index()
    {
        $UserConnected = $_SESSION['UserConnected'];

        if ($UserConnected != null) {

            if ($_SESSION['UserConnected']['idRole'] == 3) {

                $books = $this->model->getAllBooks();
            } else {

                $books = $this->model->getAllGoodBooks($UserConnected['idZone']);
            }
            $this->view->Set('books', $books);
            return $this->view->Render();

        } else
            header("Location: /resabike/login");
    }
//Call the action to delete a book by id
    public function delete()
    {
        $UserConnected = $_SESSION['UserConnected'];

        if ($UserConnected != null) {


            $this->model->deleteBook($_GET['id']);
            header("Location: /resabike/book");

        } else
            header("Location: /resabike/index");
    }
}
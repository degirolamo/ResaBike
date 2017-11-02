<?php

namespace ResaBike\App\Controller;

use ResaBike\Library\Mvc\Controller;

class ControllerBook extends Controller
{

    public function index(){
        $books = $this->model->getAllBooks();
        $this->view->Set('books', $books);
        return $this->view->Render();

}
    public function delete() {
        $this->model->deleteBook($_GET['id']);
        header("Location: /resabike/book");
    }

}
<?php
namespace ResaBike\Library\Mvc;

class Controller{

    protected $currentController;
    protected $currentAction;

    protected $model;
    public $view;

    /**
     * Controller constructor.
     * @param $currentController
     * @param $currentAction
     * @param $model
     * @param $view
     */
    public function __construct($currentController, $currentAction, $model, $view){
        $this->currentController = $currentController;
        $this->currentAction = $currentAction;
        $this->model = $model;
        $this->view = $view;
    }
}
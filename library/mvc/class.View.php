<?php
namespace ResaBike\Library\Mvc;

class View {

    public $viewPath;
    public $viewData;
    public $layoutPath;
    public $controller;
    public $currentController;
    public $currentAction;

    /**
     * View constructor.
     * @param $ctr
     * @param $act
     */
    public function __construct($ctr, $act) {
        $this->currentController = $ctr;
        $this->currentAction = $act;
        $this->viewData = array();
        $this->viewPath = APPPATH.DS.'view'.DS.$ctr.DS.'view-'.$act.'.php';
        $this->layoutPath = APPPATH.DS.'view'.DS.'_shared'.DS.'view-main.php';
    }

    /**
     * @param $ctr
     */
    public function SetController($ctr) {
        $this->controller = $ctr;
    }

    /**
     * @param $key
     * @param $value
     */
    public function Set($key, $value) {
        $this->viewData[$key] = $value;
    }

    /**
     * @param $key
     */
    public function Uset($key) {
        unset($this->viewData[$key]);
    }

    /**
     * @param $path
     */
    public function SetView($path) {
        $this->viewPath = $path;
    }

    /**
     * @param $path
     */
    public function SetLayout($path) {
        $this->layoutPath = $path;
    }

    /**
     * Layout whitout header and footer
     * @return string
     */
    public function RenderPartial() {
        extract($this->viewData);
        ob_start();
        include($this->viewPath);
        return ob_get_clean();
    }

    /**
     * Layout includes header and footer
     * @return string
     */
    public function Render() {
        $html = $this->RenderPartial();
        ob_start();
        include($this->layoutPath);
        return ob_get_clean();
    }

    /**
     * return a string in json format
     * @return string
     */
    public function RenderAjax() {
        return json_encode($this->viewData);
    }
}
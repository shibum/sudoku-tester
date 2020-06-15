<?php 

class Board extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function indexAction() {
        $this->view->render('board/index');
    }

    public function resultAction() {
        $this->view->render('board/result');
    }
}

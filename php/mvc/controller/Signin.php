<?php

namespace mvc\controller;

class Signin extends Controller {

    private $dataEntered = false;
    private $isSignedIn = false;
    private $usertype = 'visitor';

    public function __construct($url) {
        parent::__construct();
        $em = filter_input(INPUT_POST, 'em');
        $pw = filter_input(INPUT_POST, 'pw');
        $this->dataEntered = ($em && $pw);
        if ($this->dataEntered) {
            $this->model = new \mvc\model\Signin($em, $pw);
            if ($this->model->isSignedIn()) {
                $this->setSignIn($this->model->getFirstName());
                $_SESSION['OBSid']=$this->model->getId();
                $this->setType($this->model->getType());
                $this->setEmail($em);
            }
        }

        $referer = $_SERVER['HTTP_REFERER'];

        header('Location:' . $referer);
    }

    public function action() {
        
    }

    public function getTitle() {
        return "";
    }

    public function isDataValid() {
        return $this->dataEntered;
    }

}

?>

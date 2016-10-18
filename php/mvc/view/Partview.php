<?php

namespace mvc\view;

abstract class Partview {

    protected $model = null;
    protected $title = '';
    protected $error = '';
    protected $eventMsg = '';
    protected $controller = null;

    /**
     * The constructor accepts a reference to a Controller and sets the model and title references.  
     * 
     * @param mvc\controller\Controller $controller Reference to a mvc\controller\Controller
     */
    public function __construct($controller) {
        $this->model = $controller->getModel();
        $this->title = $controller->getTitle();
        $this->error = $controller->getError();
        $this->eventMsg = $controller->getEventMsg();
        $this->controller = $controller;
    }

    // create an abstract method that will force child classes to implement this method
    abstract public function body($model);

    public function errorMessage() {

        echo "<div id='ErrorMsgDiv'>" . $this->error . "<br><img src=" . IMAGES_URL . "Error.png></div>";
    }

    public function eventMessage() {
        echo "<div id='EventMsgDiv'>" . $this->eventMsg . "</div>";
    }

    public function page() {

        if ($this->eventMsg)
            $this->eventMessage();
        if ($this->error)
            $this->errorMessage();
        else
            $this->body($this->model);

    }

}

?>

<?php

namespace mvc\view;

abstract class View {

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

    public function header($model) {
        //       require INCLUDES.'header.php';
        require_once(INCLUDES . 'header.php');
    }

    // create an abstract method that will force child classes to implement this method
    abstract public function body($model);

    public function errorMessage() {
        
        echo "<div id='ErrorMsgDiv'>" . $this->error . "<br><img src=".IMAGES_URL."Error.png></div>";
    }

    public function eventMessage() {
        echo "<div id='EventMsgDiv'>" . $this->eventMsg . "</div>";
    }

    public function footer($model) {
        require_once(INCLUDES . 'footer.php');
    }

    public function page() {
        $this->header($this->model);

        if ($this->eventMsg)
            $this->eventMessage();

        if ($this->error)
            $this->errorMessage();
        else
            $this->body($this->model);

        $this->footer($this->model);
    }

}

?>

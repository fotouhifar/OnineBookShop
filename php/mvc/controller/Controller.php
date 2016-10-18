<?php

namespace mvc\controller;

/**
 * <b>Controller</b> controls the flow and generates an output in the action method. 
 * A Controller 
 * <ul>
 * <li>implements the business logic for the page it is to generate</li>
 * <li>must implement the <i>action</i> and <i>getTitle</i> methods</li>
 * <li>usually instantiates a Model</li>
 * <li>instantiates a View for the display of the webpage</li>
 * </ul>
 */
abstract class Controller {

    /**
     *
     * A reference to an instance of Model . 
     * 
     * @var mvc\model\Model
     *   
     */
    protected $model = null;

    /**
     * A reference to an instance of View .  
     * 
     * @var mvc\view\View
     *  
     */
    protected $view = null;

    /**
     *
     * A string the contains an error message for the user. 
     * The Controller is responsible for intializing this with an non-empty string if an error 
     * has occurred.
     * 
     * @var string
     */
    protected $eventmessage = '';
    protected $error = '';
    protected $name = '';
    protected $userType = '0';
    protected $signedIn = false;
    protected $cart = array();
    protected $bread = array();
    protected $isCart = false;

    public function __construct() {
        session_start();
        // test for the existence of the key 'name' in the $_SESSION array 
        // If 'name' exists then the customer has previously signed in
        $this->signedIn = isset($_SESSION['OBSname']);
        if (!isset($_SESSION['OBSusertype']))
            $_SESSION['OBSusertype'] = 'visitor';
        // get the name out of the session array for display on the web pages.    
        $this->name = ($this->signedIn) ? $_SESSION['OBSname'] : '';
        $this->userType = ($this->signedIn) ? $_SESSION['OBSusertype'] : 'visitor';

        if (isset($_SESSION['OBScart']))
            $this->cart = $_SESSION['OBScart'];
        else {
            $this->cart = array();
            $_SESSION['OBScart'] = $this->cart;
        }

        //  BREAD CRUMB
        if (isset($_SESSION['OBSbread']))
            $this->bread = $_SESSION['OBSbread'];
        else {
            $this->bread = array();
            $_SESSION['OBSbread'] = $this->bread;
        }


        //***********
        $this->itemCount = count($this->cart);
    }

    /**
     * This is an abstract method that must be implemented by all classes the inherit Controller.
     *  
     * After instantiating a Controller the action method performs the main
     * task of the Controller once it has configued itself in the constructor. 
     * This method is executed as the final statement in the bootstrap.php 
     */
    abstract public function action();

    /**
     * 
     * Every webpage must have a Title.
     * This method is executed in the constructor of the View class to allocate a title to the webpage. 
     * 
     * This is an abstract method. A class that inherits Controller must implement this method. 
     * The Controller is responsible for generates a title for the webpage.   
     * 
     */
    abstract public function getTitle();

    /**
     * Returns a reference to the Model or null if no Model is present. 
     *
     * 
     * @return mvc\model\Model a reference to the Model or null if no Model is present.
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * 
     * Returns the current error message 
     * This is used by the View class to display an error message.
     * If the error is am empty string then no error is registed by the View class.
     * 
     * @return string
     * 
     */
    public function getError() {
        if ($this->model) {
            return $this->model->getError();
        }
        return '';
    }

    public function getEventMsg() {
        if ($this->model) {
            return $this->model->getEventMsg();
        }
        return '';
    }

    public function getName() {
        return $this->name;
    }

    public function setSignIn($name) {
        $_SESSION['OBSname'] = $name;
    }

    public function setEmail($email) {
        $_SESSION['OBSemail'] = $email;
    }

    public function setType($userType) {
        $_SESSION['OBSusertype'] = $userType;
    }

    public function isSignedIn() {
        return $this->signedIn;
    }

    public function getCartItemCount() {
        return array_sum($_SESSION['OBScart']);
    }

    public function isCart() {
        return ($this->getCartItemCount() > 0);
    }

}

?>

<?php
namespace mvc\controller;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Signout
 *
 * @author amir.fotoohifar
 */
class Signout extends Controller{
  public function __construct($url) {
        parent::__construct(); 
 
        $referer = $_SERVER['HTTP_REFERER'];
            
        unset($_SESSION['OBSname']);     
        unset($_SESSION['OBSemail']);   
        unset($_SESSION['OBSid']);

        
        $_SESSION['OBSusertype']='visitor';      
 
        header('Location:' . $referer);
        
        }

    public function action() {
        
    }

    public function getTitle() {
        
    }
}

?>

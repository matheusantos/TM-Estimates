<?php

/* ! Controler Calendario */

class CalendarioController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
        $this->_helper->layout->setlayout("userlayout");
        $this->view->assign("email", $this->usuario['Email']);
    }

    public function indexAction() {
        
    }

    public function janeiroAction() {
        
    }

    public function fevereiroAction() {
        
    }

    public function marcoAction() {
        
    }

    public function abrilAction() {
        
    }

    public function maioAction() {
        
    }

    public function junhoAction() {
        
    }

    public function julhoAction() {
        
    }

    public function agostoAction() {
        
    }

    public function setembroAction() {
        
    }

    public function outubroAction() {
        
    }

    public function novembroAction() {
        
    }

    public function dezembroAction() {
        
    }

}

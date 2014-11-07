<?php
/*! Controler Calendario */
class CalendarioController extends Zend_Controller_Action
{

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction()
    {

    }

    public function janeiroAction()
    {

    }
    
    public function fevereiroAction()
    {

    }
    
    public function marcoAction()
    {

    }
    
    public function abrilAction()
    {

    }
    
    public function maioAction()
    {

    }
    
    public function junhoAction()
    {

    }
    
    public function julhoAction()
    {

    }
    
    public function agostoAction()
    {

    }
    
    public function setembroAction()
    {

    }
    
    public function outubroAction()
    {

    }
    
    public function novembroAction()
    {

    }
    
    public function dezembroAction()
    {

    }
   
}


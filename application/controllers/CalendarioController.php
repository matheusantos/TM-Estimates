<?php

class CalendarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }

    public function janeiroAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }
    
    public function fevereiroAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }
    
    public function marcoAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }
    
    public function abrilAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }
    
   
}


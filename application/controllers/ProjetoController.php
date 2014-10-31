<?php

class ProjetoController extends Zend_Controller_Action
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

    public function novoAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }


}




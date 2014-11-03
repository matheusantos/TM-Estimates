<?php

class FaseController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function novoAction()
    {
        $this->_helper->layout->setlayout("userlayout");
    }
}


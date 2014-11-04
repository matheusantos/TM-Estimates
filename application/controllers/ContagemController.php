<?php

class ContagemController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout->setlayout("userlayout");
    }
    public function detalhadaAction()
    {
        $this->_helper->layout->setlayout("userlayout");
    }
        public function estimadaAction()
    {
        $this->_helper->layout->setlayout("userlayout");
    }

}


<?php

class EstimarCustoController extends Zend_Controller_Action
{

    public function init()
    {
       if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {

    }


}


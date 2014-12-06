<?php

class ContagemController extends Zend_Controller_Action {

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
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function detalhadaAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function estimadaAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

}

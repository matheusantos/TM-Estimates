<?php

class IndexController extends Zend_Controller_Action {

    private $usuario;
    
    public function init() {       
        //$storage = new Zend_Auth_Storage_Session();
        //$data = $storage->read();

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
        $this->view->assign("email", $this->usuario['Email']);
    }

    public function indexAction() {
        //$this->view->login = $data->nome;
        
    }

    public function sobreAction() {
        // action body
        //$this->_helper->layout->setlayout("userlayout");
    }

    public function pacotesAction() {
        // action body
        //$this->_helper->layout->setlayout("userlayout");
    }

}

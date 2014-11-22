<?php

class VendasController extends Zend_Controller_Action {

    private $usuario;
    
    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/identifica');
        }

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
        $this->view->assign("email", $this->usuario['Email']);
    }

    public function indexAction() {
        // action body
    }

    public function pagamentoAction() {
        // action body
    }

    public function pagamentoDebitoAction() {
        // action body
    }

    public function pagamentoBoletoAction() {
        // action body
    }

    public function pagamentoMasterAction() {
        // action body
    }

    public function pagamentoHiperAction() {
        // action body
    }

    public function pagamentoAmericaAction() {
        // action body
    }

}

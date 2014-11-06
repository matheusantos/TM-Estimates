<?php

class FaseController extends Zend_Controller_Action {

    var $usuario;
    
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
    }

    public function indexAction() {

        $model = new Application_Model_Fase();
        $dados = $model->db_select('cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function novoAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Fase();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("/fase");
    }

}

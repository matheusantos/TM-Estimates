<?php

class RecursoController extends Zend_Controller_Action {

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
        $model = new Application_Model_Recursos();
        $dados = $model->db_select('cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function novoAction() { }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Recursos();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("/recurso");
    }

}

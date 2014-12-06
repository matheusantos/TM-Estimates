<?php

/* ! Controler detalhar fases e custo */

class DetalharController extends Zend_Controller_Action {

    private $usuario;

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
    }

    public function indexAction() {
        
    }

    public function custosAction() {
        $model = new Application_Model_ViewClienteDetalharCusto();
        $dados = $model->db_select('cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function fasesAction() {
        $model = new Application_Model_DetalharFase();
        $dados = $model->db_select('cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function ndfaseAction() {
        
    }

    public function ndcustoAction() {
        $model = new Application_Model_DetalharFase();
        $dados = $model->db_select();
        $this->view->assign("dados", $dados);
    }

    public function salvarDadosCustAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_DetalharCusto();
        $model->db_inserir($dados);
        $this->_redirect("/Detalhar/custos");
    }

}

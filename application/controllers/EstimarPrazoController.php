<?php

/* ! Controler Estimativa de Custo */

class EstimarPrazoController extends Zend_Controller_Action {

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
        $model = new Application_Model_ViewEstimativasPrazo();
        $prazo = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("prazo", $prazo);
    }

    public function gerarPrazoAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Estimaresforco();
        $esforco = $model->esforco_select($dados['projeto_idProjeto']);
        
        $model = new Application_Model_Estimarprazo();
        $model->db_inserir($dados);
        $this->_redirect("estimar-prazo/index");
    }

    public function excluirAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_Estimarprazo();
        $model->db_delete($dados);
        $this->_redirect("estimar-prazo/index");
    }

}

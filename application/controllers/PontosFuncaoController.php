<?php

class PontosFuncaoController extends Zend_Controller_Action {

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
        $model = new Application_Model_ViewPontosFuncao();
        $pontos = $model->db_select();
        $this->view->assign("pontos", $pontos);
    }

    public function gerarPontosFuncaoAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_PontosFuncao();
        $model->pf_delete($dados['Projeto']);
        $model->inserir($dados);
        $this->_redirect("pontos-funcao/index");
    }
    
        public function excluirAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_PontosFuncao();
        $model->db_delete($dados);
        $this->_redirect("pontos-funcao/index");
    }
    
}

<?php

/* ! Controler Estimativa de Custo */

class EstimarProdutividadeController extends Zend_Controller_Action {

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
        $model = new Application_Model_Estimarprodutividade();
        $produtividade = $model->db_select();
        $this->view->assign("produtividade", $produtividade);
    }
    
        public function gerarProdutividadeAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }
    
        public function salvarDadosAction() {
            $dados = $this->_getAllParams();
        $model = new Application_Model_Recursos();
        $n1 = $model->n_select(1, $dados['Projeto']);
        $n2 = $model->n_select(2, $dados['Projeto']);
        $n3 = $model->n_select(3, $dados['Projeto']);
        $n4 = $model->n_select(4, $dados['Projeto']);
        $n5 = $model->n_select(5, $dados['Projeto']);
        $estProd = ($n5*5)+($n4*4)+($n3*3)+($n2*2)+$n1;
        
            
        $dados = $this->_getAllParams();
        $model = new Application_Model_Estimarprodutividade();
        $model->inserir($dados, $estProd);
        $this->_redirect("estimar-produtividade/index");
    }

    public function excluirAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_Estimarprodutividade();
        $model->db_delete($dados);
        $this->_redirect("estimar-produtividade/index");
    }

}

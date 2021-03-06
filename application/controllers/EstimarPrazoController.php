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
        $dados1 = $model1->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Estimaresforco();
        $esfor = $model->esforco_select($dados['Projeto']);
        $esfor= $esfor[0]['Estimativa'];
        
        $model = new Application_Model_Estimarprodutividade();
        $produ = $model->select_prod($dados['Projeto']);
        $produ = $produ[0]['Estimativa'];
        
        $prazo = ($esfor*3)/($produ*5);

        $model = new Application_Model_Estimarprazo();
        $model->est_delete($dados['Projeto']);
        $model->db_inserir($dados, $prazo);
        $this->_redirect("estimar-prazo/index");
    }

    public function excluirAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_Estimarprazo();
        $model->db_delete($dados);
        $this->_redirect("estimar-prazo/index");
    }

}

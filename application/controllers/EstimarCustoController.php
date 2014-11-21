<?php

/* ! Controler Estimativa de Custo */

class EstimarCustoController extends Zend_Controller_Action {

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
        $model = new Application_Model_ViewEstimativasCusto();
        $custo = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("custo", $custo);
    }

    public function gerarCustoAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();

        $model = new Application_Model_Recursos();
        $n1 = $model->n_select(1, $dados['Projeto']);
        $n1 = count($n1);
        $n2 = $model->n_select(2, $dados['Projeto']);
        $n2 = count($n2);
        $n3 = $model->n_select(3, $dados['Projeto']);
        $n3 = count($n3);
        $n4 = $model->n_select(4, $dados['Projeto']);
        $n4 = count($n4);
        $n5 = $model->n_select(5, $dados['Projeto']);
        $n5 = count($n5);

        $soma1 = $model->soma_select(1, $dados['Projeto']);
        $soma1 = $soma1[0]['SUM(Carga_horaria)'];
        $soma2 = $model->soma_select(2, $dados['Projeto']);
        $soma2 = $soma2[0]['SUM(Carga_horaria)'];
        $soma3 = $model->soma_select(3, $dados['Projeto']);
        $soma3 = $soma3[0]['SUM(Carga_horaria)'];
        $soma4 = $model->soma_select(4, $dados['Projeto']);
        $soma4 = $soma4[0]['SUM(Carga_horaria)'];
        $soma5 = $model->soma_select(5, $dados['Projeto']);
        $soma5 = $soma5[0]['SUM(Carga_horaria)'];
        
        $model = new Application_Model_Estimarprazo();
        $prazo = $model->prazo_select($dados['Projeto']);
        
        $custo = (($n5 * $soma5 * 31.25) + ($n4 * $soma4 * 25) + ($n3 * $soma3 * 18.75) + 
                ($n2 * $soma2 * 12.5) + ($n1 * $soma1 * 6.25))*($prazo);
        $model = new Application_Model_Estimarcusto();
        $model->est_delete($dados['Projeto']);
        $model->db_inserir($dados, $custo);
        $this->_redirect("estimar-custo/index");
    }

    public function excluirAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_Estimarcusto();
        $model->db_delete($dados);
        $this->_redirect("estimar-custo/index");
    }

}

<?php

class ItensInfluenciaController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {
        
    }

    public function gerenciarAction() {
        
    }

    public function novoAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }
    
    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_ItensInfluencia();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("itens-influencia/index");
    }

}

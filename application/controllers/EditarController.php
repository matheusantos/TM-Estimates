<?php

class EditarController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_select('idProjeto', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function equipeAction() {
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_select('Recursos_idRecursos', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function faseAction() {
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_select('idFase', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function ambienteAction() {
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_select('idAmbiente', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function recursoAction() {
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_select('idRecursos', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function atualizaPrAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("projeto/index");
    }
    
       public function atualizaFaAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("fase/index");
    }
    
           public function atualizaReAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("recurso/index");
    }
    
               public function atualizaAmAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("ambiente/index");
    }
    
                   public function atualizaEqAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("equipe/index");
    }

}

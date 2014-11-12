<?php

class EditarController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {
        $id = $this->getParam('idP');
        
        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_select(null, $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
        
                
    }
    
        public function equipeAction() {
        $id = $this->getParam('idP');
        
        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_select(null, $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
        
                
    }
    
        public function faseAction() {
        $id = $this->getParam('idP');
        
        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_select(null, $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
        
                
    }
    
        public function ambienteAction() {
        $id = $this->getParam('idP');
        
        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_select(null, $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
        
                
    }
    
            public function recursoAction() {
        $id = $this->getParam('idP');
        
        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_select(null, $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
        
                
    }
   
}






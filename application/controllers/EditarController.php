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
   
}






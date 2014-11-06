<?php

class EquipeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
        
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }

    public function novoAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
        
        $model = new Application_Model_Recursos();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);
        
         $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }


}




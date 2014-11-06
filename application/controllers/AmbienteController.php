<?php

class AmbienteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
        
        $model = new Application_Model_Ambiente();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);
    }
    
        public function showAction() {
        $model = new Application_Model_Ambiente();
        $ambiente = $model->find($this->_getParam('id'));
        $this->view->assign("ambiente", $ambiente);
    }

    public function novoAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }
    
        public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Ambiente();
        $model->inserir($dados);
        $this->_redirect("/ambiente");
    }


}




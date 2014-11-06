<?php

class FaseController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_Fase();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);
    }
    
        public function showAction() {
        $model = new Application_Model_Fase();
        $fase = $model->find($this->_getParam('id'));
        $this->view->assign("fase", $fase);
    }

    public function novoAction() {
        $this->_helper->layout->setlayout("userlayout");
    }
    
        public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Fase();
        $model->inserir($dados);
        $this->_redirect("/fase");
    }

}

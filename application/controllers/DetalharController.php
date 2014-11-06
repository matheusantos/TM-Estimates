<?php

class DetalharController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function custosAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function fasesAction() {
        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_DetalharFase();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);
    }

    public function ndfaseAction() {
        $this->_helper->layout->setlayout("userlayout");
    }

    public function ndcustoAction() {
        $this->_helper->layout->setlayout("userlayout");
    }
    
        public function showAction() {
        $model = new Application_Model_DetalharFase();
        $DetalharFase = $model->find($this->_getParam('id'));
        $this->view->assign("DetalharFase", $DetalharFase);
    }
    
    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_DetalharFase();
        $model->inserir($dados);
        $this->_redirect("/fase");
    }

}

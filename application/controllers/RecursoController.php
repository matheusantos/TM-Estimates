<?php

class RecursoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_Recursos();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);
    }

    public function showAction() {
        $model = new Application_Model_Recursos();
        $recursos = $model->find($this->_getParam('id'));
        $this->view->assign("recursos", $recursos);
    }

    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Recursos();
        $model->inserir($dados);
        $this->_redirect("/recurso");
    }

}

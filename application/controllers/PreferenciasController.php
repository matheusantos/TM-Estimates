<?php

class PreferenciasController extends Zend_Controller_Action {

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
    }

    public function indexAction() {
        $modelPF = new Application_Model_ClientePF();
        $dadosPF = $modelPF->db_select($this->usuario['idCliente']);
        $cliente = $this->usuario;
        $this->view->assign("cliente", $cliente);
        $this->view->assign("dadosPF", $dadosPF);
    }

    public function pjAction() {
        
    }
    
    public function excluirPfAction(){
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Cliente();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("/index");
    }

}

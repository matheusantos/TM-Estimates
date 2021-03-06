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
        $this->view->assign("email", $this->usuario['Email']);
    }

    public function indexAction() {
        $cliente = $this->usuario;
        $modelPF = new Application_Model_ClientePF();
        $dadosPF = $modelPF->db_select($cliente['idCliente']);
        $this->view->assign("cliente", $cliente);
        $this->view->assign("dadosPF", $dadosPF);
    }

    public function pjAction() {
        $cliente = $this->usuario;
        $modelPJ = new Application_Model_ClientePJ();
        $dadosPJ = $modelPJ->db_select($cliente['idCliente']);
        $this->view->assign("cliente", $cliente);
        $this->view->assign("dadosPJ", $dadosPJ);
    }

    public function excluirPfAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Cliente();
        $dados_cliente = $model_cliente->db_delete($dados);
        
        //Limpa dados da Sessão
        Zend_Auth::getInstance()->clearIdentity();
        //Redireciona a requisição para a tela de Autenticacao novamente
        $this->_redirect('/index');
    }

}

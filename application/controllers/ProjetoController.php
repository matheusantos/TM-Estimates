<?php
/*! Controler Registrar Projeto */
class ProjetoController extends Zend_Controller_Action {

    var $usuario; /**< recebe informações do usuário logado */
    
    public function init() {
        //date_default_timezone_set("");

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

    //!< consulta dos Projetos do Cliente
    public function indexAction() {
        $model = new Application_Model_Projeto();
        $dados = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function novoAction() { }
    
    //!< salva o projeto do Cliente
    public function salvarDadosAction() {
        $dados = $this->getAllParams();
        $model = new Application_Model_Projeto();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("/projeto");
    }

}

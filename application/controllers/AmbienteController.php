<?php
/*! Controler Registrar Ambiente */
class AmbienteController extends Zend_Controller_Action {

    var $usuario; /**< recebe informações do usuário logado */

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
        $model = new Application_Model_Ambiente();
        $dados = $model->db_select('cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);
    }

    public function novoAction() {  }

    //!< grava os dados no banco de dados
    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Ambiente();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("/ambiente");
    }

}

<?php

/* ! Controler Registrar Funções Tipo Transação 
 * Permite registrar as funções do tipo transação de um determinado projeto. Em outras palavras, possibilita registrar:
 * EE (Entradas Externas)
 * SE (Saídas Externas)
 * CE (Consultas Externas)
 */

class FuncaoTransacaoController extends Zend_Controller_Action {

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
        $model = new Application_Model_FuncaoTransacao();
        $dados = $model->db_select();
        $this->view->assign("dados", $dados);
    }

    public function novoAction() {
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_FuncaoTransacao();
        $model->inserir($dados);
        $this->_redirect("funcao-transacao/index");
    }

}

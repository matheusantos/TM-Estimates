<?php

class EquipeController extends Zend_Controller_Action {

    var $usuario;

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
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
                
        $var = $db->select()
                ->from('projeto', array())
                ->from('equipe')
                ->where('Cliente_idCLiente = ' . $this->usuario['idCliente'])
                ->where('idProjeto = Projeto_idProjeto');
        
        $dados = $db->fetchAll($var);
        $this->view->assign("dados", $dados); 
    }

    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_Recursos();
        $dados = $model->db_select();
        $this->view->assign("dados", $dados);

        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Equipe();
        $model->inserir($dados);
        $this->_redirect("/equipe");
    }

}

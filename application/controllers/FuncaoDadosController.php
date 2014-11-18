<?php
/*! Controler Registrar Funções Tipo de Dados 
* Permite registrar as funções do tipo dados de um determinado projeto. Em outras palavras, possibilita registrar:
* ALI (Arquivos Lógicos Internos) 
* AIE (Arquivos de Interface Externa)
* AEC (Arquivos de Interface Externa)
*/

class FuncaoDadosController extends Zend_Controller_Action
{

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {
        $model = new Application_Model_FuncaoDados();
        $dados = $model->db_select();
        $this->view->assign("dados", $dados);
    }
    
    public function novoAction() { 
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }
    
    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_FuncaoDados();
        $model->inserir($dados);
        $this->_redirect("funcao-dados/index");
    }

}


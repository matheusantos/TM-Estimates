<?php
/*! Controler Registrar Funções Tipo Transação 
* Permite registrar as funções do tipo transação de um determinado projeto. Em outras palavras, possibilita registrar:
* EE (Entradas Externas)
* SE (Saídas Externas)
* CE (Consultas Externas)
*/
class FuncaoTransacaoController extends Zend_Controller_Action
{

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {

    }

    public function novoAction(){ }
}


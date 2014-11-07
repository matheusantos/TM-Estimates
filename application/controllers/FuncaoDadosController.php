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
        
    }
    
    public function novoAction() { }

}


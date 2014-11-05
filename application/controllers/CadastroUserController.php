<?php

class CadastroUserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function pjAction()
    {
        // action body
    }
    
    public function cadastrarAction()
    {
        $dados = $this->_getAllParams();
        
        $cliente = new Application_Model_Cliente();
        
        $email = $cliente->_select('Email',$dados['email']);
        
        if ($dados['email'] == $email['Email'])
            die;
        
        $radio = $dados['radio_box'];
        if ($radio == "pf")
            $model = new Application_Model_ClientePF();
        else
            $model = new Application_Model_ClientePJ();
        
        $model->inserir($dados);
        $cliente->inserir($dados);
        
        $this->_redirect("/login");
    }
}

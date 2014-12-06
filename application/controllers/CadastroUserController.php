<?php

/* ! Controler Cadastro de Usuario */

class CadastroUserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function pjAction() {
        // action body
    }
    
    public function emailJaCadastradoAction(){
        
    }

    public function verificaemailAction() {
  
            $this->_redirect("/login");
        
    }

    public function cadastrarAction() {

        $dados = $this->_getAllParams();

        $cliente = new Application_Model_Cliente();

        $email = $cliente->db_select('Email', $dados['email']);

        if (!empty($email)) {
             $this->_redirect("cadastro-user/email-ja-cadastrado");
        }

        $radio = $dados['radio_box'];
        if ($radio == "pf") {
            $model = new Application_Model_ClientePF();
        } else {
            $model = new Application_Model_ClientePJ();
        }
        $id = $cliente->inserir($dados);
        $model->inserir($dados, $id);

        $this->_redirect("/login");
    }

}

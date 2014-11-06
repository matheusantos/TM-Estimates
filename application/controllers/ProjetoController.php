<?php

class ProjetoController extends Zend_Controller_Action {

    var $usuario;
    
    public function init() {
        /* Isnitialize action controller here */
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
    }

    public function indexAction() {

        $model = new Application_Model_Projeto();
        $dados = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);

        //echo var_dump($usuario);
        //die;

//        // Instanciado Tabela Cidade
//        $model_projeto = new Application_Model_Projeto;
//
//        // Select na Tabela
//        $projeto = $model_projeto->select();
//
//        $var_cidade = $model_projeto->fetchAll($projeto)->toArray();
//
//        $this->view->cidade = $var_cidade;
//        //var_dump($var_cidade);
//        //die;
    }

//    public function showAction() {
//        $model = new Application_Model_Projeto();
//        $projeto = $model->find($this->_getParam('id'));
//        $this->view->assign("projeto", $projeto);
//    }

    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Projeto();
        $model->inserir($dados, $this->usuario['idCliente']);
        $this->_redirect("/projeto");
    }

    /*
      html {

      <?php $cidade = $this->cidade; ?>
      <p>
      <?php
      foreach ($cidade as $key => $dado):
      echo $dado['UF'];
      endforeach;
      ?>
      </p>

      }
     */
}

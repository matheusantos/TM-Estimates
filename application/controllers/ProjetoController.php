<?php

class ProjetoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        //date_default_timezone_set("");
    }

    public function indexAction() {
        // action body

        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_Projeto();
        $dados = $model->_select();
        $this->view->assign("dados", $dados);

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

    public function showAction() {
        $model = new Application_Model_Projeto();
        $projeto = $model->find($this->_getParam('id'));
        $this->view->assign("projeto", $projeto);
    }

    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_Projeto();
        $model->inserir($dados);
        $this->_redirect("/projeto");
    }

    public function getDadosAction() {

        // get Dados do Form
        $dados = $this->_getAllParams();

        // Instanciado Tabela Cidade
        $model = new Application_Model_Projeto();

        $model->insert($dados);

        $this->_redirect("/index");
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

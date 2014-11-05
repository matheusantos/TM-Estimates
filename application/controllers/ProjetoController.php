<?php

class ProjetoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body

        $this->_helper->layout->setlayout("userlayout");

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

    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");
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

<?php

/* ! Controler Recuperar Senha */

class EsqueceuSenhaController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function enviarEmailAction() {

        $email = $this->getParam('Email');

//        $dataHoje = new DateTime('now', new DateTimeZone( 'America/Bahia'));
//        $dataHoje->format( "d/m/Y H:i:s" )
//        ou
//        date_default_timezone_set('America/Bahia');
        $zend_date = new Zend_Date();
        $date_time = $zend_date->get('YYYY-MM-dd HH:mm:ss');

        $model_cliente = new Application_Model_Cliente();
        $dados_cliente = $model_cliente->db_select("Email", $email);

        if (empty($dados_cliente)) {
            echo "Colocar mensagem que email não existe";
            die;
        } else {
            $model_senha = new Application_Model_EsqueseuSenha();
            $model_senha->inserir(md5($dados['Email'] . $date_time), $date_time, $dados_cliente['idCliente']);

            echo "Fazer pagina 'Link enviado para email corresponte'";
            die;
//            $this->_redirect("/index");
        }
    }

    public function verificaAction() {
        
        $id_hash = $this->getParam('id');
        if (!is_null($id_hash)) {
            $model_senha = new Application_Model_EsqueseuSenha();
            $model_senha->db_select('Hash', $id_hash);

            if (empty($model_senha)) {
                echo "Hash não existe (Tratar Erro)";
                die;
//                $this->_redirect("/index");
            } else {
                $model_senha->db_update($id_hash, TRUE);
                echo "Página para fazer nova senha";
                die;
            }
        }
    }

}

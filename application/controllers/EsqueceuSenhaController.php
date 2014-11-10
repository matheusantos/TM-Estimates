<?php

/* ! Controler Recuperar Senha */

class EsqueceuSenhaController extends Zend_Controller_Action {

    var $id_user_confirmado;
    
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
        $dados_cliente = $model_cliente->db_select("Email", $email)[0];

        if (empty($dados_cliente)) {
            echo "Colocar mensagem que email não existe";
            die;
        } else {
            $hash = md5($dados_cliente['Email'] . $date_time);

            $model_senha = new Application_Model_Recuperar();
            $model_senha->db_insert($hash, $date_time, $dados_cliente['idCliente']);

            $config = array('auth' => 'login',
                'username' => 'tmestimates@gmail.com',
                'password' => 'tmestimates123',
                'port' => '465',
                'ssl' => 'ssl'
            );

            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyText('This is the text of the mail.');
            $mail->setBodyHtml(
                    '<a href="http://localhost/TM-Estimates/public/Esqueceu-Senha/verifica/id/' . $hash . '">'
                    . 'Recuperar Senha'
                    . '</a>');
            $mail->setFrom('tmestimates@gmail.com', 'TM-Estimates');
            $mail->addTo($email, 'Cliente');
            $mail->setSubject('Recuperar Senha');
            $mail->send($transport);

            echo "Fazer pagina 'Link enviado para email corresponte'";
            die;
//            $this->_redirect("/index");
        }
    }

    public function verificaAction() {

        $id_hash = $this->getParam('id');
        if (!is_null($id_hash)) {
            $model_senha = new Application_Model_Recuperar();
            $recupera = $model_senha->db_select('Hash', $id_hash)[0];

            if (empty($recupera)) {
                echo "Hash não existe (Tratar Erro)";
                die;
//                $this->_redirect("/index");
            } else if ($recupera['Utilizada'] == TRUE) {
                echo "Página chave já utilizada!";
                die;
            } else {
                //$this->view->assign("idCliente", $recupera['cliente_idCliente']);
                $this->_redirect("esqueceu-senha/nova-senha/id/" . $recupera['Hash'] . '/u/' . $recupera['cliente_idCliente']);
//                echo "Fazer select para pegar a id do user e redirecionar para novaSenha";
//                Fazer select para pegar a id do user e redirecionar para novaSenha
            }
        }
    }

    public function novaSenhaAction() {
        
        $id_hash = $this->getParam('id');
        $this->id_user_confirmado = $this->getParam('u');

        $model_senha = new Application_Model_Recuperar();
        $model_senha->db_update($id_hash, TRUE);
    }
    
    public function salvarSenhaAction() {
        
        echo var_dump($this->id_user_confirmado); die;

        $new_senha = md5($this->getParam('Senha'));
        $model_cliente = new Application_Model_Cliente();
        $model_cliente->db_update_senha($this->id_user_confirmado, $new_senha);

        echo "Página Sucesso!";
        die;
    }

}

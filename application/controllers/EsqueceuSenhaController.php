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
            $this->_redirect("esqueceu-senha/nao-existe");
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
            
            $this->_redirect("esqueceu-senha/enviar");
        }
    }

    public function verificaAction() {

        $id_hash = $this->getParam('id');
        if (!is_null($id_hash)) {
            $model_senha = new Application_Model_Recuperar();
            $recupera = $model_senha->db_select('Hash', $id_hash)[0];

            if (empty($recupera)) {
                $this->_redirect("error/");
            } else if ($recupera['Utilizada'] == TRUE) {
                $this->_redirect("esqueceu-senha/expirado");
            } else {
                //$this->view->assign("idCliente", $recupera['cliente_idCliente']);
                $this->_redirect("esqueceu-senha/nova-senha/id/" . $recupera['Hash'] . '/u/' . $recupera['cliente_idCliente']);
//                echo "Fazer select para pegar a id do user e redirecionar para novaSenha";
//                Fazer select para pegar a id do user e redirecionar para novaSenha
            }
        }
    }

    public function novaSenhaAction() {

        $dados = array(
            "hash" => $this->getParam('id'),
            "idCliente" => $this->getParam('u')
        );
        $this->view->assign("dados", $dados);

        $model_recuperar = new Application_Model_Recuperar();
        $model_recuperar->db_update($dados['hash'], TRUE);
    }

    public function salvarSenhaAction() {

        $dados = $this->getAllParams();

        $model_recuperar = new Application_Model_Recuperar();
        $recupera = $model_recuperar->db_select('Hash', $dados['hash'])[0];

        if (empty($recupera)) {
            $this->_redirect("error/");
        } else {
            if ($recupera['cliente_idCliente'] == $dados['idCliente']) {
                $new_senha = md5($dados['ConfSenha']);
                $model_cliente = new Application_Model_Cliente();
                $model_cliente->db_update_senha($dados['idCliente'], $new_senha);

                $this->_redirect("esqueceu-senha/sucesso");
            }
        }
    }
    
    public function enviarAction(){
        
    }

    public function expiradoAction(){
        
    }
    
    public function sucessoAction(){
        
    }
}
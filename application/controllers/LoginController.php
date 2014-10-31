<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /*
        //Desabilita renderização da view
        $this->_helper->viewRenderer->setNoRender();
        
        //Obter o objeto do adaptador para autenticar usando banco de dados
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        //Seta qual tabela e colunas procurar o usuário
        $authAdapter->setTableName('cliente')
                ->setIdentityColumn('email')
                ->setCredentialColumn('senha');

        //Seta as credenciais com dados vindos do formulário de login
        $authAdapter->setIdentity($this->_getParam('email'))
                ->setCredential($this->_getParam('senha'))
                ->setCredentialTreatment('MD5(?)');

        //Realiza autenticação
        $result = $authAdapter->authenticate();

        //Verifica se a autenticação foi válida
        if ($result->isValid()) {

            //Obtém dados do usuário
            $usuario = $authAdapter->getResultRowObject();

            //Armazena seus dados na sessão
            $storage = Zend_Auth::getInstance()->getStorage();
            $storage->write($usuario);

            //Redireciona para o Index
            $this->_redirect('index');
        } else {
            $this->_redirect('login/falha');
        }
        */
        
    }

    public function falhaAction()
    {
        
    }

    public function logoutAction()
    {
        

    }

    public function autenticaAction()
    {
        // action body
    }


}



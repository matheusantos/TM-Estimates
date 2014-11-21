<?php
/*! Controler Registrar equipes */
class EquipeController extends Zend_Controller_Action {

    private $usuario; /**< recebe informações do usuário logado */

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
        $this->_helper->layout->setlayout("userlayout");
        $this->view->assign("email", $this->usuario['Email']);
    }
    
    //!< carrega as equipes cadastradas
    public function indexAction() {
        $model = new Application_Model_ClienteEquipe();
        $dados = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        
        $this->view->assign("dados", $dados); 
    }
    
    //!< consulta dos dados de Recursos e Proejtos
    public function novoAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");

        $model = new Application_Model_ViewRecurso();
        $dados = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados", $dados);

        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        $this->view->assign("dados1", $dados1);
    }

    //!< grava os dados no banco de dados
    public function salvarDadosAction() {
        $dados = $this->getAllParams();
        
        $model = new Application_Model_ClienteEquipe();
        $lista = $model->db_select('Cliente_idCliente', $this->usuario['idCliente']);
        
        foreach ($lista as $value) {
            $r = $value['Recursos_idRecursos'];
            $p = $value['Projeto_idProjeto'];
            
            if (strcmp($r, $dados['Recurso']) == 0 && strcmp($p, $dados['Projeto']) == 0) {
                $this->_redirect("/equipe");
                break;
            }
        }
        
        $model = new Application_Model_Equipe();
        $model->db_insert($dados);
        $this->_redirect("/equipe");
    }

}

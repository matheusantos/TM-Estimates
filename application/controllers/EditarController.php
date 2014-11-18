<?php

class EditarController extends Zend_Controller_Action {

    var $usuario; /*     * < recebe informações do usuário logado */

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            
        }

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
    }

    public function indexAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_select('idProjeto', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function itensInfluenciaAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model = new Application_Model_ItensInfluencia();
        $dados = $model->db_select('projeto_idProjeto', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados", $dados);
    }

    public function equipeAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_select('Recursos_idRecursos', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function funcdadosAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');
        $model = new Application_Model_FuncaoDados();
        $dados = $model->db_select('idFuncaoDados', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados", $dados);
    }

    public function faseAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_select('idFase', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function detalharFaseAction() {
        $this->_helper->layout->setlayout("userlayout");

        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_DetalharFase();
        $dados_cliente = $model_cliente->db_select('idFase', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function detalharCustoAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_DetalharCusto();
        $dados_cliente = $model_cliente->db_select('idCustoFase', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function ambienteAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_select('idAmbiente', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function recursoAction() {
        $this->_helper->layout->setlayout("userlayout");
        $id = $this->getParam('idP');

        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_select('idRecursos', $id, null, null);
        $this->view->assign("id", $id);
        $this->view->assign("dados_cliente", $dados_cliente);
    }

    public function atualizaPrAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("projeto/index");
    }

    public function atualizaFaAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("fase/index");
    }

    public function atualizaIiAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_ItensInfluencia();
        $dados = $model_cliente->db_update($dados);
        $this->_redirect("itens-influencia/index");
    }

    public function atualizaDtFaAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_DetalharFase();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("detalhar/fases");
    }

    public function atualizaDtCuAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_DetalharCusto();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("detalhar/custos");
    }

    public function atualizaReAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("recurso/index");
    }

    public function atualizaAmAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("ambiente/index");
    }

    public function atualizaEqAction() {
        $dados = $this->_getAllParams();
        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_update($dados);
        $this->_redirect("equipe/index");
    }

    public function excluirAmAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Ambiente();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("ambiente/index");
    }

    public function excluirPrAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Projeto();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("projeto/index");
    }

    public function excluirFaAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Fase();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("fase/index");
    }

    public function excluirFdAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_FuncaoDados();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("funcao-dados/index");
    }

    public function excluirDtFaAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_DetalharFase();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("detalhar/fases");
    }

    public function excluirDtCuAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_DetalharCusto();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("detalhar/custos");
    }

    public function excluirReAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Recursos();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("recurso/index");
    }

    public function excluirEqAction() {
        $dados = $this->getParam('idP');
        $model_cliente = new Application_Model_Equipe();
        $dados_cliente = $model_cliente->db_delete($dados);
        $this->_redirect("equipe/index");
    }

    public function excluirIiAction() {
        $dados = $this->getParam('idP');
        $model = new Application_Model_ItensInfluencia();
        $dados_ii = $model->db_delete($dados);
        $this->_redirect("itens-influencia/index");
    }

    public function editarUserAction() {
        //
        //$this->view->assign("dados", $dados);
        $idCliente = $this->usuario['idCliente'];
        $modelPF = new Application_Model_ClientePF();
        $dadosPF = $modelPF->db_select($idCliente);
        if (!empty($dadosPF)) {
            $this->_redirect("preferencias/index");
        }
        $modelPJ = new Application_Model_ClientePJ();
        $dadosPJ = $modelPJ->db_select($idCliente);

        if (!empty($dadosPJ)) {
            $this->_redirect("preferencias/pj");
        }

        $this->view->assign("id", $id);
    }

    public function pfAction() {
        $this->_helper->layout->setlayout("userlayout");

        $cliente = $this->usuario;
        $modelPF = new Application_Model_ClientePF();
        $dadosPF = $modelPF->db_select($cliente['idCliente']);
        $this->view->assign("cliente", $cliente);
        $this->view->assign("dadosPF", $dadosPF);
    }

    public function pjAction() {
        $this->_helper->layout->setlayout("userlayout");

        $cliente = $this->usuario;
        $modelPJ = new Application_Model_ClientePJ();
        $dadosPJ = $modelPJ->db_select($cliente['idCliente']);
        $this->view->assign("cliente", $cliente);
        $this->view->assign("dadosPJ", $dadosPJ);
    }

    public function atualizarPfAction() {
        $dados = $this->_getAllParams();

        $cliente = new Application_Model_Cliente();
        $model = new Application_Model_ClientePF();
        $id = $cliente->db_update($dados);
        $model->db_update($dados, $id);

        $this->_redirect("preferencias/index");
    }

    public function atualizarFdAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_FuncaoDados();
        $dados_func = $model->db_update($dados);
        $this->_redirect("funcao-dados/index");
    }

    public function atualizarPjAction() {
        $dados = $this->_getAllParams();

        $cliente = new Application_Model_Cliente();
        $model = new Application_Model_ClientePJ();
        $id = $cliente->db_update($dados);
        $model->db_update($dados, $id);

        $this->_redirect("preferencias/pj");
    }

}

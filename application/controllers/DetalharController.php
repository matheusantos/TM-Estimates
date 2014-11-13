<?php
/*! Controler detalhar fases e custo */
class DetalharController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/login');
        }
        $this->_helper->layout->setlayout("userlayout");
    }

    public function indexAction() {

    }

    public function custosAction() {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $fase = array(
            "idFase",
            "descricaoFase" => "descricao",
        );
        $custofase = array(
            "idCustoFase",
            "descricaoCusto" => "descricao",
            "ValorPrevisto",
            "ValorEfetivo"
        );

        $jun = $db->select()
                  ->from('fase', $fase)
                  ->joinInner('custofase', 'fase.idFase = custofase.fase_idFase',$custofase);
                    
        $junF = $db->fetchAll($jun);
        $this->view->assign("dados", $junF);
    }

    public function fasesAction() {
        $model = new Application_Model_DetalharFase();
        $dados = $model->db_select();
        $this->view->assign("dados", $dados);
    }

    public function ndfaseAction() {

    }

    public function ndcustoAction() {

    }

    public function showAction() {
        $model = new Application_Model_DetalharFase();
        $DetalharFase = $model->find($this->_getParam('id'));
        $this->view->assign("DetalharFase", $DetalharFase);
    }

    public function showCustAction() {
        $model = new Application_Model_DetalharCusto();
        $DetalharCusto = $model->find($this->_getParam('id'));
        $this->view->assign("DetalharCusto", $DetalharCusto);
    }

    public function salvarDadosAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_DetalharFase();
        $model->inserir($dados);
        $this->_redirect("detalhar/fases");
    }

    public function salvarDadosCustAction() {
        $dados = $this->_getAllParams();
        $model = new Application_Model_DetalharCusto();
        $model->inserir($dados);
        $this->_redirect("/Detalhar/custos");
    }

}

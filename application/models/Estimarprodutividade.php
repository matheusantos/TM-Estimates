<?php
/*! Operações na tabela Ambiente */
class Application_Model_Estimarprodutividade extends Zend_Db_Table_Abstract{

    protected $_name = "estimativasprodutividade";
    protected $_primary = "idEstimativasProdutividade";

    public function inserir(array $request, $estimativa) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_ViewEstimativasProdutividade();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $estimativa,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idEstimativasProdutividade = ?", $id);
        $this->delete($where);
    }

}
